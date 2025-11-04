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
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if ($upsells && adswth_option( 'product_page_featured_products_show' )) :
    $count_slides = count($upsells);
    ?>

    <section class="up-sells upsells single-product-products row-full">
        <div class="container">

        <div class="block-title-wrap">
            <h3 class="block-title text-center pt-px-30 pb-px-20"><?php esc_html_e('Recommendations', 'elgrecowoo') ?></h3>
        </div>

        <?php woocommerce_product_loop_start(); ?>
        <div class="product-slider-up-sells">
            <div class="product-slider elgreco-product-slider">

                    <?php foreach ($upsells as $upsell) : ?>

                        <?php
                        $post_object = get_post($upsell->get_id());

                        setup_postdata($GLOBALS['post'] =& $post_object);
                        ?>

                        <div class="slide">

                            <?php wc_get_template_part('content', 'product'); ?>

                        </div>

                    <?php endforeach; ?>

            </div>
        </div>

        <?php woocommerce_product_loop_end(); ?>
        </div>
    </section>

<?php endif;

wp_reset_postdata();
