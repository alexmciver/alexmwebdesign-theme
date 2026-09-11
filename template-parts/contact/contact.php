<?php
/**
 * Contact block — contact page hero with direct details.
 */
$calendly = 'https://calendly.com/alexmwebdesign/1-hour-website-chat';

$eyebrow    = alex_field( 'eyebrow', 'Contact' );
$heading    = alex_field( 'heading', "Let's talk about <em>the work.</em>" );
$subheading = alex_field( 'subheading', 'Every enquiry is read by me within one working day. If it isn\'t a fit, I\'ll say so — and point you somewhere better.' );
$details    = alex_field(
	'details',
	array(
		array(
			'label' => 'Email',
			'type'  => 'email',
			'value' => 'info@alexmwebdesign.co.uk',
			'url'   => '',
		),
		array(
			'label' => 'Telephone',
			'type'  => 'tel',
			'value' => '+44 7804 187711',
			'url'   => '',
		),
		array(
			'label' => 'Calendar',
			'type'  => 'link',
			'value' => 'Book a discovery call →',
			'url'   => $calendly,
		),
		array(
			'label' => 'Location',
			'type'  => 'text',
			'value' => 'London / Remote',
			'url'   => '',
		),
	)
);
?>
<section class="contact-hero" aria-label="<?php esc_attr_e( 'Contact', 'alex-theme' ); ?>">
	<div class="contact-hero__line" aria-hidden="true"></div>
	<div class="contact-hero__left rv">
		<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h1><?php echo wp_kses_post( $heading ); ?></h1>
		<p class="contact-hero__sub"><?php echo esc_html( $subheading ); ?></p>
	</div>
	<div class="contact-hero__right rv rv2">
		<ul class="contact-hero__details">
			<?php foreach ( $details as $row ) : ?>
				<?php
				$label = isset( $row['label'] ) ? (string) $row['label'] : '';
				$type  = isset( $row['type'] ) ? (string) $row['type'] : 'text';
				$value = isset( $row['value'] ) ? (string) $row['value'] : '';
				$url   = isset( $row['url'] ) ? (string) $row['url'] : '';

				if ( ! $value && ! $label ) {
					continue;
				}

				$href = $url;
				if ( ! $href ) {
					if ( 'email' === $type && $value ) {
						$href = 'mailto:' . $value;
					} elseif ( 'tel' === $type && $value ) {
						$href = 'tel:' . preg_replace( '/[^\d+]/', '', $value );
					}
				}

				$blank_attrs = alex_external_link_attrs( $href );
				$new_tab     = '' !== $blank_attrs;
				?>
				<li>
					<?php if ( $label ) : ?>
						<span class="contact-hero__label"><?php echo esc_html( $label ); ?></span>
					<?php endif; ?>
					<span class="contact-hero__value">
						<?php if ( 'text' === $type || ! $href ) : ?>
							<?php echo esc_html( $value ); ?>
						<?php else : ?>
							<a href="<?php echo esc_url( $href ); ?>"<?php echo $blank_attrs; ?>><?php echo esc_html( $value ); ?><?php if ( $new_tab ) : ?><span class="u-sr-only"><?php esc_html_e( ' (opens in a new tab)', 'alex-theme' ); ?></span><?php endif; ?></a>
						<?php endif; ?>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
