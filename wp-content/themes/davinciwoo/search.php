<?php
/**
 * User: Denis Zharov
 * Date: 17.09.2018
 * Time: 13:06
 *
 * Blog Archive Page
 */

global $wp_query;
$posts_count = $wp_query->post_count;

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

        <div class="searchH">
            <h5><?php _e( 'Search results for', 'davinciwoo' ) ?>: <span><?php echo  get_search_query(); ?> (<?php echo $wp_query->found_posts; ?>)</span></h5>
        </div>

        <?php if( have_posts() ) { ?>


            <div class="search_page_results js-list_product">

                <?php while( have_posts() ) { the_post() ?>


                    <?php get_template_part('blog/template-parts/single', 'search'); ?>


                <?php } //enwhile; ?>

            </div> <!-- \.common_news -->


        <?php } else { // if no posts ?>

        <?php } //endif; ?>

    </div>

    <?php if (  $wp_query->max_num_pages > 1 ) { ?>

        <div class="load_more_cont">
            <span class="btn btn-blog btn-primary load_more"><?php _e('Load More Articles', 'davinciwoo');?></span>
        </div>

    <?php } //endif; ?>

</div>

<?php get_footer( $footer_view ); ?>
