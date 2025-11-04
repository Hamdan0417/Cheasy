<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $cross_sells ) : ?>

	<div class="cross-sells col-12 mt-xl-px-30 order-lg-3 mt-lg-px-30 order-md-3 mt-md-px-30">

        <?php
        $heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'You may be interested in&hellip;', 'woocommerce' ) );

        if ( $heading ) : ?>
            <div class="block-title-wrap d-flex align-items-center mb-px-25">
                <h3 class="text-uppercase block-title" ><?php echo esc_html( $heading ); ?></h3>
                <div class="block-title-divider"></div>
            </div>
        <?php endif; ?>

        <?php woocommerce_product_loop_start(); ?>

        <div class="three-item">
            <div class="row no-gutters product-slider" data-flickity-options='{
                                                              "cellAlign": "left",
                                                              "wrapAround": false,
                                                              "autoPlay": false,
                                                              "prevNextButtons": false,
                                                              "percentPosition": true,
                                                              "imagesLoaded": true,
                                                              "lazyLoad": 1,
                                                              "pageDots": true,
                                                              "contain": true
                                                          }'>

            <?php foreach ( $cross_sells as $cross_sell ) : ?>

                <?php
                    $post_object = get_post( $cross_sell->get_id() );

                    setup_postdata( $GLOBALS['post'] =& $post_object );
                ?>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <?php wc_get_template_part( 'content', 'product' ); ?>
                </div>

            <?php endforeach; ?>

            </div>
        </div>

        <?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
