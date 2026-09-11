<?php
/**
 * Hero block — premium home intro.
 */
$location   = alex_field( 'location', 'Independent · London' );
$heading    = alex_field( 'heading', 'Websites that earn their place in <em>the business</em>.' );
$subheading = alex_field( 'subheading', 'I take on a limited number of WordPress and Shopify projects each year. Fixed scope, fixed fee — and a site your team can run without calling a developer.' );
$primary    = alex_button( get_field( 'primary_button' ), 'Enquire about a project', alex_page_url( 'contact' ) );
$secondary  = alex_button( get_field( 'secondary_button' ), 'Selected work', alex_page_url( 'work' ) );
$stats      = alex_field(
	'stats',
	array(
		array(
			'value'  => '5',
			'suffix' => '',
			'label'  => 'Years in practice',
		),
		array(
			'value'  => '30',
			'suffix' => '+',
			'label'  => 'Projects delivered',
		),
		array(
			'value'  => '24h',
			'suffix' => '',
			'label'  => 'Typical reply',
		),
	)
);
$strip_label = alex_field( 'strip_label', 'Platforms' );
$platforms   = alex_field(
	'platforms',
	array(
		array( 'label' => 'WordPress' ),
		array( 'label' => 'Shopify' ),
		array( 'label' => 'WooCommerce' ),
		array( 'label' => 'Divi 5' ),
		array( 'label' => 'WP Engine' ),
		array( 'label' => 'Cloudflare' ),
	)
);
$hero_image = alex_field( 'hero_image', alex_theme_image( 'alex-portrait' ) );
$hero_alt   = alex_field( 'hero_image_alt', 'Alex McIver, independent WordPress and Shopify developer' );
?>

<section class="hero" aria-label="<?php esc_attr_e( 'Alex McIver — Independent WordPress and Shopify developer, London', 'alex-theme' ); ?>">
	<div class="hero-main">
		<div class="hero-left">
			<p class="hero-loc"><?php echo esc_html( $location ); ?></p>
			<h1><?php echo wp_kses_post( $heading ); ?></h1>
			<p class="hero-sub"><?php echo esc_html( $subheading ); ?></p>
			<div class="hero-btns">
				<a href="<?php echo esc_url( $primary['button_url'] ); ?>" class="btn btn-primary"><?php echo esc_html( $primary['button_text'] ); ?></a>
				<a href="<?php echo esc_url( $secondary['button_url'] ); ?>" class="btn btn-outline-white"><?php echo esc_html( $secondary['button_text'] ); ?></a>
			</div>
		</div>

		<div class="hero-right">
			<?php if ( $hero_image ) : ?>
				<figure class="hero-visual hero-visual--portrait">
					<img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( $hero_alt ); ?>" width="800" height="1000" loading="eager" decoding="async" />
				</figure>
			<?php endif; ?>
		</div>
	</div>

	<div class="hero-stats">
		<?php foreach ( $stats as $stat ) : ?>
			<?php
			$value  = isset( $stat['value'] ) ? (string) $stat['value'] : '';
			$suffix = isset( $stat['suffix'] ) ? (string) $stat['suffix'] : '';
			$label  = isset( $stat['label'] ) ? (string) $stat['label'] : '';
			?>
			<div class="stat">
				<div class="stat-n"><?php echo esc_html( $value . $suffix ); ?></div>
				<?php if ( $label ) : ?>
					<div class="stat-l"><?php echo esc_html( $label ); ?></div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="hero-strip" aria-label="<?php esc_attr_e( 'Platforms I work across', 'alex-theme' ); ?>">
		<span class="hero-strip__label"><?php echo esc_html( $strip_label ); ?></span>
		<ul class="hero-strip__list">
			<?php foreach ( $platforms as $platform ) : ?>
				<?php if ( ! empty( $platform['label'] ) ) : ?>
					<li><?php echo esc_html( $platform['label'] ); ?></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
