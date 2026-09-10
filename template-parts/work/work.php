<?php
/**
 * Selected Work block — recent project grid.
 */
$work_page = get_page_by_path( 'work' );
$work_url  = $work_page ? get_permalink( $work_page ) : home_url( '/work/' );

$projects = array(
	array(
		'title'    => 'Coldharbour Lights',
		'platform' => 'Shopify',
		'result'   => 'Storefront rebuild — <em>+40% conversion</em>, 98 performance score',
		'url'      => $work_url,
	),
	array(
		'title'    => 'Pel & Co',
		'platform' => 'WooCommerce',
		'result'   => 'Theme rebuild — <em>+28% average order value</em>, Core Web Vitals pass',
		'url'      => $work_url,
	),
	array(
		'title'    => 'Northbridge Studio',
		'platform' => 'WordPress',
		'result'   => 'Bespoke theme — <em>1.2s LCP</em>, editorial layout system',
		'url'      => $work_url,
	),
	array(
		'title'    => 'Harbour & Field',
		'platform' => 'Shopify',
		'result'   => 'Migration & redesign — <em>zero downtime</em>, cleaner checkout',
		'url'      => $work_url,
	),
);
?>
<section id="work" class="work" aria-label="<?php esc_attr_e( 'Selected work', 'alex-theme' ); ?>">
	<div class="work__head">
		<div class="rv">
			<p class="s-eyebrow"><?php esc_html_e( 'Selected work', 'alex-theme' ); ?></p>
			<h2 class="s-h"><?php esc_html_e( 'A few recent projects', 'alex-theme' ); ?></h2>
		</div>
		<a href="<?php echo esc_url( $work_url ); ?>" class="work__all rv rv2"><?php esc_html_e( 'Full portfolio', 'alex-theme' ); ?> →</a>
	</div>

	<div class="work__grid">
		<?php foreach ( $projects as $i => $project ) : ?>
			<a href="<?php echo esc_url( $project['url'] ); ?>" class="work__card rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
				<div class="work__media" aria-hidden="true"></div>
				<div class="work__meta">
					<span class="work__title"><?php echo esc_html( $project['title'] ); ?></span>
					<span class="work__platform"><?php echo esc_html( $project['platform'] ); ?></span>
				</div>
				<p class="work__result"><?php echo wp_kses_post( $project['result'] ); ?></p>
			</a>
		<?php endforeach; ?>
	</div>
</section>
