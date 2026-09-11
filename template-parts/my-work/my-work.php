<?php
/**
 * My Work block — work page hero, featured project and archive grid from the Work CPT.
 */
$eyebrow          = alex_field( 'eyebrow', 'Work' );
$heading          = alex_field( 'heading', 'Projects, <em>properly</em> built.' );
$subheading       = alex_field( 'subheading', 'A selection of WordPress and Shopify builds — chosen for the problems they solved, not how many screenshots they make.' );
$featured_eyebrow = alex_field( 'featured_eyebrow', 'Featured project' );
$featured_link    = alex_button( get_field( 'featured_link' ), 'Read write-up', '' );
$archive_eyebrow  = alex_field( 'archive_eyebrow', 'Archive' );
$archive_heading  = alex_field( 'archive_heading', 'Everything else' );

$featured_id = 0;
if ( function_exists( 'get_field' ) ) {
	$featured_raw = get_field( 'featured_work' );
	if ( is_object( $featured_raw ) && ! empty( $featured_raw->ID ) ) {
		$featured_id = (int) $featured_raw->ID;
	} elseif ( is_numeric( $featured_raw ) ) {
		$featured_id = (int) $featured_raw;
	}
}

$featured_id = alex_featured_work_id( $featured_id );
$featured    = $featured_id ? alex_work_item( $featured_id ) : null;

$archive_args = array( 'posts_per_page' => -1 );
if ( $featured_id ) {
	$archive_args['post__not_in'] = array( $featured_id );
}
$archive_query = alex_query_work( $archive_args );

$write_url  = '';
$site_url   = ( $featured && ! empty( $featured['project_url'] ) ) ? $featured['project_url'] : '';
$write_text = ! empty( $featured_link['button_text'] ) ? $featured_link['button_text'] : __( 'Read write-up', 'alex-theme' );
if ( $featured && ! empty( $featured['has_writeup'] ) ) {
	$write_url = $featured['url'];
}
if ( ! empty( $featured_link['button_url'] ) ) {
	$write_url = $featured_link['button_url'];
}
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
			<?php
			$featured_image = alex_featured_image( $featured );
			$featured_mod   = ( ! empty( $featured['image_mode'] ) && 'logo' === $featured['image_mode'] ) ? ' my-work__featured-media--logo' : '';
			?>
			<div class="my-work__featured-media<?php echo esc_attr( $featured_mod ); ?>">
				<?php if ( $featured_image ) : ?>
					<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( sprintf( /* translators: %s: project title */ __( 'Preview of %s', 'alex-theme' ), $featured['title'] ) ); ?>" loading="lazy" decoding="async" />
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
				<div class="my-work__links">
					<?php if ( $site_url ) : ?>
						<a href="<?php echo esc_url( $site_url ); ?>" class="my-work__link" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View site', 'alex-theme' ); ?> →</a>
					<?php endif; ?>
					<?php if ( $write_url ) : ?>
						<a href="<?php echo esc_url( $write_url ); ?>" class="my-work__link"><?php echo esc_html( $write_text ); ?> →</a>
					<?php endif; ?>
				</div>
			</div>
		</article>
	<?php endif; ?>

	<div class="my-work__archive">
		<div class="my-work__archive-head">
			<div class="rv">
				<p class="s-eyebrow"><?php echo esc_html( $archive_eyebrow ); ?></p>
				<h2 class="s-h"><?php echo wp_kses_post( $archive_heading ); ?></h2>
			</div>

			<?php
			$archive_projects = array();
			$platforms        = array();
			if ( $archive_query->have_posts() ) {
				$i = 0;
				while ( $archive_query->have_posts() ) {
					$archive_query->the_post();
					$project = alex_work_item( get_post(), $i );
					if ( ! $project ) {
						continue;
					}
					$archive_projects[] = $project;
					if ( ! empty( $project['platform'] ) ) {
						$platforms[ $project['platform'] ] = sanitize_title( $project['platform'] );
					}
					++$i;
				}
				wp_reset_postdata();
			}
			natcasesort( $platforms );
			?>

			<?php if ( count( $platforms ) > 1 ) : ?>
				<div class="work-filter rv rv2" data-work-filter role="group" aria-label="<?php esc_attr_e( 'Filter projects by platform', 'alex-theme' ); ?>">
					<button type="button" class="work-filter__btn is-active" data-filter="all" aria-pressed="true"><?php esc_html_e( 'All', 'alex-theme' ); ?></button>
					<?php foreach ( $platforms as $label => $slug ) : ?>
						<button type="button" class="work-filter__btn" data-filter="<?php echo esc_attr( $slug ); ?>" aria-pressed="false"><?php echo esc_html( $label ); ?></button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $archive_projects ) : ?>
			<div class="work__grid my-work__grid" data-work-grid>
				<?php
				$i = 0;
				foreach ( $archive_projects as $project ) :
					++$i;
					alex_render_work_card( $project, $i );
				endforeach;
				?>
			</div>
			<p class="work-filter__empty" data-work-empty hidden><?php esc_html_e( 'No projects in this category.', 'alex-theme' ); ?></p>
		<?php endif; ?>
	</div>
</section>
