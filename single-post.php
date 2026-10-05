<?php
/**
 * Single blog post.
 */
get_header();

while ( have_posts() ) :
	the_post();

	$cats = get_the_category();
	$cat  = ! empty( $cats[0] ) ? $cats[0] : null;
	$mins = alex_reading_time();
	?>
<main id="content" tabindex="-1">
	<article <?php post_class( 'blog-single' ); ?>>
		<header class="page-hero blog-hero blog-hero--single">
			<div class="page-hero-line" aria-hidden="true"></div>
			<div class="rv">
				<p class="s-eyebrow">
					<a href="<?php echo esc_url( alex_blog_url() ); ?>"><?php esc_html_e( 'Blog', 'alex-theme' ); ?></a>
					<?php if ( $cat ) : ?>
						<span aria-hidden="true"> · </span>
						<a href="<?php echo esc_url( get_category_link( $cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
					<?php endif; ?>
				</p>
				<h1><?php the_title(); ?></h1>
				<p class="blog-single__meta">
					<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time>
					<span aria-hidden="true"> · </span>
					<span>
						<?php
						echo esc_html(
							sprintf(
								/* translators: %d: estimated reading time in minutes */
								_n( '%d min read', '%d min read', $mins, 'alex-theme' ),
								$mins
							)
						);
						?>
					</span>
				</p>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="blog-single__figure">
				<?php the_post_thumbnail( 'large' ); ?>
			</figure>
		<?php endif; ?>

		<div class="blog-single__content">
			<?php the_content(); ?>
		</div>

		<footer class="blog-single__footer">
			<a class="blog-single__back" href="<?php echo esc_url( alex_blog_url() ); ?>"><?php esc_html_e( '← All posts', 'alex-theme' ); ?></a>
		</footer>
	</article>
</main>
	<?php
endwhile;

get_footer();
