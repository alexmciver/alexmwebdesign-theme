<?php
/**
 * Hero block — home intro with code window, stats and tech strip.
 */
$work_page    = get_page_by_path( 'work' );
$work_url     = $work_page ? get_permalink( $work_page ) : home_url( '/work/' );
$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );
$platforms    = array( 'WordPress', 'Shopify', 'WooCommerce', 'Divi 5', 'WP Engine', 'Cloudflare' );
?>
<section class="hero hero-parallax" aria-label="<?php esc_attr_e( 'Freelance WordPress and Shopify Developer London', 'alex-theme' ); ?>">
	<div class="hero-bg-parallax" data-parallax="0.12" aria-hidden="true"></div>
	<div class="hero-grid-lines" aria-hidden="true"></div>

	<div class="hero-main">
		<div class="hero-left">
			<p class="hero-loc"><?php esc_html_e( 'London & remote', 'alex-theme' ); ?></p>
			<h1><?php echo wp_kses_post( __( 'Websites built with the same care as <em>the business</em> behind them.', 'alex-theme' ) ); ?></h1>
			<p class="hero-sub"><?php esc_html_e( "I'm Alex — a WordPress and Shopify developer in London. I work with a small number of clients at a time, building sites that are fast, considered, and genuinely easy to run.", 'alex-theme' ); ?></p>
			<div class="hero-btns">
				<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-primary"><?php esc_html_e( 'Start a conversation', 'alex-theme' ); ?></a>
				<a href="<?php echo esc_url( $work_url ); ?>" class="btn btn-outline-white"><?php esc_html_e( 'Selected work', 'alex-theme' ); ?></a>
			</div>
		</div>

		<div class="hero-right">
			<div class="code-win" id="code-win">
				<div class="cw-bar">
					<div class="cw-dot r"></div>
					<div class="cw-dot y"></div>
					<div class="cw-dot g"></div>
					<span class="cw-title">theme / functions.php</span>
				</div>
				<div class="cw-body">
					<span class="cw-line"><span class="cm">// Inline critical CSS — cut largest contentful paint</span></span>
					<span class="cw-line"><span class="fn">add_action</span>( <span class="str">'wp_enqueue_scripts'</span>, <span class="kw">function</span> () {</span>
					<span class="cw-line">  <span class="fn">wp_dequeue_style</span>( <span class="str">'theme-main'</span> );</span>
					<span class="cw-line">  <span class="var">$critical</span> = <span class="fn">file_get_contents</span>(</span>
					<span class="cw-line">    <span class="fn">get_theme_file_path</span>( <span class="str">'critical.css'</span> )</span>
					<span class="cw-line">  );</span>
					<span class="cw-line">  <span class="fn">wp_add_inline_style</span>( <span class="str">'theme-base'</span>, <span class="var">$critical</span> );</span>
					<span class="cw-line">} );<span class="cw-cur"></span></span>
				</div>
			</div>
		</div>
	</div>

	<div class="hero-stats">
		<div class="stat">
			<div class="stat-n" data-count="5">0</div>
			<div class="stat-l"><?php esc_html_e( 'Years', 'alex-theme' ); ?></div>
		</div>
		<div class="stat">
			<div class="stat-n" data-count="30" data-suffix="+">0</div>
			<div class="stat-l"><?php esc_html_e( 'Projects', 'alex-theme' ); ?></div>
		</div>
		<div class="stat">
			<div class="stat-n">24h</div>
			<div class="stat-l"><?php esc_html_e( 'Reply time', 'alex-theme' ); ?></div>
		</div>
	</div>

	<div class="hero-strip" aria-label="<?php esc_attr_e( 'Platforms I work across', 'alex-theme' ); ?>">
		<span class="hero-strip__label"><?php esc_html_e( 'Working across', 'alex-theme' ); ?></span>
		<ul class="hero-strip__list">
			<?php foreach ( $platforms as $platform ) : ?>
				<li><?php echo esc_html( $platform ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
