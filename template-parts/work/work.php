<?php
/**
 * Selected Work block — recent project grid from the Work CPT.
 */
$eyebrow  = alex_field( 'eyebrow', 'Selected work' );
$heading  = alex_field( 'heading', 'Recent <em>commissions</em>' );
$all_link = alex_button( get_field( 'all_link' ), 'Full portfolio', alex_work_archive_url() );

$work_query = alex_query_work(
	array(
		'posts_per_page' => 4,
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

	<?php if ( $work_query->have_posts() ) : ?>
		<div class="work__grid">
			<?php
			$n = 0;
			while ( $work_query->have_posts() ) :
				$work_query->the_post();
				$project = alex_work_item( get_post(), $n );
				if ( ! $project ) {
					continue;
				}
				++$n;
				alex_render_work_card( $project, $n );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	<?php endif; ?>
</section>
