<?php

// Enqueue styles and scripts
function my_theme_enqueue_assets() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/styles.css');
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_assets');

// Add support for featured images
add_theme_support('post-thumbnails');
// Add theme support for WP Block styles
add_theme_support("wp-block-styles");
// Add support for responsive embeds 
add_theme_support("responsive-embeds");
// Add support for HTML5 
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

// Add custom menu support
function alex_theme_setup() {
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'alex-theme'),
        'secondary-menu' => __('Secondary Menu', 'alex-theme'),
    ));
}
add_action('after_setup_theme', 'alex_theme_setup');

// Registering ACF blocks
function alex_register_acf_blocks() {
    $block_templates = array(
        'hero',
        'about',
        'my-work',
        'hire-me',
        'contact'
    );

    foreach ($block_templates as $template) {
        register_block_type(get_template_directory() . '/template-parts/' . $template);
    }
}
add_action('acf/init', 'alex_register_acf_blocks');


// Custom block category show correctly
add_filter( 'block_categories_all', 'alex_block_category' );
function alex_block_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug' => 'alex-blocks',
                'title' => __('Blocks by Alex', 'alex-theme'),
            ),
        ),
        $categories
    );
}

//GZIP Compression 
function enable_gzip_compression() {
    if (!ob_start("ob_gzhandler")) ob_start();
}
add_action('init', 'enable_gzip_compression');

?>