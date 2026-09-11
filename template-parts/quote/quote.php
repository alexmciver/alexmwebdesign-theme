<?php
/**
 * Quote block — statement of standards.
 */
$quote       = alex_field( 'quote', "If it isn't clear, considered, and built to last — it doesn't leave my desk." );
$attribution = alex_field( 'attribution', 'Alex McIver · Independent developer' );
?>
<section class="quote" aria-label="<?php esc_attr_e( 'Quote', 'alex-theme' ); ?>">
	<blockquote class="quote__text rv"><?php echo esc_html( $quote ); ?></blockquote>
	<p class="quote__attr rv rv2"><?php echo esc_html( $attribution ); ?></p>
</section>
