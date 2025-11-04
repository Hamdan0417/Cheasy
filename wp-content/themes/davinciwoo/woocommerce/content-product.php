<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$val = adswth_option('woo_product_cat_mob');
?>
<div class="<?php echo ( $val === '2' && is_archive() ) ? 'col col-6 col-sm two-per-row ' : 'col col-12 '; ?> product-cat-wrap">
<?php
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Check stock status.
$out_of_stock = get_post_meta( $post->ID, '_stock_status', true ) == 'outofstock';

// Extra post classes.
$classes   = [];
$classes[] = 'item';
$classes[] = 'product-small';
//$classes[] = 'col';

if ( $out_of_stock ) $classes[] = 'out-of-stock';

?>

<div <?php wc_product_class( $classes, $product ) ?>>
	<div class="item-inner">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10 //removed in /include/woocommerce/structure-wc-product-box.php
		 */
		do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<div class="product-box">
			<div class="box-image has-hover">
				<?php
				/**
				 * @hooked woocommerce_show_product_loop_sale_flash - 10 //added in /include/woocommerce/structure-wc-product-box.php
				 */
				do_action( 'adswth_woocommerce_shop_loop_sale_flash', $post->ID );?>
                <div class="image-tools top right">
					<?php do_action( 'adswth_product_box_tools_top' ); ?>
                </div>
				<?php
				/**
				 * Hook: woocommerce_before_shop_loop_item.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10 //added in /include/woocommerce/structure-wc-product-box.php
				 */
				do_action( 'adswth_before_shop_loop_item_image' ); ?>
				<div class="box-image-wrap">
                    <div class="box-image-inner">
                    <?php
                    /**
                     * @hooked woocommerce_template_loop_product_thumbnail - 10 //added in /include/woocommerce/structure-wc-product-box.php
                     */
                    do_action( 'adswth_woocommerce_shop_loop_images' );?>
                    </div>
                    <?php do_action('ads_product_item_thumb_box', $post->ID);?>
				</div>
				<?php
				/**
				 * Hook: woocommerce_before_shop_loop_item.
				 *
				 * @hooked woocommerce_template_loop_product_link_close - 5 //added in /include/woocommerce/structure-wc-product-box.php
				 */
				do_action( 'adswth_after_shop_loop_item_image' ); ?>
			</div>


			<div class="box-text">
			<?php
			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
             * @hooked woocommerce_template_loop_product_link_close - 5 //added in /include/woocommerce/structure-wc-product-box.php
			 * @hooked woocommerce_show_product_loop_sale_flash - 10  //removed in /include/woocommerce/structure-wc-product-box.php
			 * @hooked woocommerce_template_loop_product_thumbnail - 10 //removed in /include/woocommerce/structure-wc-product-box.php
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
			<?php /**
			 * Hook: woocommerce_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' ); ?>
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
             * @hooked woocommerce_template_loop_product_link_close - 30 //added in /include/woocommerce/structure-wc-product-box.php
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );?>
			</div>

		</div>
		<?php
		/**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5 //removed in /include/woocommerce/structure-wc-product-box.php
		 * @hooked woocommerce_template_loop_add_to_cart - 10 //removed in /include/woocommerce/structure-wc-product-box.php
		 */
		do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
</div>
</div>