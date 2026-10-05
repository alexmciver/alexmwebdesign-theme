<?php
/**
 * Category / tag / date archives.
 */
get_header();

$eyebrow    = __( 'Archive', 'alex-theme' );
$heading    = get_the_archive_title();
$subheading = get_the_archive_description();

if ( is_category() ) {
	$eyebrow = __( 'Category', 'alex-theme' );
	$heading = single_cat_title( '', false );
} elseif ( is_tag() ) {
	$eyebrow = __( 'Tag', 'alex-theme' );
	$heading = single_tag_title( '', false );
} elseif ( is_author() ) {
	$eyebrow = __( 'Author', 'alex-theme' );
	$heading = get_the_author();
} elseif ( is_year() || is_month() || is_day() ) {
	$eyebrow = __( 'Date', 'alex-theme' );
	$heading = get_the_date();
}
?>
<main id="content" tabindex="-1">
	<section class="page-hero blog-hero" aria-label="<?php echo esc_attr( wp_strip_all_tags( $heading ) ); ?>">
		<div class="page-hero-line" aria-hidden="true"></div>
		<div class="rv">
			<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<h1><?php echo esc_html( $heading ); ?></h1>
			<?php if ( $subheading ) : ?>
				<div class="page-hero-sub"><?php echo wp_kses_post( $subheading ); ?></div>
			<?php endif; ?>
		</div>
	</section>

	<?php get_template_part( 'template-parts/blog/loop' ); ?>
</main>
<?php
get_footer();
