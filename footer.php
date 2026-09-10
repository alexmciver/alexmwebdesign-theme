<?php
/**
 * Theme footer.
 */
$footer_logo_text      = alex_field( 'footer_logo_text', 'Alex M Web Design', 'option' );
$footer_tagline        = alex_field( 'footer_tagline', 'Freelance WordPress & Shopify developer based in Clapham, London. Building sites that actually convert.', 'option' );
$footer_contact_title  = alex_field( 'footer_contact_title', 'Get in touch', 'option' );
$footer_email          = alex_field( 'footer_email', 'info@alexmwebdesign.co.uk', 'option' );
$footer_phone          = alex_field( 'footer_phone', '+447804187711', 'option' );
$footer_phone_display  = alex_field( 'footer_phone_display', '+44 (0)7804 187711', 'option' );
$footer_calendly_url   = alex_field( 'footer_calendly_url', 'https://calendly.com/alexmwebdesign/1-hour-website-chat', 'option' );
$footer_calendly_label = alex_field( 'footer_calendly_label', 'Book a discovery call →', 'option' );
$footer_copyright      = alex_field( 'footer_copyright', '© {year} Alex McIver · Freelance WordPress & Shopify Developer · London', 'option' );
$footer_certs          = alex_field(
	'footer_certs',
	array(
		array(
			'label' => 'HubSpot SEO Certified',
		),
		array(
			'label' => 'Google Analytics',
		),
	),
	'option'
);

if ( $footer_copyright ) {
	$footer_copyright = str_replace( '{year}', (string) gmdate( 'Y' ), $footer_copyright );
}
?>
<footer class="site-footer">
	<div class="footer-inner">
		<div>
			<div class="footer-logo"><span></span><?php echo esc_html( $footer_logo_text ); ?></div>
			<p class="footer-tagline"><?php echo esc_html( $footer_tagline ); ?></p>
		</div>
		<div>
			<p class="footer-col-title"><?php esc_html_e( 'Pages', 'alex-theme' ); ?></p>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'secondary-menu',
					'container'      => false,
					'menu_class'     => 'footer-links',
					'fallback_cb'    => 'alex_footer_nav_fallback',
				)
			);
			?>
		</div>
		<div>
			<p class="footer-col-title"><?php echo esc_html( $footer_contact_title ); ?></p>
			<div class="footer-contact">
				<?php if ( $footer_email ) : ?>
					<a href="mailto:<?php echo esc_attr( $footer_email ); ?>"><?php echo esc_html( $footer_email ); ?></a>
				<?php endif; ?>
				<?php if ( $footer_phone && $footer_phone_display ) : ?>
					<a href="tel:<?php echo esc_attr( $footer_phone ); ?>"><?php echo esc_html( $footer_phone_display ); ?></a>
				<?php endif; ?>
				<?php if ( $footer_calendly_url && $footer_calendly_label ) : ?>
					<a href="<?php echo esc_url( $footer_calendly_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $footer_calendly_label ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<p class="footer-copy"><?php echo esc_html( $footer_copyright ); ?></p>
		<div class="footer-certs">
			<?php foreach ( $footer_certs as $cert ) : ?>
				<?php if ( ! empty( $cert['label'] ) ) : ?>
					<span class="footer-cert"><?php echo esc_html( $cert['label'] ); ?></span>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
