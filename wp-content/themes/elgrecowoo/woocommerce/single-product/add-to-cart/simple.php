<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}



if ( $product->is_in_stock() ) :

	$class_view_cart = adswth_option( 'use_minicart' ) ? 'cart-popup' : '';
	$link_view_cart = adswth_option( 'use_minicart' ) ? '#' : wc_get_cart_url();

	?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>



            <div class="woocommerce-add-to-cart-group">
                <?php do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>

                <div class="single-quantity-wrap d-flex align-items-center">
                    <div class="name"><?php echo __( 'Quantity:', 'elgrecowoo' ); ?></div>
                    <?php
                    woocommerce_quantity_input( array(
                        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                    ) );

                    if(adswth_option('spp_show_in_stock_badge')) {
                        if($product->managing_stock()){
                            echo wc_get_stock_html($product); // WPCS: XSS ok.
                        } else { ?>
                            <p class="stock">
                                <?php
                                    $stock_status = $product->get_stock_status();
                                    $stock_status = str_replace( array('instock','outofstock', 'onbackorder'), array(__('In Stock', 'elgrecowoo'), __('Out of Stock', 'elgrecowoo'), __('On Back Order', 'elgrecowoo')), $stock_status );
                                    echo $stock_status;
                                ?>
                            </p>
                        <?php }
                    }
                    ?>
                </div>
                <?php wc_get_template_part( 'single-product/product', 'above-cart-badges' ); ?>
                <?php do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                <div class="single_add_to_cart_button-group">
                    <button data-button-text="<?php echo __( 'View cart', 'elgrecowoo' )?>" data-after-title-text="<?php echo __( 'has been added to your cart', 'elgrecowoo' )?>" type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button btn btn-primary btn-big alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
                    <div class="view-cart-wrap" <?php if ( WC()->cart->is_empty() ) { echo 'style="display:none;"'; } ?>>
                        <a href="<?php echo $link_view_cart ?>" class="view-cart <?php echo $class_view_cart ?>" ><?php echo __( 'View cart', 'elgrecowoo' ); ?></a>
                    </div>
                </div>
            </div>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
