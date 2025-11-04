<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
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

do_action( 'woocommerce_before_reset_password_form' );
?>
<div class="row justify-content-center">
    <div class="col-lg-6 col-xl-5">

        <p class="text-center"><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'davinciwoo' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

        <form method="post" class="woocommerce-ResetPassword lost_reset_password nicelabel mt-px-25">

            <div class="form-group">
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text w-100" name="password_1" id="password_1" autocomplete="new-password" />
                <label for="password_1"><span class="required">*</span><?php esc_html_e( 'New password', 'davinciwoo' ); ?></label>
            </div>
            <div class="form-group">
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text w-100" name="password_2" id="password_2" autocomplete="new-password" />
                <label for="password_2"><span class="required">*</span><?php esc_html_e( 'Re-enter new password', 'davinciwoo' ); ?></label>
            </div>

            <input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
            <input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

            <?php do_action( 'woocommerce_resetpassword_form' ); ?>

            <div class="form-submit text-center mt-xl-px-30 mt-lg-px-25 mt-md-px-20">
                <input type="hidden" name="wc_reset_password" value="true" />
                <button type="submit" class="btn btn-secondary" value="<?php esc_attr_e( 'Save', 'davinciwoo' ); ?>"><?php esc_html_e( 'Save', 'davinciwoo' ); ?></button>
            </div>

            <?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>

        </form>
    </div>
</div>
<?php
do_action( 'woocommerce_after_reset_password_form' );
