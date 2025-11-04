<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
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

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="col-lg-12">
    <div class="woocommerce-form-coupon-toggle mb-px-10">
        <?php echo apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>' ); ?>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form class="checkout_coupon woocommerce-form-coupon nicelabel" method="post" style="display:none">

                <p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></p>

                <div class="d-flex">

                    <div class="form-group mr-px-10 w-100">
                        <input type="text" name="coupon_code" class="input-text w-100" id="coupon_code" value="" />
                        <label for="coupon_code"><?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?></label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-secondary" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>