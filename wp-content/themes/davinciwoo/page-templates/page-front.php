<?php
/*
 * Template name: Homepage
 */
?>
<?php get_header(); ?>
	<div class="container mt-xl-px-20 mb-px-40">
        <div id="content" class="content-area page-wrapper" role="main">
            <div class="fw-block" data-sizes='["xs", "sm", "md", "lg"]'>
                <div class="fw-back">
                    <div class="row no-gutters">
                        <?php get_template_part('template-parts/page-front/page-front', 'slider-menu'); ?>
                        <?php get_template_part('template-parts/page-front/page-front', 'slider'); ?>
                    </div>
                </div>
                <div class="fw-inner"></div>
            </div>
            <?php get_template_part('template-parts/page-front/page-front', 'countdown'); ?>
            <?php get_template_part('template-parts/page-front/page-front', 'features'); ?>
            <?php get_template_part('template-parts/page-front/page-front', 'products'); ?>
            <?php get_template_part('template-parts/page-front/page-front', 'promotion'); ?>
        </div>
        <?php edit_post_link( __( 'Edit', 'davinciwoo'), '<div>', '</div>' ); ?>
	</div>
<?php get_template_part('template-parts/page-front/page-front', 'subscribe'); ?>
<?php get_footer(); ?>
