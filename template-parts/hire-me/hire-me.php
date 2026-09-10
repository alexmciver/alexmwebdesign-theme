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
	$default_heading     = 'Rather <em>talk?</em>';
	$default_subheading  = 'Book a short introductory call directly in the calendar. No preparation needed — tell me about the business and we\'ll see if there\'s a fit.';
	$default_primary_text = 'Book a call';
	$default_primary_url  = $calendly;
	$default_secondary_text = '';
	$default_secondary_url  = '';
	$default_meta        = 'Monday to Friday · 9am–5pm London';
} elseif ( 'about' === $variant ) {
	$default_heading     = 'Shall we <em>talk?</em>';
	$default_subheading  = "A free thirty-minute call to see if we're a good fit — no pitch, no obligation.";
	$default_primary_text = "Let's work together";
	$default_primary_url  = $contact_url;
	$default_secondary_text = 'Say hello';
	$default_secondary_url  = $calendly;
	$default_meta        = '';
} elseif ( 'services' === $variant ) {
	$default_heading     = "Let's scope it properly.";
	$default_subheading  = 'A thirty-minute conversation, then a written proposal with one figure and a clear scope. No obligation either way.';
	$default_primary_text = 'Start a conversation';
	$default_primary_url  = $contact_url;
	$default_secondary_text = 'Book a call';
	$default_secondary_url  = $calendly;
	$default_meta        = '';
} else {
	$default_heading     = 'Something similar in mind?';
	$default_subheading  = "If you're planning a WordPress or Shopify build, I'd be glad to talk it through.";
	$default_primary_text = 'Start a project';
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
	<div class="hire-me__inner rv">
		<h2 class="hire-me__title"><?php echo wp_kses_post( $heading ); ?></h2>
		<p class="hire-me__sub"><?php echo esc_html( $subheading ); ?></p>
		<?php if ( $has_primary || $has_secondary ) : ?>
			<div class="hire-me__btns">
				<?php if ( $has_primary ) : ?>
					<a href="<?php echo esc_url( $primary['button_url'] ); ?>" class="btn <?php echo esc_attr( $primary_class ); ?>"<?php echo false !== stripos( (string) $primary['button_url'], 'calendly.com' ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $primary['button_text'] ); ?></a>
				<?php endif; ?>
				<?php if ( $has_secondary ) : ?>
					<a href="<?php echo esc_url( $secondary['button_url'] ); ?>" class="btn btn-outline-white"<?php echo false !== stripos( (string) $secondary['button_url'], 'calendly.com' ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $secondary['button_text'] ); ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( $meta ) : ?>
			<p class="hire-me__meta"><?php echo esc_html( $meta ); ?></p>
		<?php endif; ?>
	</div>
</section>
