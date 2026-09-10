<?php
/**
 * Capability block — production stack across platforms.
 */
$groups = array(
	array(
		'label' => 'Platforms',
		'tags'  => array( 'WordPress', 'Shopify', 'WooCommerce', 'Divi 5', 'ACF Pro', 'Gravity Forms' ),
	),
	array(
		'label' => 'Engineering',
		'tags'  => array( 'PHP', 'JavaScript', 'Liquid', 'HTML & CSS', 'MySQL', 'Git' ),
	),
	array(
		'label' => 'Infrastructure',
		'tags'  => array( 'WP Engine', 'Cloudflare', 'DNS & SSL', 'CDN configuration', 'Migrations', 'Backups' ),
	),
	array(
		'label' => 'Performance',
		'tags'  => array( 'Core Web Vitals', 'Technical SEO', 'Structured data', 'Search Console', 'GA4', 'Yoast' ),
	),
);
?>
<section id="capability" class="capability" aria-label="<?php esc_attr_e( 'Technical capability', 'alex-theme' ); ?>">
	<div class="rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Capability', 'alex-theme' ); ?></p>
		<h2 class="s-h"><?php esc_html_e( 'Five years of production work across both major platforms.', 'alex-theme' ); ?></h2>
	</div>

	<div class="cap-grid">
		<?php foreach ( $groups as $i => $group ) : ?>
			<div class="cap-group rv rv<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
				<p class="cap-label"><?php echo esc_html( $group['label'] ); ?></p>
				<ul class="cap-list">
					<?php foreach ( $group['tags'] as $tag ) : ?>
						<li><?php echo esc_html( $tag ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>
</section>
