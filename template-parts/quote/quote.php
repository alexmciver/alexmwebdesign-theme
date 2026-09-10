<?php
/**
 * Quote block — orange statement band.
 */
$quote       = alex_field( 'quote', "No challenge is ever too big — and you will always know exactly what I'm doing, and why." );
$attribution = alex_field( 'attribution', 'Alex McIver' );
?>
<section class="quote" aria-label="<?php esc_attr_e( 'Quote', 'alex-theme' ); ?>">
	<blockquote class="quote__text rv"><?php echo esc_html( $quote ); ?></blockquote>
	<p class="quote__attr rv rv2"><?php echo esc_html( $attribution ); ?></p>
</section>
