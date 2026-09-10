<?php
/**
 * My Work block — work page hero, featured project and archive grid from the Work CPT.
 */
$eyebrow         = alex_field( 'eyebrow', 'Work' );
$heading         = alex_field( 'heading', 'Projects, <em>properly</em> built.' );
$subheading      = alex_field( 'subheading', 'A selection of WordPress and Shopify builds — chosen for the problems they solved, not how many screenshots they make.' );
$featured_eyebrow = alex_field( 'featured_eyebrow', 'Featured project' );
$featured_link   = alex_button( get_field( 'featured_link' ), 'View project', '' );
$archive_eyebrow = alex_field( 'archive_eyebrow', 'Archive' );
$archive_heading = alex_field( 'archive_heading', 'Everything else' );

$featured_id = 0;
if ( function_exists( 'get_field' ) ) {
	$featured_raw = get_field( 'featured_work' );
	if ( is_object( $featured_raw ) && ! empty( $featured_raw->ID ) ) {
		$featured_id = (int) $featured_raw->ID;
	} elseif ( is_numeric( $featured_raw ) ) {
		$featured_id = (int) $featured_raw;
	}
}

$featured = $featured_id ? alex_work_item( $featured_id ) : null;

// Fall back to the latest Work post when none is selected.
if ( ! $featured ) {
	$latest = alex_query_work( array( 'posts_per_page' => 1 ) );
	if ( $latest->have_posts() ) {
		$latest->the_post();
		$featured_id = get_the_ID();
		$featured    = alex_work_item( $featured_id );
		wp_reset_postdata();
	}
}

$archive_args = array( 'posts_per_page' => -1 );
if ( $featured_id ) {
	$archive_args['post__not_in'] = array( $featured_id );
}
$archive_query = alex_query_work( $archive_args );

$featured_url  = $featured ? $featured['url'] : '';
$featured_text = ! empty( $featured_link['button_text'] ) ? $featured_link['button_text'] : __( 'View project', 'alex-theme' );
if ( ! empty( $featured_link['button_url'] ) ) {
	$featured_url = $featured_link['button_url'];
}
$has_featured_link = $featured && $featured_url && $featured_text;
?>
<section class="page-hero my-work-hero" aria-label="<?php esc_attr_e( 'Work', 'alex-theme' ); ?>">
	<div class="page-hero-line" aria-hidden="true"></div>
	<div class="rv">
		<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h1><?php echo wp_kses_post( $heading ); ?></h1>
		<p class="page-hero-sub"><?php echo esc_html( $subheading ); ?></p>
	</div>
</section>

<section class="my-work" aria-label="<?php esc_attr_e( 'Selected projects', 'alex-theme' ); ?>">
	<?php if ( $featured ) : ?>
		<article class="my-work__featured rv">
			<div class="my-work__featured-media" aria-hidden="true">
				<?php if ( $featured['image'] ) : ?>
					<img src="<?php echo esc_url( $featured['image'] ); ?>" alt="" loading="lazy" decoding="async" />
				<?php endif; ?>
			</div>
			<div class="my-work__featured-copy">
				<p class="s-eyebrow"><?php echo esc_html( $featured_eyebrow ); ?></p>
				<h2 class="s-h"><?php echo esc_html( $featured['title'] ); ?></h2>
				<?php if ( $featured['body'] ) : ?>
					<p class="s-body"><?php echo esc_html( $featured['body'] ); ?></p>
				<?php endif; ?>
				<dl class="my-work__meta">
					<?php if ( $featured['scope'] ) : ?>
						<div>
							<dt><?php esc_html_e( 'Scope', 'alex-theme' ); ?></dt>
							<dd><?php echo esc_html( $featured['scope'] ); ?></dd>
						</div>
					<?php endif; ?>
					<?php if ( $featured['client'] ) : ?>
						<div>
							<dt><?php esc_html_e( 'Client', 'alex-theme' ); ?></dt>
							<dd><?php echo esc_html( $featured['client'] ); ?></dd>
						</div>
					<?php endif; ?>
					<?php if ( $featured['year'] ) : ?>
						<div>
							<dt><?php esc_html_e( 'Year', 'alex-theme' ); ?></dt>
							<dd><?php echo esc_html( $featured['year'] ); ?></dd>
						</div>
					<?php endif; ?>
				</dl>
				<?php if ( $has_featured_link ) : ?>
					<a href="<?php echo esc_url( $featured_url ); ?>" class="my-work__link"><?php echo esc_html( $featured_text ); ?> →</a>
				<?php endif; ?>
			</div>
		</article>
	<?php endif; ?>

	<div class="my-work__archive">
		<div class="rv">
			<p class="s-eyebrow"><?php echo esc_html( $archive_eyebrow ); ?></p>
			<h2 class="s-h"><?php echo wp_kses_post( $archive_heading ); ?></h2>
		</div>

		<?php if ( $archive_query->have_posts() ) : ?>
			<div class="work__grid my-work__grid">
				<?php
				$i = 0;
				while ( $archive_query->have_posts() ) :
					$archive_query->the_post();
					$project = alex_work_item( get_post() );
					if ( ! $project || ! $project['url'] ) {
						continue;
					}
					++$i;
					?>
					<a href="<?php echo esc_url( $project['url'] ); ?>" class="work__card rv rv<?php echo esc_attr( (string) min( $i, 4 ) ); ?>">
						<div class="work__media" aria-hidden="true">
							<?php if ( $project['image'] ) : ?>
								<img src="<?php echo esc_url( $project['image'] ); ?>" alt="" loading="lazy" decoding="async" />
							<?php endif; ?>
						</div>
						<div class="work__meta">
							<?php if ( $project['title'] ) : ?>
								<span class="work__title"><?php echo esc_html( $project['title'] ); ?></span>
							<?php endif; ?>
							<?php if ( $project['platform'] ) : ?>
								<span class="work__platform"><?php echo esc_html( $project['platform'] ); ?></span>
							<?php endif; ?>
						</div>
						<?php if ( $project['result'] ) : ?>
							<p class="work__result"><?php echo wp_kses_post( $project['result'] ); ?></p>
						<?php endif; ?>
					</a>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
