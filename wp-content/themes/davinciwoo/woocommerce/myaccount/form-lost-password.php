<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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

do_action( 'woocommerce_before_lost_password_form' );

?>

<div class="row justify-content-center">
    <div class="col-lg-6 col-xl-5">

        <p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'davinciwoo' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

        <form method="post" class="woocommerce-ResetPassword lost_reset_password nicelabel mt-px-25">

            <div class="row no-gutters">
                <div class="col">
                    <div class="form-group">
                        <input class="woocommerce-Input woocommerce-Input--text input-text w-100" type="text" name="user_login" id="user_login" autocomplete="username" />
                        <label for="user_login"><?php esc_html_e( 'Username or email', 'davinciwoo' ); ?></label>
                    </div>
                </div>
                <div class="col-auto ml-lg-1">
                    <?php do_action( 'woocommerce_lostpassword_form' ); ?>

                    <div class="form-submit text-center">
                        <input type="hidden" name="wc_reset_password" value="true" />
                        <button type="submit" class="btn btn-secondary" value="<?php esc_attr_e( 'Reset password', 'davinciwoo' ); ?>"><?php esc_html_e( 'Reset password', 'davinciwoo' ); ?></button>
                    </div>
                </div>
            </div>

            <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

        </form>
    </div>
</div>
<?php
do_action( 'woocommerce_after_lost_password_form' );
