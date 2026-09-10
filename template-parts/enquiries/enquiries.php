<?php
/**
 * Enquiries block — contact details and enquiry form,
 * or contact-page process + form layout.
 */
$calendly   = 'https://calendly.com/alexmwebdesign/1-hour-website-chat';
$is_contact = is_page( 'contact' );

$process = array(
	'You\'ll hear back from me — not an assistant — within one working day.',
	'A short conversation to understand the business and what the site needs to do.',
	'A written proposal with one figure and a clear scope. Nothing starts until that\'s agreed.',
	'Work begins once we\'re both certain it\'s a good fit.',
);
?>
<?php if ( $is_contact ) : ?>
<section id="enquiries" class="enquiries enquiries--contact" aria-label="<?php esc_attr_e( 'Enquiry', 'alex-theme' ); ?>">
	<div class="enquiries__process rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Process', 'alex-theme' ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( __( 'A straightforward <em>process</em>', 'alex-theme' ) ); ?></h2>
		<ul class="enquiries__steps">
			<?php foreach ( $process as $step ) : ?>
				<li>
					<span class="enquiries__check" aria-hidden="true"></span>
					<span><?php echo esc_html( $step ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="enquiries__status">
			<p class="enquiries__status-live">
				<span class="enquiries__dot" aria-hidden="true"></span>
				<?php esc_html_e( 'Currently accepting new work.', 'alex-theme' ); ?>
			</p>
			<p class="enquiries__status-note"><?php esc_html_e( 'I take on a limited number of projects at a time so each one gets proper focus.', 'alex-theme' ); ?></p>
		</div>
	</div>

	<div class="enquiries__form-wrap rv rv2">
		<h2 class="s-h"><?php esc_html_e( 'Send an enquiry', 'alex-theme' ); ?></h2>
		<p class="enquiries__form-intro"><?php esc_html_e( 'A few details are enough to start — the business, the rough scope, and anything already decided.', 'alex-theme' ); ?></p>
		<form class="enquiries__form" action="#" method="post" novalidate>
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
				<span><?php esc_html_e( 'Website URL', 'alex-theme' ); ?></span>
				<input type="url" name="website" placeholder="<?php esc_attr_e( 'Optional', 'alex-theme' ); ?>" autocomplete="url">
			</label>
			<label class="enq-field enq-field--full">
				<span><?php esc_html_e( 'Project budget', 'alex-theme' ); ?></span>
				<select name="budget" required>
					<option value=""><?php esc_html_e( 'Please select…', 'alex-theme' ); ?></option>
					<option value="under-3k"><?php esc_html_e( 'Under £3,000', 'alex-theme' ); ?></option>
					<option value="3-6k"><?php esc_html_e( '£3,000 – £6,000', 'alex-theme' ); ?></option>
					<option value="6-12k"><?php esc_html_e( '£6,000 – £12,000', 'alex-theme' ); ?></option>
					<option value="12k-plus"><?php esc_html_e( '£12,000+', 'alex-theme' ); ?></option>
					<option value="unsure"><?php esc_html_e( 'Not sure yet', 'alex-theme' ); ?></option>
				</select>
			</label>
			<label class="enq-field enq-field--full">
				<span><?php esc_html_e( 'About the project', 'alex-theme' ); ?></span>
				<textarea name="message" rows="5" placeholder="<?php esc_attr_e( 'A rough description of the business and what you need is plenty to start with.', 'alex-theme' ); ?>" required></textarea>
			</label>
			<button type="submit" class="btn btn-primary enquiries__submit"><?php esc_html_e( 'Send an enquiry', 'alex-theme' ); ?></button>
			<p class="enquiries__disclaimer"><?php esc_html_e( 'Your details stay with me. No mailing lists, no sales sequences.', 'alex-theme' ); ?></p>
		</form>
	</div>
</section>
<?php else : ?>
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
<?php endif; ?>
