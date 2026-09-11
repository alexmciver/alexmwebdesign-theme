<?php
/**
 * Questions block — FAQ accordion.
 */
$contact_url = alex_page_url( 'contact' );

if ( is_page( 'contact' ) ) {
	$default_eyebrow    = 'Before you write';
	$default_heading    = 'Quick <em>answers</em>';
	$default_body       = 'The things most people want to know before getting in touch.';
	$default_link_text  = '';
	$default_link_url   = '';
	$default_faqs       = array(
		array(
			'question' => 'How quickly will you reply?',
			'answer'   => 'Within one working day. Every enquiry is read and answered by me — no autoresponders, no sales sequences.',
		),
		array(
			'question' => 'Do I need a brief ready?',
			'answer'   => "No. A sentence or two about the business and what you need is enough to start. We'll shape a proper brief together if it looks like a fit.",
		),
		array(
			'question' => 'Which city are you based in?',
			'answer'   => 'Clapham, London — though most of the work happens remotely. Calls are scheduled around London hours.',
		),
		array(
			'question' => "I'm not in London — does that matter?",
			'answer'   => "Not at all. Most projects are fully remote. As long as we can overlap for calls, location isn't a barrier.",
		),
		array(
			'question' => 'What if I only need something small?',
			'answer'   => "Small, well-scoped jobs are welcome — fixes, refinements, audits. Tell me what you need and I'll say honestly whether it's a fit.",
		),
	);
} elseif ( is_page( 'services' ) ) {
	$default_eyebrow    = 'Questions';
	$default_heading    = 'Before we <em>begin</em>';
	$default_body       = 'The things clients usually want settled first.';
	$default_link_text  = 'Ask something else';
	$default_link_url   = $contact_url;
	$default_faqs       = array(
		array(
			'question' => "Why aren't prices published?",
			'answer'   => "Because every build is different. After a short conversation I send a written proposal with one figure — so you're comparing a real scope, not a menu price.",
		),
		array(
			'question' => 'Fixed price or hourly?',
			'answer'   => 'Fixed. The proposal lists what is included. If the scope changes later, we agree the adjustment in writing before any extra work starts.',
		),
		array(
			'question' => 'Do you work with existing Divi 5 sites?',
			'answer'   => 'Yes. Refinements, performance work, migrations and ongoing care are all possible on sites that are already live — Divi 5 included.',
		),
		array(
			'question' => 'Will I be able to update the site myself?',
			'answer'   => "That's the point. Content areas are structured so your team can edit without calling a developer, and you get a walkthrough at handover.",
		),
		array(
			'question' => 'Is ongoing care necessary?',
			'answer'   => 'Not required. Many clients run the site themselves after launch. Care is there when you would rather someone else handle hosting, updates and monitoring.',
		),
		array(
			'question' => 'What if something breaks after launch?',
			'answer'   => 'Launch includes a short warranty window for defects in the work delivered. Beyond that, care arrangements cover ongoing fixes and improvements.',
		),
	);
} else {
	$default_eyebrow    = 'Questions';
	$default_heading    = 'Things worth <em>asking</em>';
	$default_body       = 'The questions that come up most often before a project starts.';
	$default_link_text  = 'Ask something else';
	$default_link_url   = $contact_url;
	$default_faqs       = array(
		array(
			'question' => 'How does pricing work?',
			'answer'   => 'Every project gets a fixed figure after the discovery call. The written proposal lists what is included — no hourly meter, no surprises later.',
		),
		array(
			'question' => 'How long does a project take?',
			'answer'   => 'Most builds land between four and ten weeks depending on scope. You get a clear timeline in the proposal before anything starts.',
		),
		array(
			'question' => "I'm not technical. Will I follow what's happening?",
			'answer'   => 'Yes. Updates are written in plain English, decisions are explained, and nothing ships without your sign-off.',
		),
		array(
			'question' => 'Can you improve an existing site rather than rebuild?',
			'answer'   => 'Often. Audits, performance work, theme refinements and conversions can all be done on what you already have when the foundations are sound.',
		),
		array(
			'question' => 'What happens after launch?',
			'answer'   => 'You get documentation, a walkthrough and optional ongoing care — hosting, updates and a developer who already knows the site.',
		),
		array(
			'question' => 'WordPress or Shopify?',
			'answer'   => "It depends on the business. I'll recommend the right platform after hearing what you're selling and how you want to run it.",
		),
	);
}

$eyebrow = alex_field( 'eyebrow', $default_eyebrow );
$heading = alex_field( 'heading', $default_heading );
$body    = alex_field( 'body', $default_body );
$link    = alex_button( get_field( 'link' ), $default_link_text, $default_link_url );
$faqs    = alex_field( 'faqs', $default_faqs );
?>
<section id="questions" class="questions" aria-label="<?php esc_attr_e( 'Frequently asked questions', 'alex-theme' ); ?>">
	<div class="questions__left rv">
		<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( $heading ); ?></h2>
		<p class="s-body"><?php echo esc_html( $body ); ?></p>
		<?php if ( ! empty( $link['button_text'] ) && ! empty( $link['button_url'] ) ) : ?>
			<a href="<?php echo esc_url( $link['button_url'] ); ?>" class="questions__link"><?php echo esc_html( $link['button_text'] ); ?> →</a>
		<?php endif; ?>
	</div>

	<div class="questions__list" data-faq>
		<?php foreach ( $faqs as $i => $faq ) : ?>
			<?php
			$question = isset( $faq['question'] ) ? (string) $faq['question'] : '';
			$answer   = isset( $faq['answer'] ) ? (string) $faq['answer'] : '';
			if ( ! $question && ! $answer ) {
				continue;
			}
			?>
			<div class="faq-item rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
				<?php
				$faq_id    = 'faq-' . (string) ( $i + 1 );
				$panel_id  = $faq_id . '-panel';
				?>
				<button type="button" class="faq-q" id="<?php echo esc_attr( $faq_id ); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr( $panel_id ); ?>">
					<span><?php echo esc_html( $question ); ?></span>
					<span class="faq-ico" aria-hidden="true"></span>
				</button>
				<div class="faq-a" id="<?php echo esc_attr( $panel_id ); ?>" role="region" aria-labelledby="<?php echo esc_attr( $faq_id ); ?>" hidden>
					<?php if ( $answer ) : ?>
						<p><?php echo esc_html( $answer ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
