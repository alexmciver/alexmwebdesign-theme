<?php
/**
 * Questions block — FAQ accordion.
 */
$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );

$faqs = array(
	array(
		'q' => 'How does pricing work?',
		'a' => 'Every project gets a fixed figure after the discovery call. The written proposal lists what is included — no hourly meter, no surprises later.',
	),
	array(
		'q' => 'How long does a project take?',
		'a' => 'Most builds land between four and ten weeks depending on scope. You get a clear timeline in the proposal before anything starts.',
	),
	array(
		'q' => "I'm not technical. Will I follow what's happening?",
		'a' => 'Yes. Updates are written in plain English, decisions are explained, and nothing ships without your sign-off.',
	),
	array(
		'q' => 'Can you improve an existing site rather than rebuild?',
		'a' => 'Often. Audits, performance work, theme refinements and conversions can all be done on what you already have when the foundations are sound.',
	),
	array(
		'q' => 'What happens after launch?',
		'a' => 'You get documentation, a walkthrough and optional ongoing care — hosting, updates and a developer who already knows the site.',
	),
	array(
		'q' => 'WordPress or Shopify?',
		'a' => "It depends on the business. I'll recommend the right platform after hearing what you're selling and how you want to run it.",
	),
);
?>
<section id="questions" class="questions" aria-label="<?php esc_attr_e( 'Frequently asked questions', 'alex-theme' ); ?>">
	<div class="questions__left rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Questions', 'alex-theme' ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( __( 'Things worth <em>asking</em>', 'alex-theme' ) ); ?></h2>
		<p class="s-body"><?php esc_html_e( 'The questions that come up most often before a project starts.', 'alex-theme' ); ?></p>
		<a href="<?php echo esc_url( $contact_url ); ?>" class="questions__link"><?php esc_html_e( 'Ask something else', 'alex-theme' ); ?> →</a>
	</div>

	<div class="questions__list" data-faq>
		<?php foreach ( $faqs as $i => $faq ) : ?>
			<div class="faq-item rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
				<button type="button" class="faq-q" aria-expanded="false">
					<span><?php echo esc_html( $faq['q'] ); ?></span>
					<span class="faq-ico" aria-hidden="true"></span>
				</button>
				<div class="faq-a" hidden>
					<p><?php echo esc_html( $faq['a'] ); ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
