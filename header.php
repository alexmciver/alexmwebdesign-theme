<?php
/**
 * Theme header — fixed nav + chrome overlays.
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

<div id="scroll-progress" aria-hidden="true"></div>
<div id="grain" aria-hidden="true"></div>
<div id="cur" aria-hidden="true"></div>
<div id="cur-r" aria-hidden="true"></div>

<header>
	<nav id="nav" role="navigation" aria-label="<?php esc_attr_e( 'Main navigation', 'alex-theme' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo"><span></span>Alex M</a>
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
		<button type="button" class="nav-burger" id="burger" aria-label="<?php esc_attr_e( 'Open menu', 'alex-theme' ); ?>" aria-expanded="false" aria-controls="mobile-nav">
			<span></span><span></span><span></span>
		</button>
	</nav>
	<nav class="nav-mobile" id="mobile-nav" aria-label="<?php esc_attr_e( 'Mobile navigation', 'alex-theme' ); ?>">
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
