<?php
/**
 * Contact block — contact page hero with direct details.
 */
$calendly = 'https://calendly.com/alexmwebdesign/1-hour-website-chat';

$details = array(
	array(
		'label' => __( 'Email', 'alex-theme' ),
		'type'  => 'email',
		'value' => 'info@alexmwebdesign.co.uk',
		'href'  => 'mailto:info@alexmwebdesign.co.uk',
	),
	array(
		'label' => __( 'Telephone', 'alex-theme' ),
		'type'  => 'tel',
		'value' => '+44 7804 187711',
		'href'  => 'tel:+447804187711',
	),
	array(
		'label' => __( 'Calendar', 'alex-theme' ),
		'type'  => 'link',
		'value' => __( 'Book a call', 'alex-theme' ) . ' →',
		'href'  => $calendly,
	),
	array(
		'label' => __( 'Location', 'alex-theme' ),
		'type'  => 'text',
		'value' => __( 'London / Remote', 'alex-theme' ),
	),
);
?>
<section class="contact-hero" aria-label="<?php esc_attr_e( 'Contact', 'alex-theme' ); ?>">
	<div class="contact-hero__line" aria-hidden="true"></div>
	<div class="contact-hero__left rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Contact', 'alex-theme' ); ?></p>
		<h1><?php echo wp_kses_post( __( "Let's talk about <em>the work.</em>", 'alex-theme' ) ); ?></h1>
		<p class="contact-hero__sub"><?php esc_html_e( 'Every enquiry is read and answered by me, within one working day. No automated replies, no sales sequences.', 'alex-theme' ); ?></p>
	</div>
	<div class="contact-hero__right rv rv2">
		<ul class="contact-hero__details">
			<?php foreach ( $details as $row ) : ?>
				<li>
					<span class="contact-hero__label"><?php echo esc_html( $row['label'] ); ?></span>
					<span class="contact-hero__value">
						<?php if ( 'text' === $row['type'] ) : ?>
							<?php echo esc_html( $row['value'] ); ?>
						<?php else : ?>
							<a href="<?php echo esc_url( $row['href'] ); ?>"<?php echo 'link' === $row['type'] ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $row['value'] ); ?></a>
						<?php endif; ?>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
