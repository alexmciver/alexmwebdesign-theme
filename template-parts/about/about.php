<?php
/**
 * About block — about page hero and introduction.
 */
$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );
$calendly     = 'https://calendly.com/alexmwebdesign/1-hour-website-chat';

$stats = array(
	array(
		'n'     => '5+',
		'label' => 'Years of experience',
	),
	array(
		'n'     => '30+',
		'label' => 'Projects completed',
	),
	array(
		'n'     => '2',
		'label' => 'Platforms day-to-day',
	),
	array(
		'n'     => '24h',
		'label' => 'Typical reply time',
	),
);

$experience = array(
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
);
?>
<section class="about-hero" aria-label="<?php esc_attr_e( 'About Alex McIver', 'alex-theme' ); ?>">
	<div class="about-hero__line" aria-hidden="true"></div>
	<div class="about-hero__left rv">
		<p class="s-eyebrow"><?php esc_html_e( 'About', 'alex-theme' ); ?></p>
		<h1><?php echo wp_kses_post( __( 'Alex <em>McIver</em>', 'alex-theme' ) ); ?></h1>
		<p class="about-hero__sub"><?php esc_html_e( "I'm a London-based WordPress and Shopify developer who believes good websites are ones that actually work for your business — fast, considered, and easy to run.", 'alex-theme' ); ?></p>
		<div class="about-hero__btns">
			<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-primary"><?php esc_html_e( "Let's work together", 'alex-theme' ); ?></a>
			<a href="<?php echo esc_url( $calendly ); ?>" class="btn btn-outline-white" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Book a call', 'alex-theme' ); ?></a>
		</div>
	</div>
	<div class="about-hero__right rv rv2" aria-hidden="true">
		<div class="about-hero__photo">
			<span class="about-hero__photo-label"><?php esc_html_e( 'Photo of Alex', 'alex-theme' ); ?></span>
		</div>
	</div>
</section>

<section class="about-intro" aria-label="<?php esc_attr_e( 'Introduction', 'alex-theme' ); ?>">
	<div class="about-intro__copy rv">
		<h2 class="about-intro__quote"><?php esc_html_e( 'I build digital products with the same care as the business behind them.', 'alex-theme' ); ?></h2>
		<div class="about-intro__text">
			<p><?php esc_html_e( 'I started building websites because I loved solving problems. Five years and thirty-plus projects later, I still do — but I\'ve learned that the technical stuff only matters if it actually helps your business grow.', 'alex-theme' ); ?></p>
			<p><?php echo wp_kses_post( __( 'I work at <strong>Hewitt Matthews</strong>, a performance marketing agency in London, where I manage a full support desk and deliver custom builds — everything from bespoke plugin development and WooCommerce setups to server configuration and CDN management.', 'alex-theme' ) ); ?></p>
			<p><?php echo wp_kses_post( __( 'Alongside that, I take on freelance projects through <strong>Alex M Web Design</strong> — ranging from Shopify stores to SEO-led WordPress redesigns for small business owners who want a site that actually brings in customers.', 'alex-theme' ) ); ?></p>
			<p><?php echo wp_kses_post( __( 'The thing clients always mention? I explain things in plain English, I stay calm under pressure, and <strong>no challenge is ever too big</strong>.', 'alex-theme' ) ); ?></p>
		</div>
	</div>

	<div class="about-intro__aside rv rv2">
		<div class="about-stats">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="about-stat">
					<span class="about-stat__n"><?php echo esc_html( $stat['n'] ); ?></span>
					<span class="about-stat__l"><?php echo esc_html( $stat['label'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="about-exp">
			<p class="about-exp__label"><?php esc_html_e( 'Experience', 'alex-theme' ); ?></p>
			<ul class="about-exp__list">
				<?php foreach ( $experience as $row ) : ?>
					<li>
						<span class="about-exp__role"><?php echo esc_html( $row['role'] ); ?></span>
						<span class="about-exp__meta"><?php echo esc_html( $row['meta'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
