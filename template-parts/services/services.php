<?php
/**
 * Services block — four numbered ways of working.
 */
$services_page = get_page_by_path( 'services' );
$services_url  = $services_page ? get_permalink( $services_page ) : home_url( '/services/' );

$services = array(
	array(
		'title' => 'WordPress Development',
		'body'  => 'Bespoke themes and Divi 5 builds, WooCommerce, custom fields and plugin work. Sites structured so your team can run them without calling a developer.',
		'url'   => $services_url,
	),
	array(
		'title' => 'Shopify Development',
		'body'  => 'Custom Liquid themes, considered product and collection templates, checkout refinement and app integration for brands that take their storefront seriously.',
		'url'   => $services_url,
	),
	array(
		'title' => 'Performance & Search',
		'body'  => 'Technical audits, Core Web Vitals, structured data and search infrastructure — delivered as a plain-English report with the work actually done, not just recommended.',
		'url'   => $services_url,
	),
	array(
		'title' => 'Ongoing Care',
		'body'  => 'Hosting, updates, monitoring and a developer who already knows your site. For clients who would rather not think about any of it.',
		'url'   => $services_url,
	),
);

$arrow = '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M3 11L11 3M11 3H5M11 3v6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>
<section id="services" class="services" aria-label="<?php esc_attr_e( 'Services', 'alex-theme' ); ?>">
	<div class="services__head">
		<div class="rv">
			<p class="s-eyebrow"><?php esc_html_e( 'Services', 'alex-theme' ); ?></p>
			<h2 class="s-h"><?php esc_html_e( 'Four ways I tend to work', 'alex-theme' ); ?></h2>
		</div>
		<a href="<?php echo esc_url( $services_url ); ?>" class="services__all rv rv2"><?php esc_html_e( 'All services', 'alex-theme' ); ?> →</a>
	</div>

	<div class="services__list">
		<?php foreach ( $services as $i => $service ) : ?>
			<a href="<?php echo esc_url( $service['url'] ); ?>" class="services__row rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
				<span class="services__n"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
				<span class="services__title"><?php echo esc_html( $service['title'] ); ?></span>
				<span class="services__body"><?php echo esc_html( $service['body'] ); ?></span>
				<span class="services__arr"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
