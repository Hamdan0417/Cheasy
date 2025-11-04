<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php
$val_mob = adswth_option( 'woo_product_cat_mob' );
$val_tab = adswth_option( 'woo_product_cat_tab' );
$colClass = "col col-lg-3 product-cat-wrap";
switch($val_mob){
    case 3:
        $colClass .= " col-4 col-sm three-per-row";
        break;
    case 2:
        $colClass .= " col-6 col-sm two-per-row";
        break;
    default:
        $colClass .= " col-12";
}
switch($val_tab){
    case 4:
        $colClass .= " col-md-3 md-four-per-row";
        break;
    case 3:
        $colClass .= " col-md-4 md-three-per-row";
        break;
    case 2:
        $colClass .= " col-md-6 md-two-per-row";
        break;
    default:
        $colClass .= " col-md-12";
}
?>

<div <?php wc_product_cat_class( $colClass, $category ); ?>>
    <div class="product-small">
	<?php
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );

	/**
	 * woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category );

	/**
	 * woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	do_action( 'woocommerce_shop_loop_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category ); ?>
    </div>
</div>
