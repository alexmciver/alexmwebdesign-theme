<?php
/**
 * Services block — numbered ways of working with image previews.
 */
$eyebrow  = alex_field( 'eyebrow', 'Services' );
$heading  = alex_field( 'heading', 'Engagements, not <em>packages</em>' );
$all_link = alex_button( get_field( 'all_link' ), 'View services', alex_page_url( 'services' ) );
$services = alex_field(
	'services',
	array(
		array(
			'title' => 'WordPress Development',
			'body'  => 'Bespoke themes and Divi 5 builds, WooCommerce, custom fields and plugin work. Sites structured so your team can run them without calling a developer.',
			'url'   => alex_page_url( 'services' ),
			'image' => 'service-01',
		),
		array(
			'title' => 'Shopify Development',
			'body'  => 'Custom Liquid themes, considered product and collection templates, checkout refinement and app integration for brands that take their storefront seriously.',
			'url'   => alex_page_url( 'services' ),
			'image' => 'service-02',
		),
		array(
			'title' => 'Performance & Search',
			'body'  => 'Technical audits, Core Web Vitals, structured data and search infrastructure — delivered as a plain-English report with the work actually done, not just recommended.',
			'url'   => alex_page_url( 'services' ),
			'image' => 'service-03',
		),
		array(
			'title' => 'Ongoing Care',
			'body'  => 'Hosting, updates, monitoring and a developer who already knows your site. For clients who would rather not think about any of it.',
			'url'   => alex_page_url( 'services' ),
			'image' => 'service-04',
		),
	)
);

$arrow = '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M3 11L11 3M11 3H5M11 3v6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>
<section id="services" class="services" aria-label="<?php esc_attr_e( 'Services', 'alex-theme' ); ?>" data-service-preview>
	<div class="services__head">
		<div class="rv">
			<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<h2 class="s-h"><?php echo wp_kses_post( $heading ); ?></h2>
		</div>
		<a href="<?php echo esc_url( $all_link['button_url'] ); ?>" class="services__all rv rv2"><?php echo esc_html( $all_link['button_text'] ); ?> →</a>
	</div>

	<div class="services__stage" aria-hidden="true">
		<div class="services__preview" id="services-preview">
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
				<?php $src = alex_theme_image( 'service-0' . $i ); ?>
				<?php if ( $src ) : ?>
					<img src="<?php echo esc_url( $src ); ?>" alt="" data-preview="<?php echo esc_attr( (string) $i ); ?>" width="480" height="360" loading="lazy" decoding="async" />
				<?php endif; ?>
			<?php endfor; ?>
		</div>
	</div>

	<div class="services__list">
		<?php
		$n = 0;
		foreach ( $services as $service ) :
			$title = isset( $service['title'] ) ? (string) $service['title'] : '';
			$body  = isset( $service['body'] ) ? (string) $service['body'] : '';
			$url   = isset( $service['url'] ) ? (string) $service['url'] : alex_page_url( 'services' );
			$img   = isset( $service['image'] ) ? (string) $service['image'] : '';
			if ( ! $url ) {
				continue;
			}
			++$n;
			$preview = $img ? (int) substr( $img, -1 ) : $n;
			?>
			<a href="<?php echo esc_url( $url ); ?>" class="services__row rv rv<?php echo esc_attr( (string) min( $n, 4 ) ); ?>" data-preview-id="<?php echo esc_attr( (string) $preview ); ?>">
				<span class="services__n"><?php echo esc_html( str_pad( (string) $n, 2, '0', STR_PAD_LEFT ) ); ?></span>
				<?php if ( $title ) : ?>
					<span class="services__title"><?php echo esc_html( $title ); ?></span>
				<?php endif; ?>
				<?php if ( $body ) : ?>
					<span class="services__body"><?php echo esc_html( $body ); ?></span>
				<?php endif; ?>
				<span class="services__arr"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
