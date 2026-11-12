<?php
/**
 * Service Page block — hero, flexible content sections and fixed-price options.
 *
 * Built for long-form service pages (for example the SEO Health Check) so they match
 * the Services page: a page-hero, then content bands and an options grid. Pair it with
 * the existing questions and hire-me blocks for the FAQs and the booking band.
 */
$eyebrow    = alex_field( 'eyebrow', '' );
$heading    = alex_field( 'heading', 'Service <em>page</em>' );
$subheading = alex_field( 'subheading', '' );
$cta        = alex_button( get_field( 'cta' ), '', '' );
$sections   = alex_field( 'sections', array() );
$sections   = is_array( $sections ) ? $sections : array();

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

$has_cta = ! empty( $cta['button_text'] ) && ! empty( $cta['button_url'] );
?>
<section class="page-hero service-hero" aria-label="<?php echo esc_attr( wp_strip_all_tags( $heading ) ); ?>">
	<div class="page-hero-line" aria-hidden="true"></div>
	<div class="rv">
		<?php if ( $eyebrow ) : ?>
			<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>
		<h1><?php echo wp_kses_post( $heading ); ?></h1>
		<?php if ( $subheading ) : ?>
			<p class="page-hero-sub"><?php echo esc_html( $subheading ); ?></p>
		<?php endif; ?>
		<?php if ( $has_cta ) : ?>
			<?php $cta_ext = alex_external_link_attrs( $cta['button_url'] ); ?>
			<div class="service-hero__btns">
				<a href="<?php echo esc_url( $cta['button_url'] ); ?>" class="btn btn-primary"<?php echo $cta_ext; ?>><?php echo esc_html( $cta['button_text'] ); ?><?php if ( $cta_ext ) : ?><span class="u-sr-only"><?php esc_html_e( ' (opens in a new tab)', 'alex-theme' ); ?></span><?php endif; ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php foreach ( $sections as $section ) : ?>
	<?php
	$layout = isset( $section['acf_fc_layout'] ) ? (string) $section['acf_fc_layout'] : '';

	if ( 'content' === $layout ) :
		$title = isset( $section['heading'] ) ? (string) $section['heading'] : '';
		$body  = isset( $section['body'] ) ? (string) $section['body'] : '';
		$tone  = isset( $section['tone'] ) && 'dark' === $section['tone'] ? 'dark' : 'light';
		if ( '' === $title && '' === trim( wp_strip_all_tags( $body ) ) ) {
			continue;
		}
		$section_label = $title ? wp_strip_all_tags( $title ) : __( 'Overview', 'alex-theme' );
		?>
		<section class="service-section service-section--<?php echo esc_attr( $tone ); ?><?php echo $title ? '' : ' service-section--lead'; ?>" aria-label="<?php echo esc_attr( $section_label ); ?>">
			<div class="service-section__inner<?php echo $title ? '' : ' service-section__inner--solo'; ?> rv">
				<?php if ( $title ) : ?>
					<h2 class="s-h service-section__title"><?php echo wp_kses_post( $title ); ?></h2>
				<?php endif; ?>
				<div class="service-section__body">
					<?php echo wp_kses_post( $body ); ?>
				</div>
			</div>
		</section>
		<?php
	elseif ( 'options' === $layout ) :
		$opt_eyebrow = isset( $section['eyebrow'] ) ? (string) $section['eyebrow'] : '';
		$opt_heading = isset( $section['heading'] ) ? (string) $section['heading'] : '';
		$opt_intro   = isset( $section['intro'] ) ? (string) $section['intro'] : '';
		$options     = isset( $section['options'] ) && is_array( $section['options'] ) ? $section['options'] : array();
		$opt_note    = isset( $section['note'] ) ? (string) $section['note'] : '';
		if ( ! $options ) {
			continue;
		}
		$opt_label = $opt_heading ? wp_strip_all_tags( $opt_heading ) : __( 'Options', 'alex-theme' );
		?>
		<section class="service-options" aria-label="<?php echo esc_attr( $opt_label ); ?>">
			<div class="service-options__head rv">
				<?php if ( $opt_eyebrow ) : ?>
					<p class="s-eyebrow"><?php echo esc_html( $opt_eyebrow ); ?></p>
				<?php endif; ?>
				<?php if ( $opt_heading ) : ?>
					<h2 class="s-h"><?php echo wp_kses_post( $opt_heading ); ?></h2>
				<?php endif; ?>
				<?php if ( $opt_intro ) : ?>
					<p class="s-body"><?php echo esc_html( $opt_intro ); ?></p>
				<?php endif; ?>
			</div>

			<div class="service-options__grid service-options__grid--<?php echo esc_attr( (string) min( count( $options ), 3 ) ); ?>">
				<?php foreach ( $options as $i => $option ) : ?>
					<?php
					$name    = isset( $option['name'] ) ? (string) $option['name'] : '';
					$price   = isset( $option['price'] ) ? (string) $option['price'] : '';
					$details = $alex_lines( isset( $option['details'] ) ? $option['details'] : '' );
					$note    = isset( $option['note'] ) ? (string) $option['note'] : '';
					?>
					<div class="service-option rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
						<?php if ( $name ) : ?>
							<h3 class="service-option__name"><?php echo esc_html( $name ); ?></h3>
						<?php endif; ?>
						<?php if ( $price ) : ?>
							<p class="service-option__price"><?php echo esc_html( $price ); ?></p>
						<?php endif; ?>
						<?php if ( $details ) : ?>
							<ul class="service-option__list">
								<?php foreach ( $details as $line ) : ?>
									<li><?php echo esc_html( $line ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<?php if ( $note ) : ?>
							<p class="service-option__note"><?php echo esc_html( $note ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ( $opt_note ) : ?>
				<p class="service-options__note rv"><?php echo wp_kses_post( $opt_note ); ?></p>
			<?php endif; ?>
		</section>
		<?php
	endif;
	?>
<?php endforeach; ?>
