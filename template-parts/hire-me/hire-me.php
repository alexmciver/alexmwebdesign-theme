<?php
/**
 * Hire Me block — CTA band for work, services, about and contact pages.
 */
$calendly    = 'https://calendly.com/alexmwebdesign/1-hour-website-chat';
$contact_url = alex_page_url( 'contact' );
$services_url = alex_page_url( 'services' );

$default_variant = 'work';
if ( is_page( 'contact' ) ) {
	$default_variant = 'contact';
} elseif ( is_page( 'about' ) ) {
	$default_variant = 'about';
} elseif ( is_page( 'services' ) ) {
	$default_variant = 'services';
}

$variant = alex_field( 'variant', $default_variant );
$variant = is_string( $variant ) ? $variant : $default_variant;

if ( 'contact' === $variant ) {
	$default_heading     = 'Prefer a <em>conversation</em>?';
	$default_subheading  = 'A short introductory call — no pitch deck, no obligation. Tell me about the business and we\'ll decide if it\'s a fit.';
	$default_primary_text = 'Book a discovery call';
	$default_primary_url  = $calendly;
	$default_secondary_text = '';
	$default_secondary_url  = '';
	$default_meta        = 'Weekdays · London hours';
} elseif ( 'about' === $variant ) {
	$default_heading     = 'Ready when <em>you</em> are.';
	$default_subheading  = 'A thirty-minute call to see whether we should work together. Direct, unhurried, and without a sales script.';
	$default_primary_text = 'Start an enquiry';
	$default_primary_url  = $contact_url;
	$default_secondary_text = 'Book a call';
	$default_secondary_url  = $calendly;
	$default_meta        = '';
} elseif ( 'services' === $variant ) {
	$default_heading     = 'One conversation. One figure.';
	$default_subheading  = 'We talk, then you receive a written proposal with a fixed fee and a clear scope. Nothing starts until that is agreed.';
	$default_primary_text = 'Enquire about a project';
	$default_primary_url  = $contact_url;
	$default_secondary_text = 'Book a call';
	$default_secondary_url  = $calendly;
	$default_meta        = '';
} else {
	$default_heading     = 'Commission something <em>similar</em>.';
	$default_subheading  = 'If you need a WordPress or Shopify site built properly — with a fixed fee and a developer who stays accountable — start here.';
	$default_primary_text = 'Enquire about a project';
	$default_primary_url  = $contact_url;
	$default_secondary_text = 'View services';
	$default_secondary_url  = $services_url;
	$default_meta        = '';
}

$heading    = alex_field( 'heading', $default_heading );
$subheading = alex_field( 'subheading', $default_subheading );
$primary    = alex_button( get_field( 'primary_button' ), $default_primary_text, $default_primary_url );
$secondary  = alex_button( get_field( 'secondary_button' ), $default_secondary_text, $default_secondary_url );
$meta       = alex_field( 'meta', $default_meta );

$modifier = '';
if ( 'contact' === $variant ) {
	$modifier = ' hire-me--contact';
} elseif ( 'about' === $variant ) {
	$modifier = ' hire-me--about';
} elseif ( 'services' === $variant ) {
	$modifier = ' hire-me--services';
}

$primary_class = 'btn-white';
if ( 'contact' === $variant || 'about' === $variant ) {
	$primary_class = 'btn-primary';
} elseif ( 'services' === $variant ) {
	$primary_class = 'btn-ink';
}

$has_primary   = ! empty( $primary['button_text'] ) && ! empty( $primary['button_url'] );
$has_secondary = ! empty( $secondary['button_text'] ) && ! empty( $secondary['button_url'] );
?>
<section class="hire-me<?php echo esc_attr( $modifier ); ?>" aria-label="<?php esc_attr_e( 'Start a project', 'alex-theme' ); ?>">
	<?php
	$hire_bg = alex_theme_image( 'hire-bg' );
	if ( $hire_bg && 'contact' !== $variant ) :
		?>
		<div class="hire-me__bg" aria-hidden="true">
			<img src="<?php echo esc_url( $hire_bg ); ?>" alt="" width="2000" height="1200" loading="lazy" decoding="async" />
		</div>
	<?php endif; ?>
	<div class="hire-me__inner rv">
		<p class="hire-me__eyebrow"><?php esc_html_e( 'Independent WordPress & Shopify', 'alex-theme' ); ?></p>
		<h2 class="hire-me__title"><?php echo wp_kses_post( $heading ); ?></h2>
		<p class="hire-me__sub"><?php echo esc_html( $subheading ); ?></p>
		<?php if ( $has_primary || $has_secondary ) : ?>
			<div class="hire-me__btns">
				<?php if ( $has_primary ) : ?>
					<?php $primary_ext = alex_external_link_attrs( $primary['button_url'] ); ?>
					<a href="<?php echo esc_url( $primary['button_url'] ); ?>" class="btn <?php echo esc_attr( $primary_class ); ?>"<?php echo $primary_ext; ?>><?php echo esc_html( $primary['button_text'] ); ?><?php if ( $primary_ext ) : ?><span class="u-sr-only"><?php esc_html_e( ' (opens in a new tab)', 'alex-theme' ); ?></span><?php endif; ?></a>
				<?php endif; ?>
				<?php if ( $has_secondary ) : ?>
					<?php $secondary_ext = alex_external_link_attrs( $secondary['button_url'] ); ?>
					<a href="<?php echo esc_url( $secondary['button_url'] ); ?>" class="btn btn-outline-white"<?php echo $secondary_ext; ?>><?php echo esc_html( $secondary['button_text'] ); ?><?php if ( $secondary_ext ) : ?><span class="u-sr-only"><?php esc_html_e( ' (opens in a new tab)', 'alex-theme' ); ?></span><?php endif; ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( $meta ) : ?>
			<p class="hire-me__meta"><?php echo esc_html( $meta ); ?></p>
		<?php endif; ?>
	</div>
</section>
