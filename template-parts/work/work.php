<?php
/**
 * Selected Work block — recent project grid.
 */
$eyebrow  = alex_field( 'eyebrow', 'Selected work' );
$heading  = alex_field( 'heading', 'A few recent <em>projects</em>' );
$all_link = alex_button( get_field( 'all_link' ), 'Full portfolio', alex_page_url( 'work' ) );
$projects = alex_field(
	'projects',
	array(
		array(
			'title'    => 'Coldharbour Lights',
			'platform' => 'Shopify',
			'result'   => 'Storefront rebuild — <em>+40% conversion</em>, 98 performance score',
			'url'      => alex_page_url( 'work' ),
		),
		array(
			'title'    => 'Pel & Co',
			'platform' => 'WooCommerce',
			'result'   => 'Theme rebuild — <em>+28% average order value</em>, Core Web Vitals pass',
			'url'      => alex_page_url( 'work' ),
		),
		array(
			'title'    => 'Northbridge Studio',
			'platform' => 'WordPress',
			'result'   => 'Bespoke theme — <em>1.2s LCP</em>, editorial layout system',
			'url'      => alex_page_url( 'work' ),
		),
		array(
			'title'    => 'Harbour & Field',
			'platform' => 'Shopify',
			'result'   => 'Migration & redesign — <em>zero downtime</em>, cleaner checkout',
			'url'      => alex_page_url( 'work' ),
		),
	)
);
?>
<section id="work" class="work" aria-label="<?php esc_attr_e( 'Selected work', 'alex-theme' ); ?>">
	<div class="work__head">
		<div class="rv">
			<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<h2 class="s-h"><?php echo wp_kses_post( $heading ); ?></h2>
		</div>
		<a href="<?php echo esc_url( $all_link['button_url'] ); ?>" class="work__all rv rv2"><?php echo esc_html( $all_link['button_text'] ); ?> →</a>
	</div>

	<div class="work__grid">
		<?php
		$n = 0;
		foreach ( $projects as $project ) :
			$title    = isset( $project['title'] ) ? (string) $project['title'] : '';
			$platform = isset( $project['platform'] ) ? (string) $project['platform'] : '';
			$result   = isset( $project['result'] ) ? (string) $project['result'] : '';
			$url      = isset( $project['url'] ) ? (string) $project['url'] : alex_page_url( 'work' );
			if ( ! $url ) {
				continue;
			}
			++$n;
			?>
			<a href="<?php echo esc_url( $url ); ?>" class="work__card rv rv<?php echo esc_attr( (string) min( $n, 4 ) ); ?>">
				<div class="work__media" aria-hidden="true"></div>
				<div class="work__meta">
					<?php if ( $title ) : ?>
						<span class="work__title"><?php echo esc_html( $title ); ?></span>
					<?php endif; ?>
					<?php if ( $platform ) : ?>
						<span class="work__platform"><?php echo esc_html( $platform ); ?></span>
					<?php endif; ?>
				</div>
				<?php if ( $result ) : ?>
					<p class="work__result"><?php echo wp_kses_post( $result ); ?></p>
				<?php endif; ?>
			</a>
		<?php endforeach; ?>
	</div>
</section>
