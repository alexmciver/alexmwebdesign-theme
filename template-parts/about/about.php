<?php
/**
 * About block — about page hero and introduction.
 */
$contact_url = alex_page_url( 'contact' );
$calendly    = 'https://calendly.com/alexmwebdesign/1-hour-website-chat';

$eyebrow     = alex_field( 'eyebrow', 'About' );
$heading     = alex_field( 'heading', 'Alex <em>McIver</em>' );
$subheading  = alex_field( 'subheading', "I'm a London-based WordPress and Shopify developer who believes good websites are ones that actually work for your business — fast, considered, and easy to run." );
$primary     = alex_button( get_field( 'primary_button' ), "Let's work together", $contact_url );
$secondary   = alex_button( get_field( 'secondary_button' ), 'Book a call', $calendly );
$photo_label = alex_field( 'photo_label', 'Photo of Alex' );
$photo_url   = alex_field( 'photo_url', 'https://alexmwebdesign.co.uk/wp-content/uploads/2022/11/1648737707408-min.webp' );
$intro_quote = alex_field( 'intro_quote', 'I build digital products with the same care as the business behind them.' );
$intro_text  = alex_field(
	'intro_text',
	'<p>I started building websites because I loved solving problems. Five years and thirty-plus projects later, I still do — but I\'ve learned that the technical stuff only matters if it actually helps your business grow.</p>'
	. '<p>I work at <strong>Hewitt Matthews</strong>, a performance marketing agency in London, where I manage a full support desk and deliver custom builds — everything from bespoke plugin development and WooCommerce setups to server configuration and CDN management.</p>'
	. '<p>Alongside that, I take on freelance projects through <strong>Alex M Web Design</strong> — ranging from Shopify stores to SEO-led WordPress redesigns for small business owners who want a site that actually brings in customers.</p>'
	. '<p>The thing clients always mention? I explain things in plain English, I stay calm under pressure, and <strong>no challenge is ever too big</strong>.</p>'
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
$experience       = alex_field(
	'experience',
	array(
		array(
			'role' => 'Lead Developer · Hewitt Matthews',
			'meta' => '2022 – Present',
		),
		array(
			'role' => 'Freelance · Alex M Web Design',
			'meta' => '2020 – Present',
		),
		array(
			'role' => 'Junior Web Developer',
			'meta' => '2019 – 2022',
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
					<a href="<?php echo esc_url( $primary['button_url'] ); ?>" class="btn btn-primary"<?php echo false !== stripos( (string) $primary['button_url'], 'calendly.com' ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $primary['button_text'] ); ?></a>
				<?php endif; ?>
				<?php if ( $has_secondary ) : ?>
					<a href="<?php echo esc_url( $secondary['button_url'] ); ?>" class="btn btn-outline-white"<?php echo false !== stripos( (string) $secondary['button_url'], 'calendly.com' ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $secondary['button_text'] ); ?></a>
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
