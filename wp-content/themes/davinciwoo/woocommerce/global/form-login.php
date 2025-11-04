<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     7.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form class="woocommerce-form woocommerce-form-login nicelabel login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>

    <?php do_action( 'woocommerce_login_form_start' ); ?>

    <?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

    <div class="form-group">
        <input type="text" class="input-text w-100" name="username" id="username" autocomplete="username" />
        <label for="username"><span class="required">*</span><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
    </div>
    <div class="form-group">
        <input class="input-text w-100" type="password" name="password" id="password" autocomplete="current-password" />
        <label for="password"><span class="required">*</span><?php esc_html_e( 'Password', 'davinciwoo' ); ?></label>
    </div>

    <?php do_action( 'woocommerce_login_form' ); ?>

    <div class="row justify-content-between mt-2">
        <div class="col-auto font-12">
            <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
            <label class="checkbox woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
            </label>
        </div>
        <div class="col-auto font-12">
            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'davinciwoo' ); ?></a>
        </div>
    </div>

    <?php do_action( 'adswth_woocommerce_login_form_before_submit' ); ?>

    <div class="form-submit text-center mt-px-15">
        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
        <button type="submit" class="btn btn-secondary" name="login" value="<?php esc_attr_e( 'Log in', 'davinciwoo' ); ?>"><?php esc_html_e( 'Log in', 'davinciwoo' ); ?></button>
    </div>

    <?php do_action( 'woocommerce_login_form_end' ); ?>

</form>

