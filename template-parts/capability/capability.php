<?php
/**
 * Capability block — production stack across platforms.
 */
$about_style = get_field( 'about_style' );
if ( empty( $about_style ) && is_page( 'about' ) ) {
	$about_style = true;
}

$default_eyebrow = $about_style ? 'Expertise' : 'Capability';
$default_heading = $about_style
	? 'What I work with, <em>properly</em>'
	: 'Five years of production work across both major platforms.';

$eyebrow = alex_field( 'eyebrow', $default_eyebrow );
$heading = alex_field( 'heading', $default_heading );
$groups  = alex_field(
	'groups',
	array(
		array(
			'label' => 'Platforms',
			'tags'  => "WordPress\nShopify\nWooCommerce\nDivi 5\nACF Pro\nGravity Forms",
		),
		array(
			'label' => 'Engineering',
			'tags'  => "PHP\nJavaScript\nLiquid\nHTML & CSS\nMySQL\nGit",
		),
		array(
			'label' => 'Infrastructure',
			'tags'  => "WP Engine\nCloudflare\nDNS & SSL\nCDN configuration\nMigrations\nBackups",
		),
		array(
			'label' => 'Performance',
			'tags'  => "Core Web Vitals\nTechnical SEO\nStructured data\nSearch Console\nGA4\nYoast",
		),
	)
);
?>
<section id="capability" class="capability<?php echo $about_style ? ' capability--about' : ''; ?>" aria-label="<?php esc_attr_e( 'Technical capability', 'alex-theme' ); ?>">
	<div class="rv">
		<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( $heading ); ?></h2>
	</div>

	<div class="cap-grid">
		<?php
		$n = 0;
		foreach ( $groups as $group ) :
			$label    = isset( $group['label'] ) ? (string) $group['label'] : '';
			$tags_raw = isset( $group['tags'] ) ? (string) $group['tags'] : '';
			$tags     = preg_split( '/\r\n|\r|\n/', $tags_raw );
			$tags     = array_filter( array_map( 'trim', (array) $tags ) );
			if ( ! $label && ! $tags ) {
				continue;
			}
			++$n;
			?>
			<div class="cap-group rv rv<?php echo esc_attr( (string) $n ); ?>">
				<?php if ( $label ) : ?>
					<p class="cap-label"><?php echo esc_html( $label ); ?></p>
				<?php endif; ?>
				<?php if ( $tags ) : ?>
					<ul class="cap-list">
						<?php foreach ( $tags as $tag ) : ?>
							<li><?php echo esc_html( $tag ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
