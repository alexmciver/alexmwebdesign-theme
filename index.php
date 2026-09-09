<!DOCTYPE html>
<html <?php language_attributes(); ?>>

 <head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
 </head>

 <body <?php body_class(); ?>>
  <?php get_header(); ?>
  <main id="content" role="main">
   <?php
   	 while (have_posts()) : the_post();
      the_content();
      endwhile;
    ?>
  </main>
  <?php get_footer(); ?>
 </body>

</html>