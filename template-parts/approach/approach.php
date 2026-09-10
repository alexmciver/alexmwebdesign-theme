<?php
/**
 * Approach block — process steps, or about-page story.
 */
$is_about = is_page( 'about' );

if ( $is_about ) :
	$timeline = array(
		array(
			'date'  => '2022 – Present',
			'title' => 'Lead Developer & Support Specialist',
			'org'   => 'Hewitt Matthews, London',
			'body'  => 'Managing the full support desk and delivering bespoke WordPress and Shopify builds for performance marketing clients — plugin development, WooCommerce, server config and CDN management.',
		),
		array(
			'date'  => '2020 – Present',
			'title' => 'Freelance Web Developer',
			'org'   => 'Alex M Web Design, London',
			'body'  => 'Independent projects for small businesses — WordPress redesigns, Shopify stores, SEO audits and ongoing care. Thirty-plus sites delivered.',
		),
		array(
			'date'  => '2019 – 2022',
			'title' => 'Junior Web Developer',
			'org'   => 'Digital Agency, London',
			'body'  => 'First professional role — building WordPress themes, learning client communication, and discovering that the best code is the kind clients never have to think about.',
		),
	);

	$values = array(
		array(
			'title' => 'Plain English, always',
			'body'  => "No jargon, no acronyms without explanation. You should always understand what's happening and why.",
		),
		array(
			'title' => 'No challenge is too big',
			'body'  => "If I don't know something, I'll find out. If it can't be done one way, I'll find another.",
		),
		array(
			'title' => 'Transparent pricing',
			'body'  => "Fixed quotes before we start. No scope creep surprises. You know what you're paying and what you're getting.",
		),
		array(
			'title' => 'Speed and reliability',
			'body'  => "I reply within one working day. I hit deadlines. You'll never be left chasing a progress update.",
		),
	);
	?>
<section id="approach" class="approach approach--about" aria-label="<?php esc_attr_e( 'Background and approach', 'alex-theme' ); ?>">
	<div class="about-story__col rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Background', 'alex-theme' ); ?></p>
		<h2 class="s-h"><?php esc_html_e( 'How I got here', 'alex-theme' ); ?></h2>
		<div class="about-timeline">
			<?php foreach ( $timeline as $i => $item ) : ?>
				<article class="about-tl rv rv<?php echo esc_attr( (string) min( $i + 1, 3 ) ); ?>">
					<p class="about-tl__date"><?php echo esc_html( $item['date'] ); ?></p>
					<h3 class="about-tl__title"><?php echo esc_html( $item['title'] ); ?></h3>
					<p class="about-tl__org"><?php echo esc_html( $item['org'] ); ?></p>
					<p class="about-tl__body"><?php echo esc_html( $item['body'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="about-story__col rv rv2">
		<p class="s-eyebrow"><?php esc_html_e( 'Approach', 'alex-theme' ); ?></p>
		<h2 class="s-h"><?php esc_html_e( 'How I work', 'alex-theme' ); ?></h2>
		<div class="about-values">
			<?php foreach ( $values as $i => $value ) : ?>
				<article class="about-value rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
					<h3 class="about-value__title"><?php echo esc_html( $value['title'] ); ?></h3>
					<p class="about-value__body"><?php echo esc_html( $value['body'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php else :
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
<?php endif; ?>
