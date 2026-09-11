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
$body    = $about_style
	? ''
	: alex_field(
		'body',
		'No juniors, no handoffs, no account layers. You work directly with me — from the first conversation to a site that is genuinely yours.'
	);
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

$media_imgs = array();
if ( ! $about_style ) {
	$media_imgs = array_values(
		array_filter(
			array(
				alex_theme_image( 'desk-detail' ),
				alex_theme_image( 'craft-02' ),
				alex_theme_image( 'london' ),
				alex_theme_image( 'craft-03' ),
			)
		)
	);
}
?>
<section id="capability" class="capability<?php echo $about_style ? ' capability--about' : ''; ?>" aria-label="<?php esc_attr_e( 'Technical capability', 'alex-theme' ); ?>">
	<div class="capability__head<?php echo $media_imgs ? ' capability__head--media' : ''; ?>">
		<div class="capability__intro rv">
			<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<h2 class="s-h"><?php echo wp_kses_post( $heading ); ?></h2>
			<?php if ( $body ) : ?>
				<p class="s-body"><?php echo esc_html( $body ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $media_imgs ) : ?>
			<div class="capability__media" aria-hidden="true">
				<?php foreach ( $media_imgs as $i => $src ) : ?>
					<figure class="capability__shot">
						<img src="<?php echo esc_url( $src ); ?>" alt="" width="600" height="400" loading="<?php echo 0 === $i ? 'eager' : 'lazy'; ?>" decoding="async" />
					</figure>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
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
