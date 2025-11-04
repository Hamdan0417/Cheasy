<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$recently_viewed_ids = adswth_recently_viewed_ids();


if ( ! empty( $recently_viewed_ids ) && adswth_option( 'product_page_recently_show' ) ) : ?>

	<section class="recently-viewed recently mt-px-30">

        <div class="block-title-wrap d-flex align-items-center mb-px-25">
            <h3 class="text-uppercase block-title" ><?php esc_html_e( 'Recently viewed', 'davinciwoo' ) ?></h3>
            <div class="block-title-divider d-xl-none"></div>
        </div>

		<?php woocommerce_product_loop_start(); ?>

		<div class="three-item">
            <div class="row product-slider" data-flickity-options='{
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

			<?php foreach ( $recently_viewed_ids as $product_id ) :
                if(get_post_status($product_id) === FALSE) continue;?>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="row">
				    <?php
				    $post_object = get_post( $product_id );

				    if( !empty( $post_object ) ) {

					    setup_postdata( $GLOBALS[ 'post' ] =& $post_object );

					    wc_get_template_part( 'content', 'product' );
                    } ?>
                    </div>
                </div>

			<?php endforeach; ?>
            </div>
		</div>
		<?php woocommerce_product_loop_end(); ?>

	</section>

<?php endif;

wp_reset_postdata();