<?php
/**
 * Enquiries block — contact details and enquiry form,
 * or contact-page process + form layout.
 */
$layout = alex_field( 'layout', is_page( 'contact' ) ? 'contact' : 'home' );

if ( 'contact' === $layout ) :
	$process_eyebrow = alex_field( 'process_eyebrow', 'Process' );
	$process_heading = alex_field( 'process_heading', 'A straightforward <em>process</em>' );
	$process_steps   = alex_field(
		'process_steps',
		array(
			array(
				'text' => "You'll hear back from me — not an assistant — within one working day.",
			),
			array(
				'text' => 'A short conversation to understand the business and what the site needs to do.',
			),
			array(
				'text' => "A written proposal with one figure and a clear scope. Nothing starts until that's agreed.",
			),
			array(
				'text' => "Work begins once we're both certain it's a good fit.",
			),
		)
	);
	$status_live  = alex_field( 'status_live', 'Currently accepting new work.' );
	$status_note  = alex_field( 'status_note', 'I take on a limited number of projects at a time so each one gets proper focus.' );
	$form_heading = alex_field( 'form_heading', 'Send an enquiry' );
	$form_intro   = alex_field( 'form_intro', 'A few details are enough to start — the business, the rough scope, and anything already decided.' );
	$disclaimer   = alex_field( 'disclaimer', 'Your details stay with me. No mailing lists, no sales sequences.' );
	?>
<section id="enquiries" class="enquiries enquiries--contact" aria-label="<?php esc_attr_e( 'Enquiry', 'alex-theme' ); ?>">
	<div class="enquiries__process rv">
		<p class="s-eyebrow"><?php echo esc_html( $process_eyebrow ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( $process_heading ); ?></h2>
		<ul class="enquiries__steps">
			<?php foreach ( $process_steps as $step ) : ?>
				<?php if ( empty( $step['text'] ) ) : ?>
					<?php continue; ?>
				<?php endif; ?>
				<li>
					<span class="enquiries__check" aria-hidden="true"></span>
					<span><?php echo esc_html( $step['text'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="enquiries__status">
			<p class="enquiries__status-live">
				<span class="enquiries__dot" aria-hidden="true"></span>
				<?php echo esc_html( $status_live ); ?>
			</p>
			<p class="enquiries__status-note"><?php echo esc_html( $status_note ); ?></p>
		</div>
	</div>

	<div class="enquiries__form-wrap rv rv2">
		<h2 class="s-h"><?php echo wp_kses_post( $form_heading ); ?></h2>
		<p class="enquiries__form-intro"><?php echo esc_html( $form_intro ); ?></p>
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
			<p class="enquiries__disclaimer"><?php echo esc_html( $disclaimer ); ?></p>
		</form>
	</div>
</section>
<?php else :
	$eyebrow        = alex_field( 'eyebrow', 'Enquiries' );
	$heading        = alex_field( 'heading', "Let's talk about what you're <em>building</em>" );
	$intro          = alex_field( 'intro', "I reply to everything personally, within one working day. If it isn't a fit I'll tell you, and point you somewhere better." );
	$email          = alex_field( 'email', 'info@alexmwebdesign.co.uk' );
	$telephone      = alex_field( 'telephone', '+44 7804 187711' );
	$calendar_url   = alex_field( 'calendar_url', 'https://calendly.com/alexmwebdesign/1-hour-website-chat' );
	$calendar_label = alex_field( 'calendar_label', 'Book a call' );
	$note           = alex_field( 'note', 'Client references available on request. Currently taking on a limited number of projects.' );
	$tel_href       = $telephone ? preg_replace( '/\s+/', '', $telephone ) : '';
	?>
<section id="enquiries" class="enquiries" aria-label="<?php esc_attr_e( 'Enquiries', 'alex-theme' ); ?>">
	<div class="enquiries__left rv">
		<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( $heading ); ?></h2>
		<p class="enquiries__intro"><?php echo esc_html( $intro ); ?></p>

		<ul class="enquiries__details">
			<?php if ( $email ) : ?>
				<li>
					<span class="enquiries__label"><?php esc_html_e( 'Email', 'alex-theme' ); ?></span>
					<a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
				</li>
			<?php endif; ?>
			<?php if ( $telephone ) : ?>
				<li>
					<span class="enquiries__label"><?php esc_html_e( 'Telephone', 'alex-theme' ); ?></span>
					<a href="<?php echo esc_url( 'tel:' . $tel_href ); ?>"><?php echo esc_html( $telephone ); ?></a>
				</li>
			<?php endif; ?>
			<?php if ( $calendar_url && $calendar_label ) : ?>
				<li>
					<span class="enquiries__label"><?php esc_html_e( 'Calendar', 'alex-theme' ); ?></span>
					<a href="<?php echo esc_url( $calendar_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $calendar_label ); ?> →</a>
				</li>
			<?php endif; ?>
		</ul>

		<p class="enquiries__note"><?php echo esc_html( $note ); ?></p>
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
