<?php
/*
 * Template name: Homepage
 */
?>
<?php get_header(); ?>
        <div id="content" class="content-area page-wrapper" role="main">
            <?php get_template_part('template-parts/page-front/page-front', 'slider'); ?>
            <?php get_template_part('template-parts/page-front/page-front', 'most-popular-categories'); ?>
            <?php get_template_part('template-parts/page-front/page-front', 'products'); ?>
            <?php get_template_part('template-parts/page-front/page-front', 'testimonials'); ?>
            <?php //get_template_part('template-parts/page-front/page-front', 'our-instagram'); ?>
            <?php get_template_part('template-parts/page-front/page-front', 'article'); ?>
            <?php get_template_part('template-parts/page-front/page-front', 'subscribe'); ?>
            <?php get_template_part('template-parts/page-front/page-front', 'features'); ?>
	</div>
<?php get_footer(); ?>