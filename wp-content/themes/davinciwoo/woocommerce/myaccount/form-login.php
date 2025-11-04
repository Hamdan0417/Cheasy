<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="row justify-content-center" id="customer_login">

	<div class="col-lg-6">

<?php endif; ?>

		<h3 class="text-uppercase text-center mb-px-15"><?php esc_html_e( 'Returning customer', 'davinciwoo' ); ?></h3>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-10 col-xl-8">

                <form class="nicelabel login" method="post">

                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <div class="form-group">
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text w-100" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                        <label for="username"><span class="required">*</span><?php esc_html_e( 'Your login or email', 'davinciwoo' ); ?></label>
                    </div>
                    <div class="form-group">
                        <input class="woocommerce-Input woocommerce-Input--text input-text w-100" type="password" name="password" id="password" autocomplete="current-password" />
                        <label for="password"><span class="required">*</span><?php esc_html_e( 'Password', 'davinciwoo' ); ?></label>
                    </div>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <div class="row justify-content-between mt-2">
                        <div class="col-auto font-12">
                            <label class="checkbox woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'davinciwoo' ); ?></span>
                            </label>
                        </div>
                        <div class="col-auto font-12">
                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password', 'davinciwoo' ); ?></a>
                        </div>
                    </div>

	                <?php do_action( 'adswth_woocommerce_login_form_before_submit' ); ?>

                    <div class="form-submit text-center mt-xl-px-30 mt-lg-px-25 mt-md-px-20">
	                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                        <button type="submit" class="btn btn-secondary" name="login" value="<?php esc_attr_e( 'Log in', 'davinciwoo' ); ?>"><?php esc_html_e( 'Log in', 'davinciwoo' ); ?></button>
                    </div>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>

                </form>

            </div>
        </div>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="col-lg-6 mt-md-px-30 mt-sm-px-30 mt-xs-px-30">

		<h3 class="text-uppercase text-center mb-px-15"><?php esc_html_e( 'Register', 'davinciwoo' ); ?></h3>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-10 col-xl-8">
                <form method="post" class="nicelabel register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

                    <?php do_action( 'woocommerce_register_form_start' ); ?>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                    <div class="form-group">
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text w-100" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                        <label for="reg_username"><span class="required">*</span><?php esc_html_e( 'Username', 'davinciwoo' ); ?></label>
                    </div>

                    <?php endif; ?>

                    <div class="form-group">
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text w-100" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                        <label for="reg_email"><span class="required">*</span><?php esc_html_e( 'Email', 'davinciwoo' ); ?></label>
                    </div>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                    <div class="form-group">
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text w-100" name="password" id="reg_password" autocomplete="new-password" />
                        <label for="reg_password"><span class="required">*</span><?php esc_html_e( 'Password', 'davinciwoo' ); ?></label>
                    </div>

                    <?php else : ?>

                        <div><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></div>

                    <?php endif; ?>

                    <?php do_action( 'woocommerce_register_form' ); ?>

                    <div class="form-submit text-center mt-xl-px-30 mt-lg-px-25 mt-md-px-20">
                        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                        <button type="submit" class="btn btn-secondary" name="register" value="<?php esc_attr_e( 'Create an Account', 'davinciwoo' ); ?>"><?php esc_html_e( 'Create an Account', 'davinciwoo' ); ?></button>
                    </div>

                    <?php do_action( 'woocommerce_register_form_end' ); ?>

                </form>
            </div>
        </div>
	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
