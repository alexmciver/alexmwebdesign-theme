<?php
/**
 * Approach block — conversation to handover.
 */
$steps = array(
	array(
		'label' => 'One',
		'title' => 'Conversation',
		'body'  => "Thirty minutes, no pitch. I ask about the business before the website, and I will tell you honestly if I'm not the right fit.",
	),
	array(
		'label' => 'Two',
		'title' => 'Proposal',
		'body'  => "A written scope with a single fixed figure. Everything included is listed. Nothing appears later that wasn't agreed.",
	),
	array(
		'label' => 'Three',
		'title' => 'Build',
		'body'  => 'A staging site from week one, regular written updates, and your feedback shaping each stage rather than arriving at the end.',
	),
	array(
		'label' => 'Four',
		'title' => 'Handover',
		'body'  => 'Launch, a recorded walkthrough, written documentation, and a training session so the site is genuinely yours.',
	),
);
?>
<section id="approach" class="approach" aria-label="<?php esc_attr_e( 'Approach', 'alex-theme' ); ?>">
	<div class="rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Approach', 'alex-theme' ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( __( 'From first conversation to <em>handover</em>', 'alex-theme' ) ); ?></h2>
	</div>

	<div class="approach__grid">
		<?php foreach ( $steps as $i => $step ) : ?>
			<div class="approach__step rv rv<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
				<p class="approach__label"><?php echo esc_html( $step['label'] ); ?></p>
				<h3 class="approach__title"><?php echo esc_html( $step['title'] ); ?></h3>
				<p class="approach__body"><?php echo esc_html( $step['body'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>
