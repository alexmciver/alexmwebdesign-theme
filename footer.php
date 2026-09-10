<?php
/**
 * Theme footer.
 */
?>
<footer class="site-footer">
	<div class="footer-inner">
		<div>
			<div class="footer-logo"><span></span>Alex M Web Design</div>
			<p class="footer-tagline">Freelance WordPress &amp; Shopify developer based in Clapham, London. Building sites that actually convert.</p>
		</div>
		<div>
			<p class="footer-col-title">Pages</p>
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
			<p class="footer-col-title">Get in touch</p>
			<div class="footer-contact">
				<a href="mailto:info@alexmwebdesign.co.uk">info@alexmwebdesign.co.uk</a>
				<a href="tel:+447804187711">+44 (0)7804 187711</a>
				<a href="https://calendly.com/alexmwebdesign/1-hour-website-chat" target="_blank" rel="noopener noreferrer">Book a discovery call →</a>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<p class="footer-copy">&copy; <?php echo esc_html( date( 'Y' ) ); ?> Alex McIver · Freelance WordPress &amp; Shopify Developer · London</p>
		<div class="footer-certs">
			<span class="footer-cert">HubSpot SEO Certified</span>
			<span class="footer-cert">Google Analytics</span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
