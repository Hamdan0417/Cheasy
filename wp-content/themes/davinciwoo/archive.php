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

        <?php if( is_category() ){ ?>

            <?php $category = get_category( get_query_var( 'cat' ) ); ?>

            <div class="blogH">
                <h1><?php echo $category->name; ?></h1><span>(<?php echo $category->category_count; ?>)</span>
            </div>

        <?php } //endif; ?>

        <?php if( have_posts() ) { ?>

            <?php $counter = 0; ?>

            <div class="common_news js-list_product">

            <?php while( have_posts() ) { the_post() ?>

                <?php if($counter == 3 ){ ?>

                    <?php if ( adswth_option('blog_banner_main') && adswth_option( 'blog_banner_main_link' )){ ?>
                        <div class="content_plus">
                            <a target="_blank" href="<?php echo adswth_option( 'blog_banner_main_link' )?>"><img src="<?php echo adswth_option( 'blog_banner_main' )?>" alt=""/></a>
                        </div>
                    <?php }?>

                <?php } //endif; ?>

                <?php get_template_part('blog/template-parts/single', 'cat'); ?>

                <?php $counter ++; ?>

            <?php } //enwhile; ?>

            <?php if( $counter < 4 ){ ?>
                <?php if ( adswth_option('blog_banner_main') && adswth_option( 'blog_banner_main_link' )){ ?>
                    <div class="content_plus">
                        <a target="_blank" href="<?php echo adswth_option( 'blog_banner_main_link' )?>"><img src="<?php echo adswth_option( 'blog_banner_main' )?>" alt=""/></a>
                    </div>
                <?php }?>
            <?php } //endif; ?>

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
