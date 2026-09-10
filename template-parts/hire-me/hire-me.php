<?php
/**
 * Hire Me block — CTA band for work, services, about and contact pages.
 */
$contact_page  = get_page_by_path( 'contact' );
$contact_url   = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );
$services_page = get_page_by_path( 'services' );
$services_url  = $services_page ? get_permalink( $services_page ) : home_url( '/services/' );
$calendly      = 'https://calendly.com/alexmwebdesign/1-hour-website-chat';
$is_services   = is_page( 'services' );
$is_about      = is_page( 'about' );
$is_contact    = is_page( 'contact' );
$modifier      = $is_contact ? ' hire-me--contact' : ( $is_about ? ' hire-me--about' : ( $is_services ? ' hire-me--services' : '' ) );
?>
<section class="hire-me<?php echo esc_attr( $modifier ); ?>" aria-label="<?php esc_attr_e( 'Start a project', 'alex-theme' ); ?>">
	<div class="hire-me__inner rv">
		<?php if ( $is_contact ) : ?>
			<h2 class="hire-me__title"><?php echo wp_kses_post( __( 'Rather <em>talk?</em>', 'alex-theme' ) ); ?></h2>
			<p class="hire-me__sub"><?php esc_html_e( 'Book a short introductory call directly in the calendar. No preparation needed — tell me about the business and we\'ll see if there\'s a fit.', 'alex-theme' ); ?></p>
			<div class="hire-me__btns">
				<a href="<?php echo esc_url( $calendly ); ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Book a call', 'alex-theme' ); ?></a>
			</div>
			<p class="hire-me__meta"><?php esc_html_e( 'Monday to Friday · 9am–5pm London', 'alex-theme' ); ?></p>
		<?php elseif ( $is_about ) : ?>
			<h2 class="hire-me__title"><?php echo wp_kses_post( __( 'Shall we <em>talk?</em>', 'alex-theme' ) ); ?></h2>
			<p class="hire-me__sub"><?php esc_html_e( "A free thirty-minute call to see if we're a good fit — no pitch, no obligation.", 'alex-theme' ); ?></p>
			<div class="hire-me__btns">
				<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-primary"><?php esc_html_e( "Let's work together", 'alex-theme' ); ?></a>
				<a href="<?php echo esc_url( $calendly ); ?>" class="btn btn-outline-white" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Say hello', 'alex-theme' ); ?></a>
			</div>
		<?php elseif ( $is_services ) : ?>
			<h2 class="hire-me__title"><?php esc_html_e( "Let's scope it properly.", 'alex-theme' ); ?></h2>
			<p class="hire-me__sub"><?php esc_html_e( 'A thirty-minute conversation, then a written proposal with one figure and a clear scope. No obligation either way.', 'alex-theme' ); ?></p>
			<div class="hire-me__btns">
				<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-ink"><?php esc_html_e( 'Start a conversation', 'alex-theme' ); ?></a>
				<a href="<?php echo esc_url( $calendly ); ?>" class="btn btn-outline-white" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Book a call', 'alex-theme' ); ?></a>
			</div>
		<?php else : ?>
			<h2 class="hire-me__title"><?php esc_html_e( 'Something similar in mind?', 'alex-theme' ); ?></h2>
			<p class="hire-me__sub"><?php esc_html_e( "If you're planning a WordPress or Shopify build, I'd be glad to talk it through.", 'alex-theme' ); ?></p>
			<div class="hire-me__btns">
				<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-white"><?php esc_html_e( 'Start a project', 'alex-theme' ); ?></a>
				<a href="<?php echo esc_url( $services_url ); ?>" class="btn btn-outline-white"><?php esc_html_e( 'View services', 'alex-theme' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>
