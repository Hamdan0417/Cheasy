<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 3.0.0
 */

if ( ! defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly

global $product;
?>

<div class="yith-wcwl-add-button">
    <button href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id, $base_url ) )?>" rel="nofollow" data-product-id="<?php echo $product_id ?>" data-product-type="<?php echo $product_type?>" data-original-product-id="<?php echo $parent_product_id ?>" class="<?php echo $link_classes ?>" data-title="<?php echo esc_attr( apply_filters( 'yith_wcwl_add_to_wishlist_title', $label ) ) ?>">
        <?php echo adswth_get_icon('heart-empty'); ?>
    </button>
</div>