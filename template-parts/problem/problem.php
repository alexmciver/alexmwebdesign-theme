<?php
/**
 * Problem block — why most websites underperform.
 */
$eyebrow = alex_field( 'eyebrow', 'The problem' );
$heading = alex_field( 'heading', 'Most websites are built to <em>exist</em>, not to work.' );
$body    = alex_field( 'body', "They look acceptable, they load slowly, and they quietly cost their owners business every single day. The difference is rarely design taste. It's judgement." );
$link    = alex_button( get_field( 'link' ), 'Talk it through', alex_page_url( 'contact' ) );
$items   = alex_field(
	'items',
	array(
		array(
			'title' => 'It looks like it was built years ago',
			'body'  => 'Visitors decide whether to trust you within seconds, long before they read a word.',
		),
		array(
			'title' => "Traffic arrives, enquiries don't",
			'body'  => 'Attention without conversion is a structural problem, not a marketing one.',
		),
		array(
			'title' => 'Nobody explains anything clearly',
			'body'  => 'You should always understand what is being built, why, and what it costs.',
		),
		array(
			'title' => 'Simple changes take weeks',
			'body'  => 'Small updates should not require raising a ticket and waiting a fortnight.',
		),
		array(
			'title' => "Search results are somebody else's",
			'body'  => 'Technical foundations decide visibility. They belong in the build, not bolted on later.',
		),
	)
);
?>
<section id="problem" class="problem" aria-label="<?php esc_attr_e( 'The problem with most websites', 'alex-theme' ); ?>">
	<div class="problem__left rv">
		<p class="s-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( $heading ); ?></h2>
		<p class="s-body"><?php echo esc_html( $body ); ?></p>
		<a href="<?php echo esc_url( $link['button_url'] ); ?>" class="problem__link"><?php echo esc_html( $link['button_text'] ); ?> →</a>
	</div>

	<div class="problem__list">
		<?php
		$n = 0;
		foreach ( $items as $item ) :
			$title = isset( $item['title'] ) ? (string) $item['title'] : '';
			$copy  = isset( $item['body'] ) ? (string) $item['body'] : '';
			if ( ! $title && ! $copy ) {
				continue;
			}
			++$n;
			?>
			<div class="problem__item rv rv<?php echo esc_attr( (string) min( $n, 4 ) ); ?>">
				<span class="problem__n"><?php echo esc_html( str_pad( (string) $n, 2, '0', STR_PAD_LEFT ) ); ?></span>
				<div class="problem__copy">
					<?php if ( $title ) : ?>
						<p class="problem__title"><?php echo esc_html( $title ); ?></p>
					<?php endif; ?>
					<?php if ( $copy ) : ?>
						<p class="problem__body"><?php echo esc_html( $copy ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
