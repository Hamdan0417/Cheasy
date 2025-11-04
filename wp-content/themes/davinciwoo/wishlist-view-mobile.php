<?php
/**
 * Wishlist page template - Standard Layout
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 3.0.0
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
?>

<!-- WISHLIST MOBILE -->
<ul class="shop_table cart wishlist_table wishlist_view responsive mobile <?php echo $show_cb ? 'with-checkbox' : '' ?>" data-pagination="<?php echo esc_attr( $pagination )?>" data-per-page="<?php echo esc_attr( $per_page )?>" data-page="<?php echo esc_attr( $current_page )?>" data-id="<?php echo $wishlist_id ?>" data-token="<?php echo $wishlist_token ?>">
    <?php
    if( $wishlist && $wishlist->has_items() ) :
        foreach( $wishlist_items as $item ) :
            /**
             * @var $item \YITH_WCWL_Wishlist_Item
             */
            global $product;

            $product = $item->get_product();
            $availability = $product->get_availability();
            $stock_status = isset( $availability['class'] ) ? $availability['class'] : false;

            if( $product && $product->exists() ) :
                ?>
                <li id="yith-wcwl-row-<?php echo $item->get_product_id() ?>" data-row-id="<?php echo $item->get_product_id() ?>">
                    <?php if( $show_cb ) : ?>
                        <div class="product-checkbox">
                            <input type="checkbox" value="yes" name="items[<?php echo esc_attr( $item->get_product_id() ) ?>][cb]" />
                        </div>
                    <?php endif ?>

                    <div class="item-wrapper d-flex">
                        <div class="product-thumbnail">
                            <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item->get_product_id() ) ) ) ?>">
                                <div class="cart-image-wrap">
			                        <?php echo $product->get_image() ?>
                                </div>
                            </a>
                            <?php if( $show_remove_product ): ?>
                                <div class="product-remove">
                                    <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item->get_product_id() ) ) ?>" class="remove_from_wishlist remove" title="<?php echo apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'yith-woocommerce-wishlist' ) ); ?>"><?php _e( 'Remove', 'davinciwoo'); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="item-details">
                            <div class="product-name">
                                <h3><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?></h3>
		                        <?php do_action( 'yith_wcwl_table_after_product_name', $item ); ?>
                            </div>
                        </div>
                    </div>

                    <div class="additional-info-wrapper">
                        <?php if( $show_variation || $show_dateadded || $show_price ): ?>
                            <table class="item-details-table">

                                <?php if( $show_variation && $product->is_type( 'variation' ) ): ?>
                                    <?php
                                    /**
                                     * @var $product \WC_Product_Variation
                                     */
                                    $attributes = $product->get_attributes();

                                    if( ! empty( $attributes ) ):
                                        foreach( $attributes as $name => $value ):
                                            if( ! taxonomy_exists( $name ) ){
                                                continue;
                                            }

                                            $term = get_term_by( 'slug', $value, $name );

                                            if ( ! is_wp_error( $term ) && ! empty( $term->name ) ) {
                                                $value = $term->name;
                                            }
                                            ?>
                                            <tr>
                                                <td class="label">
                                                    <?php echo wc_attribute_label( $name, $product ) ?>:
                                                </td>
                                                <td class="value">
                                                    <?php echo rawurldecode( $value ) ?>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                <?php endif; ?>

                                <?php if( $show_dateadded && $item->get_date_added() ): ?>
                                    <tr>
                                        <td class="label">
                                            <?php _e( 'Added on:', 'yith-woocommerce-wishlist' ) ?>
                                        </td>
                                        <td class="value">
                                            <?php echo $item->get_date_added_formatted() ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php if( $show_price || $show_price_variations ) : ?>
                                    <tr>
                                        <td class="label">
                                            <?php _e( 'Price:', 'yith-woocommerce-wishlist' ) ?>
                                        </td>
                                        <td class="value">
                                            <?php
                                            if( $show_price ) {
                                                echo $item->get_formatted_product_price();
                                            }

                                            if( $show_price_variations ){
                                                echo $item->get_price_variation();
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endif ?>

                            </table>
                        <?php endif; ?>
                        <?php if( $show_quantity || $show_stock_status ): ?>
                            <table class="additional-info">
	                            <?php if( $show_quantity ) : ?>
                                    <tr>
                                        <td class="label">
                                            <?php _e( 'Quantity:', 'yith-woocommerce-wishlist' ) ?>
                                        </td>
                                        <td class="value">
                                            <?php if( ! $no_interactions && $is_user_owner ): ?>
                                                <input type="number" min="1" step="1" name="items[<?php echo esc_attr( $item->get_product_id() )?>][quantity]" value="<?php echo esc_attr( $item->get_quantity() )?>" />
                                            <?php else: ?>
                                                <?php echo $item->get_quantity() ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
	                            <?php endif;?>

	                            <?php if( $show_stock_status ) : ?>
                                    <tr>
                                        <td class="label">
                                            <?php _e( 'Stock:', 'yith-woocommerce-wishlist' ) ?>
                                        </td>
                                        <td class="value">
                                            <?php echo $stock_status == 'out-of-stock' ? '<span class="wishlist-out-of-stock">' . __( 'Out of stock', 'yith-woocommerce-wishlist' ) . '</span>' : '<span class="wishlist-in-stock">' . __( 'In Stock', 'yith-woocommerce-wishlist' ) . '</span>'; ?>
                                        </td>
                                    </tr>
	                            <?php endif ?>
                            </table>
                        <?php endif; ?>

                        <!-- Add to cart button -->
	                    <?php if( $show_add_to_cart && isset( $stock_status ) && $stock_status != 'out-of-stock' ): ?>
                            <div class="product-add-to-cart">
		                        <?php woocommerce_template_loop_add_to_cart( array( 'quantity' => $show_quantity ? $item->get_quantity() : 1 ) ); ?>
                            </div>
	                    <?php endif ?>

                        <!-- Change wishlist -->
	                    <?php if( $move_to_another_wishlist && $available_multi_wishlist && count( $users_wishlists ) > 1 ): ?>
                            <div class="move-to-another-wishlist">
                                <?php if( 'select' == $move_to_another_wishlist_type ): ?>
                                    <select class="change-wishlist selectBox">
                                        <option value=""><?php _e( 'Move', 'yith-woocommerce-wishlist' ) ?></option>
                                        <?php
                                        foreach( $users_wishlists as $wl ):
                                            /**
                                             * @var $wl \YITH_WCWL_Wishlist
                                             */
                                            if( $wl->get_token() == $wishlist_token ){
                                                continue;
                                            }
                                            ?>
                                            <option value="<?php echo esc_attr( $wl->get_token() ) ?>">
                                                <?php echo sprintf( '%s - %s', $wl->get_formatted_name(), $wl->get_formatted_privacy() ); ?>
                                            </option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                <?php else: ?>
                                    <a href="#move_to_another_wishlist" class="move-to-another-wishlist-button" data-rel="prettyPhoto[move_to_another_wishlist]">
                                        <?php echo apply_filters( 'yith_wcwl_move_to_another_list_label', __( 'Move to another list &rsaquo;', 'yith-woocommerce-wishlist' ) ) ?>
                                    </a>
                                <?php endif; ?>
                            </div>
	                    <?php endif; ?>
                    </div>
                </li>
            <?php
            endif;
        endforeach;
    else: ?>
        <p class="wishlist-empty">
            <?php echo apply_filters( 'yith_wcwl_no_product_to_remove_message', __( 'No products added to the wishlist', 'yith-woocommerce-wishlist' ) ) ?>
        </p>
    <?php
    endif;

    if( ! empty( $page_links ) ) : ?>
        <p class="pagination-row">
            <?php echo $page_links ?>
        </p>
    <?php endif ?>

</ul>