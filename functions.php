<?php

/**
 * Enqueue styles and scripts.
 */
function my_theme_enqueue_assets() {
	$css = get_template_directory() . '/assets/css/styles.css';
	$js  = get_template_directory() . '/assets/js/main.js';

	wp_enqueue_style(
		'theme-style',
		get_template_directory_uri() . '/assets/css/styles.css',
		array(),
		file_exists( $css ) ? filemtime( $css ) : null
	);

	wp_enqueue_script(
		'theme-script',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		file_exists( $js ) ? filemtime( $js ) : null,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_assets' );

/**
 * Theme supports and menus.
 */
function alex_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'title-tag' );
	add_theme_support(
		'html5',
		array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' )
	);

	register_nav_menus(
		array(
			'primary-menu'   => __( 'Primary Menu', 'alex-theme' ),
			'secondary-menu' => __( 'Secondary Menu', 'alex-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'alex_theme_setup' );

/**
 * Fallback desktop nav when no menu is assigned.
 */
function alex_nav_fallback() {
	$links = alex_default_nav_links();
	echo '<ul class="nav-links">';
	foreach ( $links as $label => $url ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Fallback mobile nav — flat links for the overlay.
 */
function alex_mobile_nav_fallback() {
	$links = alex_default_nav_links();
	foreach ( $links as $label => $url ) {
		printf( '<a href="%s">%s</a>', esc_url( $url ), esc_html( $label ) );
	}
}

/**
 * Fallback footer links.
 */
function alex_footer_nav_fallback() {
	$links = alex_default_nav_links();
	echo '<ul class="footer-links">';
	foreach ( $links as $label => $url ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Default nav destinations.
 */
function alex_default_nav_links() {
	return array(
		'Work'     => home_url( '/work/' ),
		'Services' => home_url( '/services/' ),
		'About'    => home_url( '/about/' ),
		'Contact'  => home_url( '/contact/' ),
	);
}

/**
 * Strip wrapper markup from mobile nav so links sit as direct children.
 */
add_filter(
	'wp_nav_menu_args',
	function ( $args ) {
		if ( ! empty( $args['theme_location'] ) && 'primary-menu' === $args['theme_location'] && '%3$s' === ( $args['items_wrap'] ?? '' ) ) {
			$args['walker'] = new Alex_Flat_Nav_Walker();
		}
		return $args;
	}
);

/**
 * Outputs only anchor tags for the mobile overlay.
 */
class Alex_Flat_Nav_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$output .= sprintf(
			'<a href="%s"%s>%s</a>',
			esc_url( $item->url ),
			in_array( 'current-menu-item', (array) $item->classes, true ) ? ' class="active"' : '',
			esc_html( $item->title )
		);
	}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}

/**
 * ACF field value, or a fallback when empty.
 *
 * @param string $name    Field name.
 * @param mixed  $default Fallback value.
 * @param mixed  $post_id Optional post ID / 'option'.
 * @return mixed
 */
function alex_field( $name, $default = '', $post_id = false ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}
	$value = false === $post_id ? get_field( $name ) : get_field( $name, $post_id );
	if ( null === $value || false === $value || '' === $value ) {
		return $default;
	}
	if ( is_array( $value ) && empty( $value ) ) {
		return $default;
	}
	return $value;
}

/**
 * Button group (button_text + button_url) with fallbacks.
 *
 * @param mixed  $field         Group field value.
 * @param string $default_text  Fallback label.
 * @param string $default_url   Fallback URL.
 * @return array{button_text: string, button_url: string}
 */
function alex_button( $field, $default_text = '', $default_url = '' ) {
	$btn  = is_array( $field ) ? $field : array();
	$text = ! empty( $btn['button_text'] ) ? (string) $btn['button_text'] : $default_text;
	$url  = ! empty( $btn['button_url'] ) ? (string) $btn['button_url'] : $default_url;
	return array(
		'button_text' => $text,
		'button_url'  => $url,
	);
}

/**
 * Permalink for a page slug, with path fallback.
 *
 * @param string $slug Page slug.
 * @return string
 */
function alex_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : home_url( '/' . trailingslashit( $slug ) );
}

// ACF Local JSON — save field groups into the theme
add_filter(
	'acf/settings/save_json',
	function ( $path ) {
		return get_stylesheet_directory() . '/acf-json';
	}
);

// ACF Local JSON — load field groups from the theme
add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		unset( $paths[0] );
		$paths[] = get_stylesheet_directory() . '/acf-json';
		return $paths;
	}
);

/**
 * Register ACF blocks.
 */
function alex_register_acf_blocks() {
	$block_templates = array(
		'hero',
		'problem',
		'capability',
		'services',
		'work',
		'quote',
		'approach',
		'questions',
		'enquiries',
		'about',
		'my-work',
		'my-services',
		'hire-me',
		'contact',
	);

	foreach ( $block_templates as $template ) {
		register_block_type( get_template_directory() . '/template-parts/' . $template );
	}
}
add_action( 'acf/init', 'alex_register_acf_blocks' );

/**
 * Theme Settings options page.
 */
add_action(
	'acf/init',
	function () {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				array(
					'page_title' => 'Theme Settings',
					'menu_title' => 'Theme Settings',
					'menu_slug'  => 'theme-settings',
					'capability' => 'edit_theme_options',
					'redirect'   => false,
				)
			);
		}
	}
);

/**
 * Custom block category.
 */
add_filter( 'block_categories_all', 'alex_block_category' );
function alex_block_category( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'alex-blocks',
				'title' => __( 'Blocks by Alex', 'alex-theme' ),
			),
		),
		$categories
	);
}

/**
 * GZIP compression.
 */
function enable_gzip_compression() {
	if ( ! ob_start( 'ob_gzhandler' ) ) {
		ob_start();
	}
}
add_action( 'init', 'enable_gzip_compression' );
