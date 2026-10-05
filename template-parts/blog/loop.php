<?php
/**
 * Blog post list — shared by home and archive templates.
 */
?>
<section class="blog-list" aria-label="<?php esc_attr_e( 'Posts', 'alex-theme' ); ?>">
	<?php if ( have_posts() ) : ?>
		<div class="blog-list__items">
			<?php
			$i = 0;
			while ( have_posts() ) :
				the_post();
				++$i;
				$rv   = ' rv rv' . min( $i, 4 );
				$cats = get_the_category();
				$cat  = ! empty( $cats[0] ) ? $cats[0] : null;
				?>
				<article <?php post_class( 'blog-list__item' . $rv ); ?>>
					<div class="blog-list__meta">
						<time class="blog-list__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'j M Y' ) ); ?></time>
						<?php if ( $cat ) : ?>
							<span class="blog-list__cat"><?php echo esc_html( $cat->name ); ?></span>
						<?php endif; ?>
					</div>
					<div class="blog-list__copy">
						<h2 class="blog-list__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						<?php if ( has_excerpt() || get_the_excerpt() ) : ?>
							<p class="blog-list__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<?php endif; ?>
						<a class="blog-list__more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read', 'alex-theme' ); ?> →</a>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<?php
		the_posts_pagination(
			array(
				'mid_size'  => 1,
				'prev_text' => __( '← Newer', 'alex-theme' ),
				'next_text' => __( 'Older →', 'alex-theme' ),
				'class'     => 'blog-pagination',
			)
		);
		?>
	<?php else : ?>
		<p class="blog-list__empty s-body"><?php esc_html_e( 'No posts yet — check back soon.', 'alex-theme' ); ?></p>
	<?php endif; ?>
</section>
