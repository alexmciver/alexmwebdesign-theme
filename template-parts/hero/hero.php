<?php
/*
Template Name: Hero
*/
?>
<div class="hero">
    <div class="container">
        <div class="hero__content">
            <div class="hero__content__left">
                <h1>WordPress and Shopify developer</h1>
                <div class="hero__content__buttons">
                    <div class="hero__content__button__primary">
                <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="button">Hire me</a>
            </div>
            <div class="hero__content__button__secondary">
                <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="button">View work</a>
            </div>
                </div>
            </div>
            <div class="hero__content__right">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero.jpg" alt="Hero image">
            </div>
        </div>
    </div>
</div>