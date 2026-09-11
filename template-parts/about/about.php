<?php
/**
 * About block — about page hero and introduction.
 */
$contact_url = alex_page_url( 'contact' );
$calendly    = 'https://calendly.com/alexmwebdesign/1-hour-website-chat';

$eyebrow     = alex_field( 'eyebrow', 'About' );
$heading     = alex_field( 'heading', 'Alex <em>McIver</em>' );
$subheading  = alex_field( 'subheading', 'Independent WordPress and Shopify developer in London. Sites built with clear scope, a fixed fee, and the judgement that comes from doing this every day.' );
$primary     = alex_button( get_field( 'primary_button' ), 'Enquire about a project', $contact_url );
$secondary   = alex_button( get_field( 'secondary_button' ), 'Book a discovery call', $calendly );
$photo_label = alex_field( 'photo_label', 'Photo of Alex' );
$photo_url   = alex_field( 'photo_url', get_template_directory_uri() . '/assets/images/alex-portrait.webp' );
$intro_quote = alex_field( 'intro_quote', 'I build digital products with the same care as the business behind them.' );
$intro_text  = alex_field(
	'intro_text',
	'<p>I take on a limited number of WordPress and Shopify projects each year — enough to give each one proper attention, never enough to hand work down a chain.</p>'
	. '<p>By day I lead builds and support at <strong>Hewitt Matthews</strong>, a London performance marketing agency. Alongside that, I work directly with founders and marketers through <strong>Alex M Web Design</strong>.</p>'
	. '<p>Clients stay for the same reasons they hire me: plain English, considered decisions, and a site they can run without calling a developer for every change.</p>'
);
$stats = alex_field(
	'stats',
	array(
		array(
			'value' => '5+',
			'label' => 'Years of experience',
		),
		array(
			'value' => '30+',
			'label' => 'Projects completed',
		),
		array(
			'value' => '2',
			'label' => 'Platforms day-to-day',
		),
		array(
			'value' => '24h',
			'label' => 'Typical reply time',
		),
	)
);
$experience_label = alex_field( 'experience_label', 'Experience' );
$cv_experience    = function_exists( 'alex_cv_experience_rows' ) ? alex_cv_experience_rows() : array();
$experience       = ! empty( $cv_experience )
	? $cv_experience
	: alex_field(
		'experience',
		array(
			array(
				'role' => 'Developer · Wade Digital',
				'meta' => 'May 2026 – Present',
			),
			array(
				'role' => 'Freelance · Alex M Web Design',
				'meta' => '2020 – Present',
			),
			array(
				'role' => 'Developer · Hewitt Matthews',
				'meta' => 'July 2024 – May 2026',
			),
			array(
				'role' => 'Based in Clapham, London',
				'meta' => 'Remote-friendly',
			),
		)
	);

$has_primary   = ! empty( $primary['button_text'] ) && ! empty( $primary['button_url'] );
$has_secondary = ! empty( $secondary['button_text'] ) && ! empty( $secondary['button_url'] );
?>
<section class="about-hero" aria-label="<?php esc_attr_e( 'About Alex McIver', 'alex-theme' ); ?>">
	<div class="about-hero__line" aria-hidden="true"></div>
	<div class="about-hero__left rv">
		<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h1><?php echo wp_kses_post( $heading ); ?></h1>
		<p class="about-hero__sub"><?php echo esc_html( $subheading ); ?></p>
		<?php if ( $has_primary || $has_secondary ) : ?>
			<div class="about-hero__btns">
				<?php if ( $has_primary ) : ?>
					<?php $primary_ext = alex_external_link_attrs( $primary['button_url'] ); ?>
					<a href="<?php echo esc_url( $primary['button_url'] ); ?>" class="btn btn-primary"<?php echo $primary_ext; ?>><?php echo esc_html( $primary['button_text'] ); ?><?php if ( $primary_ext ) : ?><span class="u-sr-only"><?php esc_html_e( ' (opens in a new tab)', 'alex-theme' ); ?></span><?php endif; ?></a>
				<?php endif; ?>
				<?php if ( $has_secondary ) : ?>
					<?php $secondary_ext = alex_external_link_attrs( $secondary['button_url'] ); ?>
					<a href="<?php echo esc_url( $secondary['button_url'] ); ?>" class="btn btn-outline-white"<?php echo $secondary_ext; ?>><?php echo esc_html( $secondary['button_text'] ); ?><?php if ( $secondary_ext ) : ?><span class="u-sr-only"><?php esc_html_e( ' (opens in a new tab)', 'alex-theme' ); ?></span><?php endif; ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="about-hero__right rv rv2">
		<div class="about-hero__photo">
			<?php if ( $photo_url ) : ?>
				<img src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( $photo_label ); ?>" width="800" height="1000" loading="eager" decoding="async" />
			<?php else : ?>
				<span class="about-hero__photo-label"><?php echo esc_html( $photo_label ); ?></span>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="about-intro" aria-label="<?php esc_attr_e( 'Introduction', 'alex-theme' ); ?>">
	<div class="about-intro__copy rv">
		<h2 class="about-intro__quote"><?php echo esc_html( $intro_quote ); ?></h2>
		<div class="about-intro__text">
			<?php echo wp_kses_post( $intro_text ); ?>
		</div>
	</div>

	<div class="about-intro__aside rv rv2">
		<div class="about-stats">
			<?php foreach ( $stats as $stat ) : ?>
				<?php
				$value = isset( $stat['value'] ) ? (string) $stat['value'] : '';
				$label = isset( $stat['label'] ) ? (string) $stat['label'] : '';
				?>
				<?php if ( $value || $label ) : ?>
					<div class="about-stat">
						<?php if ( $value ) : ?>
							<span class="about-stat__n"><?php echo esc_html( $value ); ?></span>
						<?php endif; ?>
						<?php if ( $label ) : ?>
							<span class="about-stat__l"><?php echo esc_html( $label ); ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>

		<div class="about-exp">
			<p class="about-exp__label"><?php echo esc_html( $experience_label ); ?></p>
			<ul class="about-exp__list">
				<?php foreach ( $experience as $row ) : ?>
					<?php
					$role = isset( $row['role'] ) ? (string) $row['role'] : '';
					$meta = isset( $row['meta'] ) ? (string) $row['meta'] : '';
					?>
					<?php if ( $role || $meta ) : ?>
						<li>
							<?php if ( $role ) : ?>
								<span class="about-exp__role"><?php echo esc_html( $role ); ?></span>
							<?php endif; ?>
							<?php if ( $meta ) : ?>
								<span class="about-exp__meta"><?php echo esc_html( $meta ); ?></span>
							<?php endif; ?>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
