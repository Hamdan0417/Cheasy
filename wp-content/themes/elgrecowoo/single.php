<?php
/**
* User: Denis Zharov
* Date: 17.09.2018
* Time: 13:06
*
* Blog Single Post
*/

$header_view = adswth_option('blog_header_view' ) ? '' : 'blog';
$footer_view = adswth_option('blog_footer_view' ) ? '' : 'blog';

?>

<?php get_header( $header_view ); ?>

<div class="container">

    <div id="content" class="content-area page-wrapper" role="main">

        <div class="blog_nav">

            <?php get_template_part( 'blog/template-parts/partials/top', 'navigation' ); ?>

            <?php get_template_part( 'blog/template-parts/partials/top', 'search' ); ?>

        </div>

        <?php adswth_breadcrumbs(); ?>

        <?php if( have_posts() ) : while( have_posts() ) : the_post() ?>

        <div class="article_full">

            <?php get_template_part( 'blog/template-parts/partials/single', 'right' ); ?>

            <?php get_template_part( 'blog/template-parts/partials/single', 'left' ); ?>


        </div>

        <?php endwhile; endif; ?>

        <?php get_template_part( 'blog/template-parts/partials/single', 'related' ); ?>

    </div>

</div>

<?php get_footer( $footer_view ); ?>