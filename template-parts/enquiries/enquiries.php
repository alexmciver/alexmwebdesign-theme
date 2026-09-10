<?php
/**
 * Enquiries block — contact details and enquiry form.
 */
$calendly = 'https://calendly.com/alexmwebdesign/1-hour-website-chat';
?>
<section id="enquiries" class="enquiries" aria-label="<?php esc_attr_e( 'Enquiries', 'alex-theme' ); ?>">
	<div class="enquiries__left rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Enquiries', 'alex-theme' ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( __( "Let's talk about what you're <em>building</em>", 'alex-theme' ) ); ?></h2>
		<p class="enquiries__intro"><?php esc_html_e( "I reply to everything personally, within one working day. If it isn't a fit I'll tell you, and point you somewhere better.", 'alex-theme' ); ?></p>

		<ul class="enquiries__details">
			<li>
				<span class="enquiries__label"><?php esc_html_e( 'Email', 'alex-theme' ); ?></span>
				<a href="mailto:info@alexmwebdesign.co.uk">info@alexmwebdesign.co.uk</a>
			</li>
			<li>
				<span class="enquiries__label"><?php esc_html_e( 'Telephone', 'alex-theme' ); ?></span>
				<a href="tel:+447804187711">+44 7804 187711</a>
			</li>
			<li>
				<span class="enquiries__label"><?php esc_html_e( 'Calendar', 'alex-theme' ); ?></span>
				<a href="<?php echo esc_url( $calendly ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Book a call', 'alex-theme' ); ?> →</a>
			</li>
		</ul>

		<p class="enquiries__note"><?php esc_html_e( 'Client references available on request. Currently taking on a limited number of projects.', 'alex-theme' ); ?></p>
	</div>

	<form class="enquiries__form rv rv2" action="#" method="post" novalidate>
		<label class="enq-field">
			<span><?php esc_html_e( 'Name', 'alex-theme' ); ?></span>
			<input type="text" name="name" placeholder="<?php esc_attr_e( 'Your name', 'alex-theme' ); ?>" autocomplete="name" required>
		</label>
		<label class="enq-field">
			<span><?php esc_html_e( 'Email', 'alex-theme' ); ?></span>
			<input type="email" name="email" placeholder="<?php esc_attr_e( 'you@company.com', 'alex-theme' ); ?>" autocomplete="email" required>
		</label>
		<label class="enq-field">
			<span><?php esc_html_e( 'Company', 'alex-theme' ); ?></span>
			<input type="text" name="company" placeholder="<?php esc_attr_e( 'Optional', 'alex-theme' ); ?>" autocomplete="organization">
		</label>
		<label class="enq-field">
			<span><?php esc_html_e( 'Nature of enquiry', 'alex-theme' ); ?></span>
			<select name="nature" required>
				<option value=""><?php esc_html_e( 'Please select', 'alex-theme' ); ?></option>
				<option value="wordpress"><?php esc_html_e( 'WordPress project', 'alex-theme' ); ?></option>
				<option value="shopify"><?php esc_html_e( 'Shopify project', 'alex-theme' ); ?></option>
				<option value="performance"><?php esc_html_e( 'Performance & search', 'alex-theme' ); ?></option>
				<option value="care"><?php esc_html_e( 'Ongoing care', 'alex-theme' ); ?></option>
				<option value="other"><?php esc_html_e( 'Something else', 'alex-theme' ); ?></option>
			</select>
		</label>
		<label class="enq-field enq-field--full">
			<span><?php esc_html_e( 'About the project', 'alex-theme' ); ?></span>
			<textarea name="message" rows="4" placeholder="<?php esc_attr_e( 'A sentence or two is plenty to start with.', 'alex-theme' ); ?>" required></textarea>
		</label>
		<button type="submit" class="btn btn-primary enquiries__submit"><?php esc_html_e( 'Send enquiry', 'alex-theme' ); ?></button>
	</form>
</section>
