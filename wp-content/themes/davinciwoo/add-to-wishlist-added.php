<?php
/**
 * Add to wishlist button template - Added to list
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
    <button data-item-id="<?php echo esc_attr( $found_item->get_id() ) ?>" data-product-id="<?php echo esc_attr( $product_id ) ?>" class="delete_item <?php echo $link_classes ?>" data-title="<?php echo esc_attr( apply_filters( 'yith_wcwl_add_to_wishlist_title', $label ) ) ?>">
        <span class="feedback"><?php echo adswth_get_icon('heart'); ?></span>
    </button>
</div>