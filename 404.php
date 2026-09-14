<?php
/**
 * 404 template — page not found.
 */
get_header();

$home_url    = home_url( '/' );
$contact_url = alex_page_url( 'contact' );
?>
<main id="content" tabindex="-1">
	<section class="page-hero error-404-hero" aria-label="<?php esc_attr_e( 'Page not found', 'alex-theme' ); ?>">
		<div class="page-hero-line" aria-hidden="true"></div>
		<div class="rv">
			<p class="s-eyebrow"><?php esc_html_e( '404', 'alex-theme' ); ?></p>
			<h1><?php echo wp_kses_post( __( 'This page isn\'t <em>here</em>.', 'alex-theme' ) ); ?></h1>
			<p class="page-hero-sub"><?php esc_html_e( 'The link may be broken, or the page may have moved. Head home, or get in touch if you were expecting something specific.', 'alex-theme' ); ?></p>
			<div class="error-404-hero__btns">
				<a href="<?php echo esc_url( $home_url ); ?>" class="btn btn-primary"><?php esc_html_e( 'Back home', 'alex-theme' ); ?></a>
				<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-outline-white"><?php esc_html_e( 'Get in touch', 'alex-theme' ); ?></a>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
