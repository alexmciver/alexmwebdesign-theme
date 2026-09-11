<?php
/**
 * Approach block — process steps, or about-page story.
 */
$layout = alex_field( 'layout', is_page( 'about' ) ? 'story' : 'process' );

if ( 'story' === $layout ) :
	$story_eyebrow  = alex_field( 'story_eyebrow', 'Background' );
	$story_heading  = alex_field( 'story_heading', 'How I got here' );
	$cv_timeline = function_exists( 'alex_cv_timeline_rows' ) ? alex_cv_timeline_rows() : array();
	$timeline    = ! empty( $cv_timeline )
		? $cv_timeline
		: alex_field(
			'timeline',
			array(
				array(
					'date'  => 'May 2026 – Present',
					'title' => 'Developer',
					'org'   => 'Wade Digital, Remote',
					'body'  => 'Create custom plugins and functionality across WordPress projects. Integrate forms, CRMs, analytics, and automation platforms.',
				),
				array(
					'date'  => '2020 – Present',
					'title' => 'Freelance Web Developer',
					'org'   => 'Alex M Web Design, London',
					'body'  => 'Independent projects for small businesses — WordPress redesigns, Shopify stores, SEO audits and ongoing care.',
				),
				array(
					'date'  => 'July 2024 – May 2026',
					'title' => 'Developer',
					'org'   => 'Hewitt Matthews, Remote',
					'body'  => 'Architect and maintain high-performance WordPress ecosystems, prioritising enterprise-grade security and page speed.',
				),
			)
		);
	$values_eyebrow = alex_field( 'values_eyebrow', 'Approach' );
	$values_heading = alex_field( 'values_heading', 'How I work' );
	$values         = alex_field(
		'values',
		array(
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
		)
	);
	?>
<section id="approach" class="approach approach--about" aria-label="<?php esc_attr_e( 'Background and approach', 'alex-theme' ); ?>">
	<div class="about-story__col rv">
		<p class="s-eyebrow"><?php echo esc_html( $story_eyebrow ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( $story_heading ); ?></h2>
		<div class="about-timeline">
			<?php foreach ( $timeline as $i => $item ) : ?>
				<article class="about-tl rv rv<?php echo esc_attr( (string) min( $i + 1, 3 ) ); ?>">
					<?php if ( ! empty( $item['date'] ) ) : ?>
						<p class="about-tl__date"><?php echo esc_html( $item['date'] ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $item['title'] ) ) : ?>
						<h3 class="about-tl__title"><?php echo esc_html( $item['title'] ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $item['org'] ) ) : ?>
						<p class="about-tl__org"><?php echo esc_html( $item['org'] ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $item['body'] ) ) : ?>
						<p class="about-tl__body"><?php echo esc_html( $item['body'] ); ?></p>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="about-story__col rv rv2">
		<p class="s-eyebrow"><?php echo esc_html( $values_eyebrow ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( $values_heading ); ?></h2>
		<div class="about-values">
			<?php foreach ( $values as $i => $value ) : ?>
				<article class="about-value rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
					<?php if ( ! empty( $value['title'] ) ) : ?>
						<h3 class="about-value__title"><?php echo esc_html( $value['title'] ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $value['body'] ) ) : ?>
						<p class="about-value__body"><?php echo esc_html( $value['body'] ); ?></p>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php else :
	$eyebrow = alex_field( 'eyebrow', 'Approach' );
	$heading = alex_field( 'heading', 'From first conversation to <em>handover</em>' );
	$steps   = alex_field(
		'steps',
		array(
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
		)
	);
	?>
<section id="approach" class="approach" aria-label="<?php esc_attr_e( 'Approach', 'alex-theme' ); ?>">
	<div class="rv">
		<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( $heading ); ?></h2>
	</div>

	<div class="approach__grid">
		<?php foreach ( $steps as $i => $step ) : ?>
			<?php
			$img = alex_theme_image( 'approach-0' . (string) ( $i + 1 ) );
			?>
			<div class="approach__step rv rv<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
				<?php if ( $img ) : ?>
					<figure class="approach__media">
						<img src="<?php echo esc_url( $img ); ?>" alt="" width="400" height="300" loading="lazy" decoding="async" />
					</figure>
				<?php endif; ?>
				<?php if ( ! empty( $step['label'] ) ) : ?>
					<p class="approach__label"><?php echo esc_html( $step['label'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $step['title'] ) ) : ?>
					<h3 class="approach__title"><?php echo esc_html( $step['title'] ); ?></h3>
				<?php endif; ?>
				<?php if ( ! empty( $step['body'] ) ) : ?>
					<p class="approach__body"><?php echo esc_html( $step['body'] ); ?></p>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<?php endif; ?>
