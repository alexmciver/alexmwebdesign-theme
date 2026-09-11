<?php

require_once get_template_directory() . '/inc/cv-sync.php';

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
 * Register Work custom post type.
 */
function alex_register_work_cpt() {
	$labels = array(
		'name'               => __( 'Work', 'alex-theme' ),
		'singular_name'      => __( 'Work', 'alex-theme' ),
		'menu_name'          => __( 'Work', 'alex-theme' ),
		'name_admin_bar'     => __( 'Work', 'alex-theme' ),
		'add_new'            => __( 'Add New', 'alex-theme' ),
		'add_new_item'       => __( 'Add New Work', 'alex-theme' ),
		'new_item'           => __( 'New Work', 'alex-theme' ),
		'edit_item'          => __( 'Edit Work', 'alex-theme' ),
		'view_item'          => __( 'View Work', 'alex-theme' ),
		'all_items'          => __( 'All Work', 'alex-theme' ),
		'search_items'       => __( 'Search Work', 'alex-theme' ),
		'parent_item_colon'  => __( 'Parent Work:', 'alex-theme' ),
		'not_found'          => __( 'No work found.', 'alex-theme' ),
		'not_found_in_trash' => __( 'No work found in Trash.', 'alex-theme' ),
	);

	register_post_type(
		'work',
		array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'work' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'menu_icon'          => 'dashicons-portfolio',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
		)
	);
}
add_action( 'init', 'alex_register_work_cpt' );

/**
 * Flush rewrite rules when the theme is switched on.
 */
function alex_theme_flush_rewrites() {
	alex_register_work_cpt();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'alex_theme_flush_rewrites' );

/**
 * Work listing URL (Work page, or CPT archive fallback).
 *
 * @return string
 */
function alex_work_archive_url() {
	$page = get_page_by_path( 'work' );
	if ( $page ) {
		return get_permalink( $page );
	}
	$link = get_post_type_archive_link( 'work' );
	return $link ? $link : home_url( '/work/' );
}

/**
 * Query Work posts.
 *
 * @param array $args Optional WP_Query args.
 * @return WP_Query
 */
function alex_query_work( $args = array() ) {
	$defaults = array(
		'post_type'              => 'work',
		'post_status'            => 'publish',
		'posts_per_page'         => -1,
		'orderby'                => 'date',
		'order'                  => 'DESC',
		'no_found_rows'          => true,
		'update_post_meta_cache' => true,
		'update_post_term_cache' => false,
	);
	return new WP_Query( array_merge( $defaults, $args ) );
}

/**
 * Normalised Work item for cards and featured layouts.
 *
 * @param int|WP_Post|null $post Post object or ID.
 * @return array{title:string,platform:string,result:string,scope:string,client:string,year:string,body:string,url:string,image:string}|null
 */
function alex_work_item( $post = null ) {
	$post = get_post( $post );
	if ( ! $post || 'work' !== $post->post_type ) {
		return null;
	}

	$image = get_the_post_thumbnail_url( $post, 'large' );

	return array(
		'title'    => get_the_title( $post ),
		'platform' => (string) alex_field( 'platform', '', $post->ID ),
		'result'   => (string) alex_field( 'result', '', $post->ID ),
		'scope'    => (string) alex_field( 'scope', '', $post->ID ),
		'client'   => (string) alex_field( 'client', '', $post->ID ),
		'year'     => (string) alex_field( 'year', '', $post->ID ),
		'body'     => has_excerpt( $post ) ? get_the_excerpt( $post ) : '',
		'url'      => get_permalink( $post ),
		'image'    => $image ? $image : '',
	);
}

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
		'Work'     => alex_work_archive_url(),
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

/**
 * Attributes for links that open in a new tab.
 *
 * @param string $url Link URL.
 * @return string Safe HTML attribute string (leading space) or empty.
 */
function alex_external_link_attrs( $url ) {
	if ( ! $url ) {
		return '';
	}
	$host = wp_parse_url( home_url(), PHP_URL_HOST );
	$link_host = wp_parse_url( $url, PHP_URL_HOST );
	$is_external = $link_host && $host && strcasecmp( (string) $link_host, (string) $host ) !== 0;
	$is_calendly = false !== stripos( (string) $url, 'calendly.com' );
	if ( ! $is_external && ! $is_calendly ) {
		return '';
	}
	return ' target="_blank" rel="noopener noreferrer"';
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
