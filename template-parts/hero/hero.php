<?php
/**
 * Hero block — home intro with code window, stats and tech strip.
 */
$location          = alex_field( 'location', 'London & remote' );
$heading           = alex_field( 'heading', 'Websites built with the same care as <em>the business</em> behind them.' );
$subheading        = alex_field( 'subheading', "I'm Alex — a WordPress and Shopify developer in London. I work with a small number of clients at a time, building sites that are fast, considered, and genuinely easy to run." );
$primary           = alex_button( get_field( 'primary_button' ), 'Start a conversation', alex_page_url( 'contact' ) );
$secondary         = alex_button( get_field( 'secondary_button' ), 'Selected work', alex_page_url( 'work' ) );
$code_window_title = alex_field( 'code_window_title', 'theme / functions.php' );
$stats             = alex_field(
	'stats',
	array(
		array(
			'value'  => '5',
			'suffix' => '',
			'label'  => 'Years',
		),
		array(
			'value'  => '30',
			'suffix' => '+',
			'label'  => 'Projects',
		),
		array(
			'value'  => '24h',
			'suffix' => '',
			'label'  => 'Reply time',
		),
	)
);
$strip_label = alex_field( 'strip_label', 'Working across' );
$platforms   = alex_field(
	'platforms',
	array(
		array( 'label' => 'WordPress' ),
		array( 'label' => 'Shopify' ),
		array( 'label' => 'WooCommerce' ),
		array( 'label' => 'Divi 5' ),
		array( 'label' => 'WP Engine' ),
		array( 'label' => 'Cloudflare' ),
	)
);
?>

<section class="hero hero-parallax" aria-label="<?php esc_attr_e( 'Freelance WordPress and Shopify Developer London', 'alex-theme' ); ?>">
	<div class="hero-bg-parallax" data-parallax="0.12" aria-hidden="true"></div>
	<div class="hero-grid-lines" aria-hidden="true"></div>

	<div class="hero-main">
		<div class="hero-left">
			<p class="hero-loc"><?php echo esc_html( $location ); ?></p>
			<h1><?php echo wp_kses_post( $heading ); ?></h1>
			<p class="hero-sub"><?php echo esc_html( $subheading ); ?></p>
			<div class="hero-btns">
				<a href="<?php echo esc_url( $primary['button_url'] ); ?>" class="btn btn-primary"><?php echo esc_html( $primary['button_text'] ); ?></a>
				<a href="<?php echo esc_url( $secondary['button_url'] ); ?>" class="btn btn-outline-white"><?php echo esc_html( $secondary['button_text'] ); ?></a>
			</div>
		</div>

		<div class="hero-right">
			<div class="code-win" id="code-win" aria-hidden="true">
				<div class="cw-bar">
					<div class="cw-dot r"></div>
					<div class="cw-dot y"></div>
					<div class="cw-dot g"></div>
					<span class="cw-title"><?php echo esc_html( $code_window_title ); ?></span>
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
		<?php foreach ( $stats as $stat ) : ?>
			<?php
			$value  = isset( $stat['value'] ) ? (string) $stat['value'] : '';
			$suffix = isset( $stat['suffix'] ) ? (string) $stat['suffix'] : '';
			$label  = isset( $stat['label'] ) ? (string) $stat['label'] : '';
			$is_num = (bool) preg_match( '/^\d+$/', $value );
			?>
			<div class="stat">
				<?php if ( $is_num ) : ?>
					<div class="stat-n" data-count="<?php echo esc_attr( $value ); ?>"<?php echo '' !== $suffix ? ' data-suffix="' . esc_attr( $suffix ) . '"' : ''; ?> aria-label="<?php echo esc_attr( $value . $suffix . ( $label ? ' ' . $label : '' ) ); ?>">0</div>
				<?php else : ?>
					<div class="stat-n"><?php echo esc_html( $value ); ?></div>
				<?php endif; ?>
				<?php if ( $label ) : ?>
					<div class="stat-l"><?php echo esc_html( $label ); ?></div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="hero-strip" aria-label="<?php esc_attr_e( 'Platforms I work across', 'alex-theme' ); ?>">
		<span class="hero-strip__label"><?php echo esc_html( $strip_label ); ?></span>
		<ul class="hero-strip__list">
			<?php foreach ( $platforms as $platform ) : ?>
				<?php if ( ! empty( $platform['label'] ) ) : ?>
					<li><?php echo esc_html( $platform['label'] ); ?></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
