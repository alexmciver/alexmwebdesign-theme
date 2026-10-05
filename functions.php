<?php

require_once get_template_directory() . '/inc/cv-sync.php';
require_once get_template_directory() . '/inc/ai-search.php';

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
 * Preload fonts used in the first paint (LCP text).
 */
function alex_preload_fonts() {
	$base  = get_template_directory_uri() . '/assets/fonts/';
	$fonts = array(
		'dm-sans-latin.woff2',
		'cormorant-garamond-italic-latin.woff2',
	);

	foreach ( $fonts as $font ) {
		$path = get_template_directory() . '/assets/fonts/' . $font;
		if ( ! file_exists( $path ) ) {
			continue;
		}
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( $base . $font )
		);
	}
}
add_action( 'wp_head', 'alex_preload_fonts', 1 );

/**
 * Inline critical CSS so the page hero can paint before styles.css.
 */
function alex_critical_css() {
	$file = get_template_directory() . '/assets/css/critical.css';
	if ( ! file_exists( $file ) ) {
		return;
	}
	$css = file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local theme file.
	if ( ! is_string( $css ) || '' === trim( $css ) ) {
		return;
	}

	// Relative font URLs must resolve from the document, not the CSS file path.
	$fonts_uri = trailingslashit( get_template_directory_uri() ) . 'assets/fonts/';
	$css       = str_replace( 'url("../fonts/', 'url("' . esc_url( $fonts_uri ), $css );
	$css       = str_replace( "url('../fonts/", "url('" . esc_url( $fonts_uri ), $css );

	echo '<style id="alex-critical-css">' . $css . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted local CSS.
}
add_action( 'wp_head', 'alex_critical_css', 2 );

/**
 * Load the full theme stylesheet without blocking first paint.
 *
 * @param string $html   Link tag HTML.
 * @param string $handle Style handle.
 * @param string $href   Stylesheet URL.
 * @param string $media  Media attribute.
 * @return string
 */
function alex_defer_theme_style( $html, $handle, $href, $media ) {
	if ( 'theme-style' !== $handle ) {
		return $html;
	}

	$href = esc_url( $href );
	return "<link rel='preload' href='{$href}' as='style' onload=\"this.onload=null;this.rel='stylesheet'\">\n"
		. "<noscript><link rel='stylesheet' href='{$href}'></noscript>\n";
}
add_filter( 'style_loader_tag', 'alex_defer_theme_style', 10, 4 );

/**
 * Whether the current view needs Contact Form 7 assets.
 *
 * @return bool
 */
function alex_needs_cf7() {
	if ( is_admin() ) {
		return true;
	}
	if ( ! is_singular() ) {
		return false;
	}

	$post = get_post();
	if ( ! $post ) {
		return false;
	}

	if ( has_shortcode( $post->post_content, 'contact-form-7' ) ) {
		return true;
	}

	if ( function_exists( 'has_block' ) && has_block( 'alex-theme/enquiries', $post ) ) {
		return true;
	}

	return is_page( 'contact' );
}

/**
 * Drop Contact Form 7 CSS/JS on pages without a form.
 */
function alex_dequeue_cf7_when_unused() {
	if ( alex_needs_cf7() ) {
		return;
	}

	wp_dequeue_script( 'contact-form-7' );
	wp_dequeue_script( 'swv' );
	wp_dequeue_style( 'contact-form-7' );
}
add_action( 'wp_enqueue_scripts', 'alex_dequeue_cf7_when_unused', 100 );

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
	alex_ai_search_rewrites();
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
 * Blog listing URL (posts page, or /blog/ fallback).
 *
 * @return string
 */
function alex_blog_url() {
	$posts_page_id = (int) get_option( 'page_for_posts' );
	if ( $posts_page_id > 0 ) {
		return get_permalink( $posts_page_id );
	}
	$page = get_page_by_path( 'blog' );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/blog/' );
}

/**
 * Approximate reading time for a post.
 *
 * @param int|WP_Post|null $post Post object or ID.
 * @return int Minutes (minimum 1).
 */
function alex_reading_time( $post = null ) {
	$post = get_post( $post );
	if ( ! $post ) {
		return 1;
	}
	$words = str_word_count( wp_strip_all_tags( (string) $post->post_content ) );
	return max( 1, (int) ceil( $words / 200 ) );
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
 * Resolve a featured Work post ID.
 *
 * Prefer an explicit block override, then the CPT “Featured project” toggle,
 * then the latest Work post.
 *
 * @param int $override_id Optional post ID from the My Work block field.
 * @return int
 */
function alex_featured_work_id( $override_id = 0 ) {
	$override_id = absint( $override_id );
	if ( $override_id && 'work' === get_post_type( $override_id ) && 'publish' === get_post_status( $override_id ) ) {
		return $override_id;
	}

	$featured = alex_query_work(
		array(
			'posts_per_page' => 1,
			'meta_key'       => 'is_featured',
			'meta_value'     => '1',
		)
	);
	if ( $featured->have_posts() ) {
		$featured->the_post();
		$id = get_the_ID();
		wp_reset_postdata();
		return (int) $id;
	}

	$latest = alex_query_work( array( 'posts_per_page' => 1 ) );
	if ( $latest->have_posts() ) {
		$latest->the_post();
		$id = get_the_ID();
		wp_reset_postdata();
		return (int) $id;
	}

	return 0;
}

/**
 * Keep only one Work post marked as featured.
 *
 * @param int|string $post_id Post ID being saved.
 */
function alex_work_enforce_single_featured( $post_id ) {
	$post_id = (int) $post_id;
	if ( $post_id <= 0 || 'work' !== get_post_type( $post_id ) ) {
		return;
	}
	if ( ! function_exists( 'get_field' ) || ! get_field( 'is_featured', $post_id ) ) {
		return;
	}

	$others = get_posts(
		array(
			'post_type'      => 'work',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'post__not_in'   => array( $post_id ),
			'fields'         => 'ids',
			'meta_key'       => 'is_featured',
			'meta_value'     => '1',
		)
	);

	foreach ( $others as $other_id ) {
		update_field( 'is_featured', 0, (int) $other_id );
	}
}
add_action( 'acf/save_post', 'alex_work_enforce_single_featured', 20 );

/**
 * WordPress.com mShots URL for a live site screenshot.
 *
 * @param string $url   Absolute project URL.
 * @param int    $width Screenshot width in pixels.
 * @return string
 */
function alex_work_mshot_url( $url, $width = 1200 ) {
	$url = esc_url_raw( $url );
	if ( ! $url ) {
		return '';
	}
	return 'https://s0.wp.com/mshots/v1/' . rawurlencode( $url ) . '?w=' . absint( $width );
}

/**
 * Local media URL for a saved site screenshot, when it matches the project URL.
 *
 * @param int    $post_id     Work post ID.
 * @param string $project_url Live project URL.
 * @return string
 */
function alex_work_local_screenshot_url( $post_id, $project_url ) {
	$project_url = esc_url_raw( $project_url );
	if ( ! $project_url ) {
		return '';
	}
	if ( (string) get_post_meta( $post_id, '_alex_screenshot_source', true ) !== $project_url ) {
		return '';
	}

	$attachment_id = (int) get_post_meta( $post_id, '_alex_screenshot_id', true );
	if ( ! $attachment_id || ! wp_attachment_is_image( $attachment_id ) ) {
		return '';
	}

	$src = wp_get_attachment_image_url( $attachment_id, 'large' );
	return $src ? $src : '';
}

/**
 * Queue a one-off capture when a Work post needs a stored screenshot.
 *
 * @param int $post_id Work post ID.
 */
function alex_work_queue_screenshot( $post_id ) {
	$post_id = (int) $post_id;
	if ( $post_id <= 0 || 'work' !== get_post_type( $post_id ) ) {
		return;
	}
	if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
		return;
	}

	$preview = (string) alex_field( 'preview_type', 'screenshot', $post_id );
	$url     = esc_url_raw( (string) alex_field( 'project_url', '', $post_id ) );
	if ( 'screenshot' !== $preview || ! $url ) {
		return;
	}

	$stored        = (string) get_post_meta( $post_id, '_alex_screenshot_source', true );
	$attachment_id = (int) get_post_meta( $post_id, '_alex_screenshot_id', true );
	$current       = $attachment_id && wp_attachment_is_image( $attachment_id );

	if ( $stored === $url && $current ) {
		return;
	}

	for ( $attempt = 0; $attempt <= 5; $attempt++ ) {
		if ( wp_next_scheduled( 'alex_work_capture_screenshot', array( $post_id, $attempt ) ) ) {
			return;
		}
	}

	if ( $attachment_id && $stored !== $url ) {
		wp_delete_attachment( $attachment_id, true );
		delete_post_meta( $post_id, '_alex_screenshot_id' );
		delete_post_meta( $post_id, '_alex_screenshot_source' );
	}

	alex_work_schedule_screenshot( $post_id, 0 );
}
add_action( 'acf/save_post', 'alex_work_queue_screenshot', 25 );

/**
 * Schedule a screenshot attempt. Later attempts wait for WordPress.com to finish.
 *
 * @param int $post_id Work post ID.
 * @param int $attempt Zero-based attempt count.
 */
function alex_work_schedule_screenshot( $post_id, $attempt = 0 ) {
	$post_id = (int) $post_id;
	$attempt = (int) $attempt;
	$args    = array( $post_id, $attempt );
	if ( wp_next_scheduled( 'alex_work_capture_screenshot', $args ) ) {
		return;
	}

	// The first attempt is due immediately so the cron spawn on this request can run it.
	$delay = 0 === $attempt ? 0 : 2 * MINUTE_IN_SECONDS;
	wp_schedule_single_event( time() + $delay, 'alex_work_capture_screenshot', $args );
}

/**
 * Download a finished screenshot into the media library.
 *
 * WordPress.com answers with a “Generating Preview…” GIF until the JPEG exists.
 * That GIF is not stored. The card keeps its previous image until a real JPEG lands.
 *
 * @param int $post_id Work post ID.
 * @param int $attempt Zero-based attempt count.
 */
function alex_work_capture_screenshot( $post_id, $attempt = 0 ) {
	$post_id = (int) $post_id;
	$attempt = (int) $attempt;
	if ( $post_id <= 0 || 'work' !== get_post_type( $post_id ) ) {
		return;
	}

	$url = esc_url_raw( (string) alex_field( 'project_url', '', $post_id ) );
	if ( ! $url || 'screenshot' !== (string) alex_field( 'preview_type', 'screenshot', $post_id ) ) {
		return;
	}
	if ( alex_work_local_screenshot_url( $post_id, $url ) ) {
		return;
	}

	$remote = alex_work_mshot_url( $url );
	if ( ! $remote ) {
		return;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$tmp = download_url( $remote, 20 );
	if ( is_wp_error( $tmp ) ) {
		alex_work_retry_screenshot( $post_id, $attempt );
		return;
	}

	$info = wp_getimagesize( $tmp );
	$mime = ( is_array( $info ) && ! empty( $info['mime'] ) ) ? $info['mime'] : '';
	$wide = is_array( $info ) && (int) $info[0] >= 600;
	if ( ( 'image/jpeg' !== $mime && 'image/png' !== $mime ) || ! $wide ) {
		wp_delete_file( $tmp );
		alex_work_retry_screenshot( $post_id, $attempt );
		return;
	}

	$ext   = 'image/png' === $mime ? 'png' : 'jpg';
	$title = get_the_title( $post_id );
	$file  = array(
		'name'     => sanitize_file_name( sanitize_title( $title ? $title : 'work' ) . '-preview.' . $ext ),
		'tmp_name' => $tmp,
	);
	$saved = media_handle_sideload( $file, $post_id, sprintf( /* translators: %s: project title */ __( 'Preview of %s', 'alex-theme' ), $title ) );
	if ( is_wp_error( $saved ) ) {
		if ( file_exists( $tmp ) ) {
			wp_delete_file( $tmp );
		}
		alex_work_retry_screenshot( $post_id, $attempt );
		return;
	}

	$previous = (int) get_post_meta( $post_id, '_alex_screenshot_id', true );
	update_post_meta( $post_id, '_alex_screenshot_id', (int) $saved );
	update_post_meta( $post_id, '_alex_screenshot_source', $url );
	update_post_meta( $saved, '_wp_attachment_image_alt', sprintf( /* translators: %s: project title */ __( 'Preview of %s', 'alex-theme' ), $title ) );

	if ( $previous && $previous !== (int) $saved ) {
		wp_delete_attachment( $previous, true );
	}
}
add_action( 'alex_work_capture_screenshot', 'alex_work_capture_screenshot', 10, 2 );

/**
 * Try the capture again until WordPress.com returns a real screenshot.
 *
 * @param int $post_id Work post ID.
 * @param int $attempt Attempt that just failed.
 */
function alex_work_retry_screenshot( $post_id, $attempt ) {
	if ( (int) $attempt >= 5 ) {
		return;
	}
	alex_work_schedule_screenshot( (int) $post_id, (int) $attempt + 1 );
}

/**
 * Queue another capture for Work posts that still have no saved screenshot.
 *
 * The first pass can miss a few sites when WordPress.com is still generating.
 * Scanning is throttled so a normal page view does not queue the same post again.
 */
function alex_work_backfill_screenshots() {
	if ( ! function_exists( 'get_field' ) || ! post_type_exists( 'work' ) ) {
		return;
	}
	if ( get_transient( 'alex_work_screenshot_scan' ) ) {
		return;
	}
	set_transient( 'alex_work_screenshot_scan', 1, 10 * MINUTE_IN_SECONDS );

	$ids = get_posts(
		array(
			'post_type'      => 'work',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);

	foreach ( $ids as $id ) {
		alex_work_queue_screenshot( (int) $id );
	}

	spawn_cron();
}
add_action( 'init', 'alex_work_backfill_screenshots', 30 );

/**
 * Company logo URL from the Work ACF image field.
 *
 * @param int $post_id Work post ID.
 * @return string
 */
function alex_work_logo_url( $post_id ) {
	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}
	$logo = get_field( 'company_logo', $post_id );
	if ( is_array( $logo ) && ! empty( $logo['url'] ) ) {
		return (string) $logo['url'];
	}
	if ( is_numeric( $logo ) ) {
		$src = wp_get_attachment_image_url( (int) $logo, 'large' );
		return $src ? $src : '';
	}
	if ( is_string( $logo ) && $logo ) {
		return $logo;
	}
	return '';
}

/**
 * Resolve card / featured preview image for a Work post.
 *
 * Priority follows the Card preview ACF select, then sensible fallbacks.
 *
 * @param WP_Post $post           Work post.
 * @param int     $fallback_index Placeholder cycle index.
 * @return array{image:string,mode:string}
 */
function alex_work_preview( $post, $fallback_index = 0 ) {
	$preview     = (string) alex_field( 'preview_type', 'screenshot', $post->ID );
	$project_url = (string) alex_field( 'project_url', '', $post->ID );
	$featured    = get_the_post_thumbnail_url( $post, 'large' );
	$logo        = alex_work_logo_url( $post->ID );

	if ( 'logo' === $preview && $logo ) {
		return array(
			'image' => $logo,
			'mode'  => 'logo',
		);
	}

	if ( 'featured' === $preview && $featured ) {
		return array(
			'image' => $featured,
			'mode'  => 'featured',
		);
	}

	if ( ( 'screenshot' === $preview || 'featured' !== $preview ) && $project_url ) {
		$shot = alex_work_local_screenshot_url( $post->ID, $project_url );
		if ( ! $shot ) {
			$shot = alex_work_mshot_url( $project_url );
		}
		if ( $shot ) {
			return array(
				'image' => $shot,
				'mode'  => 'screenshot',
			);
		}
	}

	if ( $featured ) {
		return array(
			'image' => $featured,
			'mode'  => 'featured',
		);
	}

	if ( $logo ) {
		return array(
			'image' => $logo,
			'mode'  => 'logo',
		);
	}

	$placeholder = alex_work_placeholder( $fallback_index );
	return array(
		'image' => $placeholder ? $placeholder : '',
		'mode'  => 'placeholder',
	);
}

/**
 * Whether a Work post has a real write-up (editor content).
 *
 * @param int|WP_Post|null $post Post object or ID.
 * @return bool
 */
function alex_work_has_writeup( $post = null ) {
	$post = get_post( $post );
	if ( ! $post || 'work' !== $post->post_type ) {
		return false;
	}
	$content = trim( wp_strip_all_tags( (string) $post->post_content ) );
	return '' !== $content;
}

/**
 * Normalised Work item for cards and featured layouts.
 *
 * @param int|WP_Post|null $post Post object or ID.
 * @param int              $fallback_index Optional placeholder image index (0–3) when no thumbnail.
 * @return array{title:string,platform:string,result:string,scope:string,client:string,year:string,body:string,url:string,project_url:string,has_writeup:bool,image:string,image_mode:string}|null
 */
function alex_work_item( $post = null, $fallback_index = 0 ) {
	$post = get_post( $post );
	if ( ! $post || 'work' !== $post->post_type ) {
		return null;
	}

	$preview     = alex_work_preview( $post, $fallback_index );
	$has_writeup = alex_work_has_writeup( $post );

	return array(
		'title'       => get_the_title( $post ),
		'platform'    => (string) alex_field( 'platform', '', $post->ID ),
		'result'      => (string) alex_field( 'result', '', $post->ID ),
		'scope'       => (string) alex_field( 'scope', '', $post->ID ),
		'client'      => (string) alex_field( 'client', '', $post->ID ),
		'year'        => (string) alex_field( 'year', '', $post->ID ),
		'body'        => has_excerpt( $post ) ? get_the_excerpt( $post ) : '',
		'url'         => get_permalink( $post ),
		'project_url' => (string) alex_field( 'project_url', '', $post->ID ),
		'has_writeup' => $has_writeup,
		'image'       => $preview['image'],
		'image_mode'  => $preview['mode'],
	);
}

/**
 * Hover / touch action links for a Work preview.
 *
 * @param array  $project           From alex_work_item().
 * @param string $write_label       Optional write-up label.
 * @param string $write_url_override Optional explicit write-up URL.
 */
function alex_work_actions( $project, $write_label = '', $write_url_override = '' ) {
	if ( empty( $project ) || ! is_array( $project ) ) {
		return;
	}

	$site_url    = ! empty( $project['project_url'] ) ? $project['project_url'] : '';
	$write_url   = $write_url_override ? $write_url_override : ( ( ! empty( $project['has_writeup'] ) && ! empty( $project['url'] ) ) ? $project['url'] : '' );
	$write_label = $write_label ? $write_label : __( 'Read write-up', 'alex-theme' );
	$title       = ! empty( $project['title'] ) ? $project['title'] : '';

	if ( ! $site_url && ! $write_url ) {
		return;
	}
	?>
	<div class="work__actions">
		<?php if ( $title ) : ?>
			<p class="work__hover-title"><?php echo esc_html( $title ); ?></p>
		<?php endif; ?>
		<div class="work__action-list">
			<?php if ( $site_url ) : ?>
				<a href="<?php echo esc_url( $site_url ); ?>" class="work__action" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View site', 'alex-theme' ); ?></a>
			<?php endif; ?>
			<?php if ( $write_url ) : ?>
				<a href="<?php echo esc_url( $write_url ); ?>" class="work__action"><?php echo esc_html( $write_label ); ?></a>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

/**
 * Render a Work grid card with site / write-up hover actions.
 *
 * @param array $project  From alex_work_item().
 * @param int   $rv_index Reveal delay index (1–4).
 */
function alex_render_work_card( $project, $rv_index = 0 ) {
	if ( empty( $project ) || ! is_array( $project ) ) {
		return;
	}

	$rv_index  = absint( $rv_index );
	$rv_class  = $rv_index > 0 ? ' rv rv' . min( $rv_index, 4 ) : '';
	$media_mod = ( ! empty( $project['image_mode'] ) && 'logo' === $project['image_mode'] ) ? ' work__media--logo' : '';
	$title_url = '';
	if ( ! empty( $project['has_writeup'] ) && ! empty( $project['url'] ) ) {
		$title_url = $project['url'];
	} elseif ( ! empty( $project['project_url'] ) ) {
		$title_url = $project['project_url'];
	}
	$platform_slug = ! empty( $project['platform'] ) ? sanitize_title( $project['platform'] ) : '';
	?>
	<article class="work__card<?php echo esc_attr( $rv_class ); ?>"<?php echo $platform_slug ? ' data-platform="' . esc_attr( $platform_slug ) . '"' : ''; ?>>
		<div class="work__media<?php echo esc_attr( $media_mod ); ?>">
			<?php if ( ! empty( $project['image'] ) ) : ?>
				<img src="<?php echo esc_url( $project['image'] ); ?>" alt="<?php echo esc_attr( sprintf( /* translators: %s: project title */ __( 'Preview of %s', 'alex-theme' ), $project['title'] ) ); ?>" loading="lazy" decoding="async" />
			<?php endif; ?>
			<?php alex_work_actions( $project ); ?>
		</div>
		<div class="work__meta">
			<?php if ( ! empty( $project['title'] ) ) : ?>
				<?php if ( $title_url ) : ?>
					<a href="<?php echo esc_url( $title_url ); ?>" class="work__title"<?php echo ( ! empty( $project['project_url'] ) && $title_url === $project['project_url'] ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $project['title'] ); ?></a>
				<?php else : ?>
					<span class="work__title"><?php echo esc_html( $project['title'] ); ?></span>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( ! empty( $project['platform'] ) ) : ?>
				<span class="work__platform"><?php echo esc_html( $project['platform'] ); ?></span>
			<?php endif; ?>
		</div>
		<?php if ( ! empty( $project['result'] ) ) : ?>
			<p class="work__result"><?php echo wp_kses_post( $project['result'] ); ?></p>
		<?php endif; ?>
	</article>
	<?php
}

/**
 * Theme image URL from assets/images (WebP preferred).
 *
 * Royalty-free Unsplash placeholders (Unsplash License):
 * - hero-workspace — Christopher Gower
 * - work-featured — Daniel Korpai
 * - work-01 — Lee Campbell
 * - work-02 — Luke Chesser
 * - work-03 — CardMapr.nl
 * - work-04 — William Iven
 *
 * @param string $slug Filename without extension.
 * @return string
 */
function alex_theme_image( $slug ) {
	$base = get_template_directory() . '/assets/images/' . $slug;
	$uri  = get_template_directory_uri() . '/assets/images/' . $slug;
	if ( file_exists( $base . '.webp' ) ) {
		return $uri . '.webp';
	}
	if ( file_exists( $base . '.jpg' ) ) {
		return $uri . '.jpg';
	}
	if ( file_exists( $base . '.png' ) ) {
		return $uri . '.png';
	}
	return '';
}

/**
 * Cycle of work placeholder images (royalty-free).
 *
 * @param int $index Zero-based index.
 * @return string
 */
function alex_work_placeholder( $index = 0 ) {
	$slugs = array( 'work-01', 'work-02', 'work-03', 'work-04', 'work-05', 'work-06' );
	$count = count( $slugs );
	$slug  = $slugs[ absint( $index ) % $count ];
	return alex_theme_image( $slug );
}

/**
 * Featured work image, or royalty-free placeholder.
 *
 * @param array $item Work item from alex_work_item().
 * @return string
 */
function alex_featured_image( $item ) {
	$mode = ! empty( $item['image_mode'] ) ? $item['image_mode'] : '';
	if ( ! empty( $item['image'] ) && 'placeholder' !== $mode && false === strpos( $item['image'], '/work-0' ) ) {
		return $item['image'];
	}
	$featured = alex_theme_image( 'work-featured' );
	return $featured ? $featured : ( ! empty( $item['image'] ) ? $item['image'] : '' );
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
		'Blog'     => alex_blog_url(),
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
 * Front-end GZIP only — never buffer admin, AJAX or REST (breaks the block editor).
 */
function enable_gzip_compression() {
	if ( is_admin() || wp_doing_ajax() || wp_is_json_request() ) {
		return;
	}

	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
	if ( false !== strpos( $request_uri, '/wp-json/' ) || false !== strpos( $request_uri, 'rest_route=' ) ) {
		return;
	}

	if ( headers_sent() ) {
		return;
	}

	$accept = isset( $_SERVER['HTTP_ACCEPT_ENCODING'] ) ? (string) $_SERVER['HTTP_ACCEPT_ENCODING'] : '';
	if ( '' === $accept || false === stripos( $accept, 'gzip' ) ) {
		return;
	}

	if ( ! ob_start( 'ob_gzhandler' ) ) {
		ob_start();
	}
}
add_action( 'init', 'enable_gzip_compression' );
