<?php
/**
 * The Problem block — why most websites underperform.
 */
$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );

$items = array(
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
);
?>
<section id="problem" class="problem" aria-label="<?php esc_attr_e( 'The problem with most websites', 'alex-theme' ); ?>">
	<div class="problem__left rv">
		<p class="s-eyebrow"><?php esc_html_e( 'The problem', 'alex-theme' ); ?></p>
		<h2 class="s-h"><?php echo wp_kses_post( __( 'Most websites are built to <em>exist</em>, not to work.', 'alex-theme' ) ); ?></h2>
		<p class="s-body"><?php esc_html_e( "They look acceptable, they load slowly, and they quietly cost their owners business every single day. The difference is rarely design taste. It's judgement.", 'alex-theme' ); ?></p>
		<a href="<?php echo esc_url( $contact_url ); ?>" class="problem__link"><?php esc_html_e( 'Talk it through', 'alex-theme' ); ?> →</a>
	</div>

	<div class="problem__list">
		<?php foreach ( $items as $i => $item ) : ?>
			<div class="problem__item rv rv<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
				<span class="problem__n"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
				<div class="problem__copy">
					<p class="problem__title"><?php echo esc_html( $item['title'] ); ?></p>
					<p class="problem__body"><?php echo esc_html( $item['body'] ); ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
