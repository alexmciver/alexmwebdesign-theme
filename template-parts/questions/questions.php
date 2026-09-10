<?php
/**
 * Questions block — FAQ accordion.
 */
$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );
$is_services  = is_page( 'services' );

if ( $is_services ) {
	$faqs = array(
		array(
			'q' => "Why aren't prices published?",
			'a' => "Because every build is different. After a short conversation I send a written proposal with one figure — so you're comparing a real scope, not a menu price.",
		),
		array(
			'q' => 'Fixed price or hourly?',
			'a' => 'Fixed. The proposal lists what is included. If the scope changes later, we agree the adjustment in writing before any extra work starts.',
		),
		array(
			'q' => 'Do you work with existing Divi 5 sites?',
			'a' => 'Yes. Refinements, performance work, migrations and ongoing care are all possible on sites that are already live — Divi 5 included.',
		),
		array(
			'q' => 'Will I be able to update the site myself?',
			'a' => "That's the point. Content areas are structured so your team can edit without calling a developer, and you get a walkthrough at handover.",
		),
		array(
			'q' => 'Is ongoing care necessary?',
			'a' => 'Not required. Many clients run the site themselves after launch. Care is there when you would rather someone else handle hosting, updates and monitoring.',
		),
		array(
			'q' => 'What if something breaks after launch?',
			'a' => 'Launch includes a short warranty window for defects in the work delivered. Beyond that, care arrangements cover ongoing fixes and improvements.',
		),
	);
} else {
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
}
?>
<section id="questions" class="questions" aria-label="<?php esc_attr_e( 'Frequently asked questions', 'alex-theme' ); ?>">
	<div class="questions__left rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Questions', 'alex-theme' ); ?></p>
		<?php if ( $is_services ) : ?>
			<h2 class="s-h"><?php echo wp_kses_post( __( 'Before we <em>begin</em>', 'alex-theme' ) ); ?></h2>
			<p class="s-body"><?php esc_html_e( 'The things clients usually want settled first.', 'alex-theme' ); ?></p>
		<?php else : ?>
			<h2 class="s-h"><?php echo wp_kses_post( __( 'Things worth <em>asking</em>', 'alex-theme' ) ); ?></h2>
			<p class="s-body"><?php esc_html_e( 'The questions that come up most often before a project starts.', 'alex-theme' ); ?></p>
		<?php endif; ?>
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
