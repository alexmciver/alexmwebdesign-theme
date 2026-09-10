<?php
/**
 * My Work block — work page hero, featured project and archive grid.
 */
$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );

$featured = array(
	'title'       => 'Coldharbour Lights',
	'body'        => 'A Shopify storefront rebuild for a lighting brand — cleaner product templates, faster collection browsing, and a checkout path that converted more of the traffic they already had.',
	'scope'       => 'Shopify rebuild',
	'client'      => 'Coldharbour Lights',
	'year'        => '2025',
	'link_label'  => 'View project',
	'link_url'    => $contact_url,
);

$projects = array(
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
);
?>
<section class="page-hero my-work-hero" aria-label="<?php esc_attr_e( 'Work', 'alex-theme' ); ?>">
	<div class="page-hero-line" aria-hidden="true"></div>
	<div class="rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Work', 'alex-theme' ); ?></p>
		<h1><?php echo wp_kses_post( __( 'Projects, <em>properly</em> built.', 'alex-theme' ) ); ?></h1>
		<p class="page-hero-sub"><?php esc_html_e( 'A selection of WordPress and Shopify builds — chosen for the problems they solved, not how many screenshots they make.', 'alex-theme' ); ?></p>
	</div>
</section>

<section class="my-work" aria-label="<?php esc_attr_e( 'Selected projects', 'alex-theme' ); ?>">
	<article class="my-work__featured rv">
		<div class="my-work__featured-media" aria-hidden="true"></div>
		<div class="my-work__featured-copy">
			<p class="s-eyebrow"><?php esc_html_e( 'Featured project', 'alex-theme' ); ?></p>
			<h2 class="s-h"><?php echo esc_html( $featured['title'] ); ?></h2>
			<p class="s-body"><?php echo esc_html( $featured['body'] ); ?></p>
			<dl class="my-work__meta">
				<div>
					<dt><?php esc_html_e( 'Scope', 'alex-theme' ); ?></dt>
					<dd><?php echo esc_html( $featured['scope'] ); ?></dd>
				</div>
				<div>
					<dt><?php esc_html_e( 'Client', 'alex-theme' ); ?></dt>
					<dd><?php echo esc_html( $featured['client'] ); ?></dd>
				</div>
				<div>
					<dt><?php esc_html_e( 'Year', 'alex-theme' ); ?></dt>
					<dd><?php echo esc_html( $featured['year'] ); ?></dd>
				</div>
			</dl>
			<a href="<?php echo esc_url( $featured['link_url'] ); ?>" class="my-work__link"><?php echo esc_html( $featured['link_label'] ); ?> →</a>
		</div>
	</article>

	<div class="my-work__archive">
		<div class="rv">
			<p class="s-eyebrow"><?php esc_html_e( 'Archive', 'alex-theme' ); ?></p>
			<h2 class="s-h"><?php esc_html_e( 'Everything else', 'alex-theme' ); ?></h2>
		</div>

		<div class="work__grid my-work__grid">
			<?php foreach ( $projects as $i => $project ) : ?>
				<a href="<?php echo esc_url( $project['url'] ); ?>" class="work__card rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
					<div class="work__media" aria-hidden="true"></div>
					<div class="work__meta">
						<span class="work__title"><?php echo esc_html( $project['title'] ); ?></span>
						<span class="work__platform"><?php echo esc_html( $project['platform'] ); ?></span>
					</div>
					<p class="work__result"><?php echo wp_kses_post( $project['result'] ); ?></p>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
