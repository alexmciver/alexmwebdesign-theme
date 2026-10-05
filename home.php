<?php
/**
 * Blog index (posts page).
 */
get_header();

$posts_page_id = (int) get_option( 'page_for_posts' );
$eyebrow       = __( 'Blog', 'alex-theme' );
$heading       = __( 'Notes from the <em>studio</em>.', 'alex-theme' );
$subheading    = __( 'Practical writing on WordPress, Shopify, performance, and building sites that earn their keep.', 'alex-theme' );

if ( $posts_page_id > 0 ) {
	$page_title = get_the_title( $posts_page_id );
	if ( $page_title && 'Blog' !== $page_title ) {
		$heading = $page_title;
	}
	$page_excerpt = get_the_excerpt( $posts_page_id );
	if ( $page_excerpt ) {
		$subheading = $page_excerpt;
	}
}
?>
<main id="content" tabindex="-1">
	<section class="page-hero blog-hero" aria-label="<?php esc_attr_e( 'Blog', 'alex-theme' ); ?>">
		<div class="page-hero-line" aria-hidden="true"></div>
		<div class="rv">
			<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<h1><?php echo wp_kses_post( $heading ); ?></h1>
			<p class="page-hero-sub"><?php echo esc_html( $subheading ); ?></p>
		</div>
	</section>

	<?php get_template_part( 'template-parts/blog/loop' ); ?>
</main>
<?php
get_footer();
