<?php
/**
 * Enquiries block — contact details and enquiry form,
 * or contact-page process + form layout.
 */
$layout = alex_field( 'layout', is_page( 'contact' ) ? 'contact' : 'home' );

/**
 * Resolve a Contact Form 7 form ID from an ACF override or form title.
 *
 * @param int|string $cf7_id Optional form ID from the block.
 * @param string     $title  Fallback form title.
 * @return int
 */
$alex_enquiries_cf7_id = static function ( $cf7_id, $title ) {
	if ( $cf7_id ) {
		return (int) $cf7_id;
	}
	if ( ! post_type_exists( 'wpcf7_contact_form' ) ) {
		return 0;
	}
	$forms = get_posts(
		array(
			'post_type'      => 'wpcf7_contact_form',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		)
	);
	foreach ( $forms as $form_post ) {
		if ( $form_post->post_title === $title ) {
			return (int) $form_post->ID;
		}
	}
	return 0;
};

add_filter( 'wpcf7_autop_or_not', '__return_false' );

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
	$cf7_id       = $alex_enquiries_cf7_id( alex_field( 'cf7_form_id', '' ), 'Contact enquiry' );
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
		<?php if ( $cf7_id ) : ?>
			<?php echo do_shortcode( sprintf( '[contact-form-7 id="%d" html_class="enquiries__form"]', $cf7_id ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CF7 markup. ?>
			<?php if ( $disclaimer ) : ?>
				<p class="enquiries__disclaimer"><?php echo esc_html( $disclaimer ); ?></p>
			<?php endif; ?>
		<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
			<p class="enquiries__form-missing"><?php esc_html_e( 'Add a Contact Form 7 form titled “Contact enquiry”, or set a form ID in this block.', 'alex-theme' ); ?></p>
		<?php endif; ?>
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
	$cf7_id         = $alex_enquiries_cf7_id( alex_field( 'cf7_form_id', '' ), 'Home enquiry' );
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

	<?php if ( $cf7_id ) : ?>
		<div class="enquiries__form-slot rv rv2">
			<?php echo do_shortcode( sprintf( '[contact-form-7 id="%d" html_class="enquiries__form"]', $cf7_id ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CF7 markup. ?>
		</div>
	<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
		<p class="enquiries__form-missing rv rv2"><?php esc_html_e( 'Add a Contact Form 7 form titled “Home enquiry”, or set a form ID in this block.', 'alex-theme' ); ?></p>
	<?php endif; ?>
</section>
<?php endif; ?>
