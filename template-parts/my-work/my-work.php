<?php
/**
 * My Work block — work page hero, featured project and archive grid.
 */
$contact_url = alex_page_url( 'contact' );

$eyebrow          = alex_field( 'eyebrow', 'Work' );
$heading          = alex_field( 'heading', 'Projects, <em>properly</em> built.' );
$subheading       = alex_field( 'subheading', 'A selection of WordPress and Shopify builds — chosen for the problems they solved, not how many screenshots they make.' );
$featured_eyebrow = alex_field( 'featured_eyebrow', 'Featured project' );
$featured_title   = alex_field( 'featured_title', 'Coldharbour Lights' );
$featured_body    = alex_field( 'featured_body', 'A Shopify storefront rebuild for a lighting brand — cleaner product templates, faster collection browsing, and a checkout path that converted more of the traffic they already had.' );
$featured_scope   = alex_field( 'featured_scope', 'Shopify rebuild' );
$featured_client  = alex_field( 'featured_client', 'Coldharbour Lights' );
$featured_year    = alex_field( 'featured_year', '2025' );
$featured_link    = alex_button( get_field( 'featured_link' ), 'View project', $contact_url );
$archive_eyebrow  = alex_field( 'archive_eyebrow', 'Archive' );
$archive_heading  = alex_field( 'archive_heading', 'Everything else' );
$projects         = alex_field(
	'projects',
	array(
		array(
			'title'    => 'Pel & Co',
			'platform' => 'WooCommerce',
			'result'   => 'Theme rebuild — <em>+28% average order value</em>, Core Web Vitals pass',
			'url'      => $contact_url,
		),
		array(
			'title'    => 'Northbridge Studio',
			'platform' => 'WordPress',
			'result'   => 'Bespoke theme — <em>1.2s LCP</em>, editorial layout system',
			'url'      => $contact_url,
		),
		array(
			'title'    => 'Harbour & Field',
			'platform' => 'Shopify',
			'result'   => 'Migration & redesign — <em>zero downtime</em>, cleaner checkout',
			'url'      => $contact_url,
		),
		array(
			'title'    => 'Ashworth & Co',
			'platform' => 'WordPress',
			'result'   => 'Divi 5 marketing site — <em>structured for search</em>, easy to edit',
			'url'      => $contact_url,
		),
		array(
			'title'    => 'Kin & Clay',
			'platform' => 'Shopify',
			'result'   => 'Custom theme — <em>collection UX overhaul</em>, faster add-to-cart',
			'url'      => $contact_url,
		),
		array(
			'title'    => 'Eastgate Legal',
			'platform' => 'WordPress',
			'result'   => 'Practice site rebuild — <em>enquiry form conversion up</em>, clearer IA',
			'url'      => $contact_url,
		),
	)
);

$has_featured_link = ! empty( $featured_link['button_text'] ) && ! empty( $featured_link['button_url'] );
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
	<article class="my-work__featured rv">
		<div class="my-work__featured-media" aria-hidden="true"></div>
		<div class="my-work__featured-copy">
			<p class="s-eyebrow"><?php echo esc_html( $featured_eyebrow ); ?></p>
			<h2 class="s-h"><?php echo esc_html( $featured_title ); ?></h2>
			<p class="s-body"><?php echo esc_html( $featured_body ); ?></p>
			<dl class="my-work__meta">
				<div>
					<dt><?php esc_html_e( 'Scope', 'alex-theme' ); ?></dt>
					<dd><?php echo esc_html( $featured_scope ); ?></dd>
				</div>
				<div>
					<dt><?php esc_html_e( 'Client', 'alex-theme' ); ?></dt>
					<dd><?php echo esc_html( $featured_client ); ?></dd>
				</div>
				<div>
					<dt><?php esc_html_e( 'Year', 'alex-theme' ); ?></dt>
					<dd><?php echo esc_html( $featured_year ); ?></dd>
				</div>
			</dl>
			<?php if ( $has_featured_link ) : ?>
				<a href="<?php echo esc_url( $featured_link['button_url'] ); ?>" class="my-work__link"><?php echo esc_html( $featured_link['button_text'] ); ?> →</a>
			<?php endif; ?>
		</div>
	</article>

	<div class="my-work__archive">
		<div class="rv">
			<p class="s-eyebrow"><?php echo esc_html( $archive_eyebrow ); ?></p>
			<h2 class="s-h"><?php echo esc_html( $archive_heading ); ?></h2>
		</div>

		<div class="work__grid my-work__grid">
			<?php foreach ( $projects as $i => $project ) : ?>
				<?php
				$title    = isset( $project['title'] ) ? (string) $project['title'] : '';
				$platform = isset( $project['platform'] ) ? (string) $project['platform'] : '';
				$result   = isset( $project['result'] ) ? (string) $project['result'] : '';
				$url      = isset( $project['url'] ) ? (string) $project['url'] : '';
				?>
				<?php if ( $url && ( $title || $platform || $result ) ) : ?>
					<a href="<?php echo esc_url( $url ); ?>" class="work__card rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
						<div class="work__media" aria-hidden="true"></div>
						<div class="work__meta">
							<?php if ( $title ) : ?>
								<span class="work__title"><?php echo esc_html( $title ); ?></span>
							<?php endif; ?>
							<?php if ( $platform ) : ?>
								<span class="work__platform"><?php echo esc_html( $platform ); ?></span>
							<?php endif; ?>
						</div>
						<?php if ( $result ) : ?>
							<p class="work__result"><?php echo wp_kses_post( $result ); ?></p>
						<?php endif; ?>
					</a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
