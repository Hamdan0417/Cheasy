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

<!-- WISHLIST TABLE -->
<table class="shop_table cart wishlist_table wishlist_view traditional responsive" data-pagination="<?php echo esc_attr( $pagination )?>" data-per-page="<?php echo esc_attr( $per_page )?>" data-page="<?php echo esc_attr( $current_page )?>" data-id="<?php echo $wishlist_id ?>" data-token="<?php echo $wishlist_token ?>">

    <?php $column_count = 2; ?>

    <thead>
    <tr>
        <?php if( $show_cb ) : $column_count ++; ?>
            <th class="product-checkbox">
                <input type="checkbox" value="" name="" id="bulk_add_to_cart"/>
            </th>
        <?php endif; ?>

        <?php $column_count ++; ?>

        <th class="product-thumbnail"></th>

        <th class="product-name">
            <span class="nobr">
                <?php echo apply_filters( 'yith_wcwl_wishlist_view_name_heading', __( 'Product name', 'yith-woocommerce-wishlist' ) ) ?>
            </span>
        </th>

        <?php if( $show_price || $show_price_variations ) : $column_count ++; ?>
            <th class="product-price">
                <span class="nobr">
                    <?php echo apply_filters( 'yith_wcwl_wishlist_view_price_heading', __( 'Unit price', 'yith-woocommerce-wishlist' ) ) ?>
                </span>
            </th>
        <?php endif; ?>

        <?php if( $show_quantity ) : $column_count ++; ?>
            <th class="product-quantity">
                <span class="nobr">
                    <?php echo apply_filters( 'yith_wcwl_wishlist_view_quantity_heading', __( 'Quantity', 'yith-woocommerce-wishlist' ) ) ?>
                </span>
            </th>
        <?php endif;?>

        <?php if( $show_stock_status ) : $column_count ++; ?>
            <th class="product-stock-status">
                <span class="nobr">
                    <?php echo apply_filters( 'yith_wcwl_wishlist_view_stock_heading', __( 'Stock status', 'yith-woocommerce-wishlist' ) ) ?>
                </span>
            </th>
        <?php endif; ?>

        <?php if( $show_last_column ) : $column_count ++; ?>
            <th class="product-add-to-cart"></th>
        <?php endif; ?>

        <?php if( $enable_drag_n_drop ): $column_count ++; ?>
            <th class="product-arrange">
                <span class="nobr">
                    <?php echo apply_filters( 'yith_wcwl_wishlist_view_arrange_heading', __( 'Arrange', 'yith-woocommerce-wishlist' ) )?>
                </span>
            </th>
        <?php endif; ?>
    </tr>
    </thead>

    <tbody class="wishlist-items-wrapper">
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
                <tr id="yith-wcwl-row-<?php echo $item->get_product_id() ?>" data-row-id="<?php echo $item->get_product_id() ?>">
                    <?php if( $show_cb ) : ?>
                        <td class="product-checkbox">
                            <input type="checkbox" value="yes" name="items[<?php echo esc_attr( $item->get_product_id() ) ?>][cb]" />
                        </td>
                    <?php endif ?>


                    <td class="product-thumbnail">
                        <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item->get_product_id() ) ) ) ?>">
                            <div class="cart-image-wrap">
                                <div class="cart-image-inner">
                                    <?php echo $product->get_image() ?>
                                </div>
                            </div>
                        </a>

                        <?php if( $show_remove_product ): ?>
                            <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item->get_product_id() ) ) ?>" class="remove remove_from_wishlist" title="<?php echo apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'yith-woocommerce-wishlist' ) ); ?>"><?php _e( 'Remove', 'davinciwoo'); ?></a>
                        <?php endif; ?>
                    </td>

                    <td class="product-name">
                        <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item->get_product_id() ) ) ) ?>"><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?></a>

                        <?php
                        if( $show_variation && $product->is_type( 'variation' ) ){
                            /**
                             * @var $product \WC_Product_Variation
                             */
                            echo wc_get_formatted_variation( $product );
                        }
                        ?>

                        <?php do_action( 'yith_wcwl_table_after_product_name', $item ); ?>
                    </td>

                    <?php if( $show_price || $show_price_variations ) : ?>
                        <td class="product-price">
                            <?php
                            if( $show_price ) {
                                echo $item->get_formatted_product_price();
                            }

                            if( $show_price_variations ){
                                echo $item->get_price_variation();
                            }
                            ?>
                        </td>
                    <?php endif ?>

                    <?php if( $show_quantity ) : ?>
                        <td class="product-quantity">
                            <?php if( ! $no_interactions && $is_user_owner ): ?>
                                <input type="number" min="1" step="1" name="items[<?php echo esc_attr( $item->get_product_id() )?>][quantity]" value="<?php echo esc_attr( $item->get_quantity() )?>" />
                            <?php else: ?>
                                <?php echo $item->get_quantity() ?>
                            <?php endif; ?>
                        </td>
                    <?php endif;?>

                    <?php if( $show_stock_status ) : ?>
                        <td class="product-stock-status">
                            <?php echo $stock_status == 'out-of-stock' ? '<span class="wishlist-out-of-stock">' . apply_filters( 'yith_wcwl_out_of_stock_label', __( 'Out of stock', 'yith-woocommerce-wishlist' ) ) . '</span>' : '<span class="wishlist-in-stock">' . apply_filters( 'yith_wcwl_in_stock_label', __( 'In Stock', 'yith-woocommerce-wishlist' ) ) . '</span>'; ?>
                        </td>
                    <?php endif ?>

                    <?php if( $show_last_column ): ?>
                        <td class="product-add-to-cart">
                            <!-- Date added -->
                            <?php
                            if( $show_dateadded && $item->get_date_added() ):
                                echo '<span class="dateadded">' . sprintf( __( 'Added on: %s', 'yith-woocommerce-wishlist' ), $item->get_date_added_formatted() ) . '</span>';
                            endif;
                            ?>

                            <!-- Add to cart button -->
                            <?php if( $show_add_to_cart && isset( $stock_status ) && $stock_status != 'out-of-stock' ): ?>
                                <?php woocommerce_template_loop_add_to_cart( array( 'quantity' => $show_quantity ? $item->get_quantity() : 1 ) ); ?>
                            <?php endif ?>

                            <!-- Change wishlist -->
                            <?php if( $move_to_another_wishlist && $available_multi_wishlist && count( $users_wishlists ) > 1 ): ?>
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
                            <?php endif; ?>

                            <!-- Remove from wishlist -->
                            <?php if( $repeat_remove_button ): ?>
                                <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item->get_product_id() ) ) ?>" class="remove_from_wishlist button" title="<?php echo apply_filters( 'yith_wcwl_remove_product_wishlist_message_title',__( 'Remove this product', 'yith-woocommerce-wishlist' )); ?>"><?php _e( 'Remove', 'yith-woocommerce-wishlist' ) ?></a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>

                    <?php if( $enable_drag_n_drop ): ?>
                        <td class="product-arrange ">
                            <i class="fa fa-arrows"></i>
                            <input type="hidden" name="items[<?php echo esc_attr( $item->get_product_id() )?>][position]" value="<?php echo esc_attr( $item->get_position() )?>" />
                        </td>
                    <?php endif; ?>
                </tr>
            <?php
            endif;
        endforeach;
    else: ?>
        <tr>
            <td colspan="<?php echo esc_attr( $column_count ) ?>" class="wishlist-empty"><?php echo apply_filters( 'yith_wcwl_no_product_to_remove_message', __( 'No products added to the wishlist', 'yith-woocommerce-wishlist' ) ) ?></td>
        </tr>
    <?php
    endif;

    if( ! empty( $page_links ) ) : ?>
        <tr class="pagination-row">
            <td colspan="<?php echo esc_attr( $column_count ) ?>"><?php echo $page_links ?></td>
        </tr>
    <?php endif ?>
    </tbody>

</table>