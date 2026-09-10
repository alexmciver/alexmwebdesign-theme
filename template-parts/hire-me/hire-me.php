<?php
/**
 * Hire Me block — orange CTA band for work and services pages.
 */
$contact_page  = get_page_by_path( 'contact' );
$contact_url   = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );
$services_page = get_page_by_path( 'services' );
$services_url  = $services_page ? get_permalink( $services_page ) : home_url( '/services/' );
?>
<section class="hire-me" aria-label="<?php esc_attr_e( 'Start a project', 'alex-theme' ); ?>">
	<div class="hire-me__inner rv">
		<h2 class="hire-me__title"><?php esc_html_e( 'Something similar in mind?', 'alex-theme' ); ?></h2>
		<p class="hire-me__sub"><?php esc_html_e( "If you're planning a WordPress or Shopify build, I'd be glad to talk it through.", 'alex-theme' ); ?></p>
		<div class="hire-me__btns">
			<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-white"><?php esc_html_e( 'Start a project', 'alex-theme' ); ?></a>
			<a href="<?php echo esc_url( $services_url ); ?>" class="btn btn-outline-white"><?php esc_html_e( 'View services', 'alex-theme' ); ?></a>
		</div>
	</div>
</section>
