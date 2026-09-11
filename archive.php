<?php
/**
 * Archive template.
 */
get_header();
?>
<main id="content" tabindex="-1">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h2 class="s-h"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="s-body"><?php the_excerpt(); ?></div>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>
</main>
<?php
get_footer();
