<?php $product_ids = get_post_meta( $post->ID, 'adswth_linked_products', true ); ?>

<?php if ( adswth_option('blog_banner_single') && adswth_option( 'blog_banner_single_link' ) ||
    !empty( $product_ids ) && is_array( $product_ids ) && count( $product_ids ) > 0 ){ ?>

<div class="articleR">

    <?php if ( adswth_option('blog_banner_single') && adswth_option( 'blog_banner_single_link' )){ ?>

        <div class="content_plusR">
            <a target="_blank" href="<?php echo adswth_option( 'blog_banner_single_link' )?>"><img src="<?php echo adswth_option( 'blog_banner_single' )?>" alt=""/></a>
        </div>

    <?php }?>

    <?php if( !empty( $product_ids ) && is_array( $product_ids ) && count( $product_ids ) > 0 ){ ?>

        <div class="woocommerce product-sidebar blog_goods_cont">

            <h5 class="hugeH5 aship-title"><?php echo adswth_option( 'blog_shop_this_story_heading' )?></h5>

            <?php woocommerce_product_loop_start(); ?>

            <div class="three-item">
                <div class="row no-gutters product-slider linked-products" data-flickity-options='{
                                                                          "cellAlign": "left",
                                                                          "wrapAround": false,
                                                                          "autoPlay": false,
                                                                          "prevNextButtons": false,
                                                                          "percentPosition": true,
                                                                          "imagesLoaded": true,
                                                                          "lazyLoad": 1,
                                                                          "pageDots": true,
                                                                          "contain": true,
                                                                          "groupCells": "100%",
                                                                          "watchCSS": true
                                                                      }'>

                    <?php foreach ( $product_ids as $product_id ) : ?>

                        <?php
                        $post_object = get_post( $product_id );

                        setup_postdata( $GLOBALS['post'] =& $post_object );
                        ?>

                        <div class="col-xl-12 col-lg-4 col-md-6">

                            <?php wc_get_template_part( 'content', 'product' ); ?>

                        </div>

                    <?php endforeach; ?>

                </div>
            </div>

            <?php woocommerce_product_loop_end(); ?>

            <?php wp_reset_postdata(); ?>

        </div>

    <?php } ?>

</div>

<?php } //endif; ?>