<?php
/**
 * Hero block — home intro with code window, stats and tech strip.
 */
$location          = get_field( 'location' );
$heading           = get_field( 'heading' );
$subheading        = get_field( 'subheading' );
$primary           = get_field( 'primary_button' );
$secondary         = get_field( 'secondary_button' );
$code_window_title = get_field( 'code_window_title' );
$stats             = get_field( 'stats' );
$strip_label       = get_field( 'strip_label' );
$platforms         = get_field( 'platforms' );
?>

<section class="hero hero-parallax" aria-label="<?php esc_attr_e( 'Freelance WordPress and Shopify Developer London', 'alex-theme' ); ?>">
	<div class="hero-bg-parallax" data-parallax="0.12" aria-hidden="true"></div>
	<div class="hero-grid-lines" aria-hidden="true"></div>

	<div class="hero-main">
		<div class="hero-left">
			<?php if ( $location ) : ?>
				<p class="hero-loc"><?php echo esc_html( $location ); ?></p>
			<?php endif; ?>
			<?php if ( $heading ) : ?>
				<h1><?php echo wp_kses_post( $heading ); ?></h1>
			<?php endif; ?>
			<?php if ( $subheading ) : ?>
				<p class="hero-sub"><?php echo esc_html( $subheading ); ?></p>
			<?php endif; ?>
			<?php if ( ( ! empty( $primary['button_text'] ) && ! empty( $primary['button_url'] ) ) || ( ! empty( $secondary['button_text'] ) && ! empty( $secondary['button_url'] ) ) ) : ?>
				<div class="hero-btns">
					<?php if ( ! empty( $primary['button_text'] ) && ! empty( $primary['button_url'] ) ) : ?>
						<a href="<?php echo esc_url( $primary['button_url'] ); ?>" class="btn btn-primary"><?php echo esc_html( $primary['button_text'] ); ?></a>
					<?php endif; ?>
					<?php if ( ! empty( $secondary['button_text'] ) && ! empty( $secondary['button_url'] ) ) : ?>
						<a href="<?php echo esc_url( $secondary['button_url'] ); ?>" class="btn btn-outline-white"><?php echo esc_html( $secondary['button_text'] ); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="hero-right">
			<div class="code-win" id="code-win">
				<div class="cw-bar">
					<div class="cw-dot r"></div>
					<div class="cw-dot y"></div>
					<div class="cw-dot g"></div>
					<?php if ( $code_window_title ) : ?>
						<span class="cw-title"><?php echo esc_html( $code_window_title ); ?></span>
					<?php endif; ?>
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

	<?php if ( $stats ) : ?>
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
						<div class="stat-n" data-count="<?php echo esc_attr( $value ); ?>"<?php echo '' !== $suffix ? ' data-suffix="' . esc_attr( $suffix ) . '"' : ''; ?>>0</div>
					<?php else : ?>
						<div class="stat-n"><?php echo esc_html( $value ); ?></div>
					<?php endif; ?>
					<?php if ( $label ) : ?>
						<div class="stat-l"><?php echo esc_html( $label ); ?></div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if ( $strip_label || $platforms ) : ?>
		<div class="hero-strip" aria-label="<?php esc_attr_e( 'Platforms I work across', 'alex-theme' ); ?>">
			<?php if ( $strip_label ) : ?>
				<span class="hero-strip__label"><?php echo esc_html( $strip_label ); ?></span>
			<?php endif; ?>
			<?php if ( $platforms ) : ?>
				<ul class="hero-strip__list">
					<?php foreach ( $platforms as $platform ) : ?>
						<?php if ( ! empty( $platform['label'] ) ) : ?>
							<li><?php echo esc_html( $platform['label'] ); ?></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</section>
