<?php
/**
 * My Services block — services page hero, offerings, platform compare and care tiers.
 */
$contact_url = alex_page_url( 'contact' );

$eyebrow    = alex_field( 'eyebrow', 'Services' );
$heading    = alex_field( 'heading', 'Considered work,<br><em>scoped properly.</em>' );
$subheading = alex_field( 'subheading', "Every project is different, so nothing here is sold from a menu. What follows is how I tend to work — the figure comes after we've spoken." );
$offerings  = alex_field(
	'offerings',
	array(
		array(
			'number'    => '01',
			'title'     => 'WordPress Development',
			'body'      => "Bespoke themes and Divi 5 builds for businesses that need a site their own team can run. Structured so that changing a phone number doesn't require a developer.",
			'cta_label' => 'Discuss a build',
			'cta_url'   => $contact_url,
			'includes'  => "Bespoke theme or Divi 5 build\nWooCommerce configuration\nFull migration of existing content\nTechnical SEO foundations\nACF Pro content architecture\nGravity Forms integration\nCore Web Vitals optimisation\nDocumentation and training",
			'tags'      => "WordPress\nDivi 5\nACF Pro\nWooCommerce\nPHP",
		),
		array(
			'number'    => '02',
			'title'     => 'Shopify Development',
			'body'      => 'Custom Liquid themes for brands that treat their storefront as part of the product. Considered templates, a shorter path to checkout, and integrations that actually behave.',
			'cta_label' => 'Discuss a store',
			'cta_url'   => $contact_url,
			'includes'  => "Custom Liquid theme\nCheckout refinement\nApp integration (Klaviyo, ReCharge)\nPerformance optimisation\nProduct & collection templates\nMetafields architecture\nMobile-first throughout\nDocumentation and training",
			'tags'      => "Shopify\nLiquid\nMetafields\nKlaviyo",
		),
		array(
			'number'    => '03',
			'title'     => 'Performance & Search',
			'body'      => 'A technical audit that comes with the work done rather than a list of recommendations. Written in plain English, with the reasoning visible.',
			'cta_label' => 'Request an audit',
			'cta_url'   => $contact_url,
			'includes'  => "Full technical audit & report\nStructured data (JSON-LD)\nSearch Console & GA4 setup\nInternal linking review\nCore Web Vitals remediation\nYoast configuration\nImage, caching & CDN work\nOptional ongoing reporting",
			'tags'      => "Core Web Vitals\nYoast\nGA4\nJSON-LD",
		),
		array(
			'number'    => '04',
			'title'     => 'Ongoing Care',
			'body'      => 'Hosting, updates, monitoring and a developer who already knows your site. For clients who would rather not think about any of it again.',
			'cta_label' => 'Discuss care',
			'cta_url'   => $contact_url,
			'includes'  => "WP Engine or Nimbus hosting\nDNS and domain management\nAutomated backups\nPriority access\nCloudflare CDN & SSL\nCore, theme & plugin updates\nSecurity & uptime monitoring\nPerformance reporting",
			'tags'      => "WP Engine\nCloudflare\nDNS & SSL\nMonitoring",
		),
	)
);
$platform_eyebrow = alex_field( 'platform_eyebrow', 'Platform' );
$platform_heading = alex_field( 'platform_heading', 'WordPress or Shopify — which, and why' );
$platforms        = alex_field(
	'platforms',
	array(
		array(
			'label' => 'Best for content and flexibility',
			'title' => 'WordPress',
			'body'  => 'The most flexible option available. Right for when content matters, when you need bespoke functionality, or when the site has to do several jobs at once.',
			'items' => "Unlimited flexibility through custom themes\nStrongest choice for content-led sites\nFull ownership, no platform fee\nCommerce available via WooCommerce\nVast plugin and developer ecosystem",
		),
		array(
			'label' => 'Best for selling',
			'title' => 'Shopify',
			'body'  => 'Purpose-built for commerce. Right for when selling is the primary job, the catalogue is growing, and reliability matters more than infinite flexibility.',
			'items' => "Built for commerce from the ground up\nPayments, inventory and fulfilment included\nSimpler to run without technical knowledge\nExtensive app ecosystem\nHosting and security handled for you",
		),
	)
);
$platform_note = alex_field( 'platform_note', 'Not sure which applies? <a href="' . esc_url( $contact_url ) . '">Ask me</a> — it\'s usually clear within ten minutes.' );
$care_eyebrow  = alex_field( 'care_eyebrow', 'Ongoing care' );
$care_heading  = alex_field( 'care_heading', 'Three ways to <em>keep</em> it running' );
$tiers         = alex_field(
	'tiers',
	array(
		array(
			'title' => 'Essential',
			'sub'   => 'For settled brochure sites',
			'items' => "Monthly core and plugin updates\nWeekly backups\nSecurity monitoring\nSupport within two working days",
		),
		array(
			'title' => 'Considered',
			'sub'   => 'Most clients settle here',
			'items' => "Everything in Essential\nDaily backups\nCloudflare CDN management\nSame-day support\nMonthly performance report\nIncluded time for small changes",
		),
		array(
			'title' => 'Partner',
			'sub'   => 'For agencies and busy teams',
			'items' => "Everything in Considered\nReserved development time monthly\nDirect channel access\nOut-of-hours cover\nQuarterly review",
		),
	)
);
$care_note = alex_field( 'care_note', "Arrangements are monthly, with no minimum term. Figures are quoted once I've seen the site." );

/**
 * Split a textarea into trimmed non-empty lines.
 *
 * @param string $text Raw textarea value.
 * @return string[]
 */
$alex_lines = static function ( $text ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $text );
	if ( ! is_array( $lines ) ) {
		return array();
	}
	return array_values(
		array_filter(
			array_map( 'trim', $lines ),
			static function ( $line ) {
				return '' !== $line;
			}
		)
	);
};
?>
<section class="page-hero my-services-hero" aria-label="<?php esc_attr_e( 'Services', 'alex-theme' ); ?>">
	<div class="page-hero-line" aria-hidden="true"></div>
	<div class="rv">
		<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h1><?php echo wp_kses_post( $heading ); ?></h1>
		<p class="page-hero-sub"><?php echo esc_html( $subheading ); ?></p>
	</div>
</section>

<section class="my-services" aria-label="<?php esc_attr_e( 'How I work', 'alex-theme' ); ?>">
	<?php foreach ( $offerings as $i => $offer ) : ?>
		<?php
		$number    = isset( $offer['number'] ) ? (string) $offer['number'] : '';
		$title     = isset( $offer['title'] ) ? (string) $offer['title'] : '';
		$body      = isset( $offer['body'] ) ? (string) $offer['body'] : '';
		$cta_label = isset( $offer['cta_label'] ) ? (string) $offer['cta_label'] : '';
		$cta_url   = isset( $offer['cta_url'] ) ? (string) $offer['cta_url'] : '';
		$includes  = $alex_lines( isset( $offer['includes'] ) ? $offer['includes'] : '' );
		$tags      = $alex_lines( isset( $offer['tags'] ) ? $offer['tags'] : '' );
		?>
		<article class="svc-detail rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
			<div class="svc-detail__intro">
				<?php if ( $number ) : ?>
					<span class="svc-detail__n"><?php echo esc_html( $number ); ?></span>
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<h2 class="svc-detail__title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<?php if ( $body ) : ?>
					<p class="svc-detail__body"><?php echo esc_html( $body ); ?></p>
				<?php endif; ?>
				<?php if ( $cta_label && $cta_url ) : ?>
					<a href="<?php echo esc_url( $cta_url ); ?>" class="svc-detail__cta"><?php echo esc_html( $cta_label ); ?> →</a>
				<?php endif; ?>
			</div>

			<?php if ( $includes || $tags ) : ?>
				<div class="svc-detail__includes">
					<?php if ( $includes ) : ?>
						<p class="svc-detail__label"><?php esc_html_e( 'Typically includes', 'alex-theme' ); ?></p>
						<ul class="svc-detail__list">
							<?php foreach ( $includes as $item ) : ?>
								<li><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php if ( $tags ) : ?>
						<ul class="svc-detail__tags">
							<?php foreach ( $tags as $tag ) : ?>
								<li><?php echo esc_html( $tag ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</article>
	<?php endforeach; ?>
</section>

<section class="platform" aria-label="<?php esc_attr_e( 'Platform comparison', 'alex-theme' ); ?>">
	<div class="rv">
		<p class="s-eyebrow"><?php echo esc_html( $platform_eyebrow ); ?></p>
		<h2 class="s-h platform__h"><?php echo esc_html( $platform_heading ); ?></h2>
	</div>

	<div class="platform__grid">
		<?php foreach ( $platforms as $i => $platform ) : ?>
			<?php
			$label = isset( $platform['label'] ) ? (string) $platform['label'] : '';
			$title = isset( $platform['title'] ) ? (string) $platform['title'] : '';
			$body  = isset( $platform['body'] ) ? (string) $platform['body'] : '';
			$items = $alex_lines( isset( $platform['items'] ) ? $platform['items'] : '' );
			?>
			<div class="platform__col rv rv<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
				<?php if ( $label ) : ?>
					<p class="platform__label"><?php echo esc_html( $label ); ?></p>
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<h3 class="platform__title"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>
				<?php if ( $body ) : ?>
					<p class="platform__body"><?php echo esc_html( $body ); ?></p>
				<?php endif; ?>
				<?php if ( $items ) : ?>
					<ul class="platform__list">
						<?php foreach ( $items as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>

	<p class="platform__note rv"><?php echo wp_kses_post( $platform_note ); ?></p>
</section>

<section class="care-tiers" aria-label="<?php esc_attr_e( 'Ongoing care', 'alex-theme' ); ?>">
	<div class="rv">
		<p class="s-eyebrow"><?php echo esc_html( $care_eyebrow ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( $care_heading ); ?></h2>
	</div>

	<div class="care-tiers__grid">
		<?php foreach ( $tiers as $i => $tier ) : ?>
			<?php
			$title = isset( $tier['title'] ) ? (string) $tier['title'] : '';
			$sub   = isset( $tier['sub'] ) ? (string) $tier['sub'] : '';
			$items = $alex_lines( isset( $tier['items'] ) ? $tier['items'] : '' );
			?>
			<div class="care-tier rv rv<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
				<?php if ( $title ) : ?>
					<h3 class="care-tier__title"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>
				<?php if ( $sub ) : ?>
					<p class="care-tier__sub"><?php echo esc_html( $sub ); ?></p>
				<?php endif; ?>
				<?php if ( $items ) : ?>
					<ul class="care-tier__list">
						<?php foreach ( $items as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>

	<p class="care-tiers__note rv"><?php echo esc_html( $care_note ); ?></p>
</section>
