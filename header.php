<?php
/**
 * Theme header — fixed nav.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'alex-theme' ); ?></a>

<header>
	<nav id="nav" aria-label="<?php esc_attr_e( 'Main navigation', 'alex-theme' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">Alex McIver</a>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary-menu',
				'container'      => false,
				'menu_class'     => 'nav-links',
				'fallback_cb'    => 'alex_nav_fallback',
			)
		);
		?>
		<button type="button" class="nav-burger" id="burger" aria-label="<?php esc_attr_e( 'Open menu', 'alex-theme' ); ?>" data-label-open="<?php esc_attr_e( 'Open menu', 'alex-theme' ); ?>" data-label-close="<?php esc_attr_e( 'Close menu', 'alex-theme' ); ?>" aria-expanded="false" aria-controls="mobile-nav">
			<span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span>
		</button>
	</nav>
	<nav class="nav-mobile" id="mobile-nav" hidden aria-label="<?php esc_attr_e( 'Mobile navigation', 'alex-theme' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary-menu',
				'container'      => false,
				'menu_class'     => '',
				'items_wrap'     => '%3$s',
				'fallback_cb'    => 'alex_mobile_nav_fallback',
			)
		);
		?>
	</nav>
</header>
