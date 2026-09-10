<?php
/**
 * My Services block — services page hero, offerings, platform compare and care tiers.
 */
$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );

$offerings = array(
	array(
		'n'     => '01',
		'title' => 'WordPress Development',
		'body'  => "Bespoke themes and Divi 5 builds for businesses that need a site their own team can run. Structured so that changing a phone number doesn't require a developer.",
		'cta'   => 'Discuss a build',
		'url'   => $contact_url,
		'items' => array(
			'Bespoke theme or Divi 5 build',
			'WooCommerce configuration',
			'Full migration of existing content',
			'Technical SEO foundations',
			'ACF Pro content architecture',
			'Gravity Forms integration',
			'Core Web Vitals optimisation',
			'Documentation and training',
		),
		'tags'  => array( 'WordPress', 'Divi 5', 'ACF Pro', 'WooCommerce', 'PHP' ),
	),
	array(
		'n'     => '02',
		'title' => 'Shopify Development',
		'body'  => 'Custom Liquid themes for brands that treat their storefront as part of the product. Considered templates, a shorter path to checkout, and integrations that actually behave.',
		'cta'   => 'Discuss a store',
		'url'   => $contact_url,
		'items' => array(
			'Custom Liquid theme',
			'Checkout refinement',
			'App integration (Klaviyo, ReCharge)',
			'Performance optimisation',
			'Product & collection templates',
			'Metafields architecture',
			'Mobile-first throughout',
			'Documentation and training',
		),
		'tags'  => array( 'Shopify', 'Liquid', 'Metafields', 'Klaviyo' ),
	),
	array(
		'n'     => '03',
		'title' => 'Performance & Search',
		'body'  => 'A technical audit that comes with the work done rather than a list of recommendations. Written in plain English, with the reasoning visible.',
		'cta'   => 'Request an audit',
		'url'   => $contact_url,
		'items' => array(
			'Full technical audit & report',
			'Structured data (JSON-LD)',
			'Search Console & GA4 setup',
			'Internal linking review',
			'Core Web Vitals remediation',
			'Yoast configuration',
			'Image, caching & CDN work',
			'Optional ongoing reporting',
		),
		'tags'  => array( 'Core Web Vitals', 'Yoast', 'GA4', 'JSON-LD' ),
	),
	array(
		'n'     => '04',
		'title' => 'Ongoing Care',
		'body'  => 'Hosting, updates, monitoring and a developer who already knows your site. For clients who would rather not think about any of it again.',
		'cta'   => 'Discuss care',
		'url'   => $contact_url,
		'items' => array(
			'WP Engine or Nimbus hosting',
			'DNS and domain management',
			'Automated backups',
			'Priority access',
			'Cloudflare CDN & SSL',
			'Core, theme & plugin updates',
			'Security & uptime monitoring',
			'Performance reporting',
		),
		'tags'  => array( 'WP Engine', 'Cloudflare', 'DNS & SSL', 'Monitoring' ),
	),
);

$platforms = array(
	array(
		'label' => 'Best for content and flexibility',
		'title' => 'WordPress',
		'body'  => 'The most flexible option available. Right for when content matters, when you need bespoke functionality, or when the site has to do several jobs at once.',
		'items' => array(
			'Unlimited flexibility through custom themes',
			'Strongest choice for content-led sites',
			'Full ownership, no platform fee',
			'Commerce available via WooCommerce',
			'Vast plugin and developer ecosystem',
		),
	),
	array(
		'label' => 'Best for selling',
		'title' => 'Shopify',
		'body'  => 'Purpose-built for commerce. Right for when selling is the primary job, the catalogue is growing, and reliability matters more than infinite flexibility.',
		'items' => array(
			'Built for commerce from the ground up',
			'Payments, inventory and fulfilment included',
			'Simpler to run without technical knowledge',
			'Extensive app ecosystem',
			'Hosting and security handled for you',
		),
	),
);

$tiers = array(
	array(
		'title' => 'Essential',
		'sub'   => 'For settled brochure sites',
		'items' => array(
			'Monthly core and plugin updates',
			'Weekly backups',
			'Security monitoring',
			'Support within two working days',
		),
	),
	array(
		'title' => 'Considered',
		'sub'   => 'Most clients settle here',
		'items' => array(
			'Everything in Essential',
			'Daily backups',
			'Cloudflare CDN management',
			'Same-day support',
			'Monthly performance report',
			'Included time for small changes',
		),
	),
	array(
		'title' => 'Partner',
		'sub'   => 'For agencies and busy teams',
		'items' => array(
			'Everything in Considered',
			'Reserved development time monthly',
			'Direct channel access',
			'Out-of-hours cover',
			'Quarterly review',
		),
	),
);
?>
<section class="page-hero my-services-hero" aria-label="<?php esc_attr_e( 'Services', 'alex-theme' ); ?>">
	<div class="page-hero-line" aria-hidden="true"></div>
	<div class="rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Services', 'alex-theme' ); ?></p>
		<h1><?php echo wp_kses_post( __( 'Considered work,<br><em>scoped properly.</em>', 'alex-theme' ) ); ?></h1>
		<p class="page-hero-sub"><?php esc_html_e( "Every project is different, so nothing here is sold from a menu. What follows is how I tend to work — the figure comes after we've spoken.", 'alex-theme' ); ?></p>
	</div>
</section>

<section class="my-services" aria-label="<?php esc_attr_e( 'How I work', 'alex-theme' ); ?>">
	<?php foreach ( $offerings as $i => $offer ) : ?>
		<article class="svc-detail rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
			<div class="svc-detail__intro">
				<span class="svc-detail__n"><?php echo esc_html( $offer['n'] ); ?></span>
				<h2 class="svc-detail__title"><?php echo esc_html( $offer['title'] ); ?></h2>
				<p class="svc-detail__body"><?php echo esc_html( $offer['body'] ); ?></p>
				<a href="<?php echo esc_url( $offer['url'] ); ?>" class="svc-detail__cta"><?php echo esc_html( $offer['cta'] ); ?> →</a>
			</div>

			<div class="svc-detail__includes">
				<p class="svc-detail__label"><?php esc_html_e( 'Typically includes', 'alex-theme' ); ?></p>
				<ul class="svc-detail__list">
					<?php foreach ( $offer['items'] as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
				<ul class="svc-detail__tags">
					<?php foreach ( $offer['tags'] as $tag ) : ?>
						<li><?php echo esc_html( $tag ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</article>
	<?php endforeach; ?>
</section>

<section class="platform" aria-label="<?php esc_attr_e( 'Platform comparison', 'alex-theme' ); ?>">
	<div class="rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Platform', 'alex-theme' ); ?></p>
		<h2 class="s-h platform__h"><?php esc_html_e( 'WordPress or Shopify — which, and why', 'alex-theme' ); ?></h2>
	</div>

	<div class="platform__grid">
		<?php foreach ( $platforms as $i => $platform ) : ?>
			<div class="platform__col rv rv<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
				<p class="platform__label"><?php echo esc_html( $platform['label'] ); ?></p>
				<h3 class="platform__title"><?php echo esc_html( $platform['title'] ); ?></h3>
				<p class="platform__body"><?php echo esc_html( $platform['body'] ); ?></p>
				<ul class="platform__list">
					<?php foreach ( $platform['items'] as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>

	<p class="platform__note rv">
		<?php
		echo wp_kses_post(
			sprintf(
				/* translators: %s: contact link */
				__( 'Not sure which applies? <a href="%s">Ask me</a> — it\'s usually clear within ten minutes.', 'alex-theme' ),
				esc_url( $contact_url )
			)
		);
		?>
	</p>
</section>

<section class="care-tiers" aria-label="<?php esc_attr_e( 'Ongoing care', 'alex-theme' ); ?>">
	<div class="rv">
		<p class="s-eyebrow"><?php esc_html_e( 'Ongoing care', 'alex-theme' ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( __( 'Three ways to <em>keep</em> it running', 'alex-theme' ) ); ?></h2>
	</div>

	<div class="care-tiers__grid">
		<?php foreach ( $tiers as $i => $tier ) : ?>
			<div class="care-tier rv rv<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
				<h3 class="care-tier__title"><?php echo esc_html( $tier['title'] ); ?></h3>
				<p class="care-tier__sub"><?php echo esc_html( $tier['sub'] ); ?></p>
				<ul class="care-tier__list">
					<?php foreach ( $tier['items'] as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>

	<p class="care-tiers__note rv"><?php esc_html_e( "Arrangements are monthly, with no minimum term. Figures are quoted once I've seen the site.", 'alex-theme' ); ?></p>
</section>
