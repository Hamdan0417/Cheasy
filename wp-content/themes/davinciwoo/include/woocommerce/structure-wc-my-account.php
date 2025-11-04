<?php

function adswth_nextend_social_login() {

	$is_facebook_login = is_nextend_facebook_login();
	$is_google_login   = is_nextend_google_login();

	if ( $is_facebook_login || $is_google_login ) {
		echo '<div class="social-login text-center my-xl-px-30 my-lg-px-30">';
		echo '<span class="label font-12">' . __( 'Connect with:', 'davinciwoo' ) . '</span>';
	}
	 if ( $is_facebook_login && get_option( 'woocommerce_enable_myaccount_registration' ) == 'yes' && ! is_user_logged_in() ) { ?>
		 <a  href="<?php echo wp_login_url(); ?>?loginFacebook=1&redirect=<?php echo get_the_permalink(); ?>"
			 class="social-icon-wrap"
			 onclick="window.location = '<?php echo wp_login_url(); ?>?loginFacebook=1&redirect='+window.location.href return false">
			 <i class="social-icon-facebook"></i>
		 </a>
	<?php } ?>

	<?php if ( $is_google_login && get_option( 'woocommerce_enable_myaccount_registration' ) == 'yes' && ! is_user_logged_in() ) { ?>

		<a  href="<?php echo wp_login_url(); ?>?loginGoogle=1&redirect=<?php echo get_the_permalink(); ?>"
			class="social-icon-wrap"
		    onclick="window.location = '<?php echo wp_login_url(); ?>?loginGoogle=1&redirect='+window.location.href return false">
			<i class="social-icon-gplus"></i>
		</a>
	<?php }
	if ( $is_facebook_login || $is_google_login ) {
		echo '</div>';
	}
}
add_action( 'adswth_woocommerce_login_form_before_submit', 'adswth_nextend_social_login', 99 );

function adswth_woocommerce_before_account_navigation() {
    ?>
        <div class="woocommerce-MyAccount-navigation-wrap">

            <div class="account-user">

                <span class="image mr-half d-inline-block mr-2">
                    <?php
                        $current_user = wp_get_current_user();
                        $user_id = $current_user->ID;
                        echo get_avatar( $user_id, 60, null, null, array( 'class' => array( 'img-fluid', 'rounded-circle' ) ) );
                    ?>
                </span>

                <span class="user-name d-inline-block">

                    <?php echo $current_user->display_name; ?>

                    <span class="user-id font-12 text-999"><?php echo '#'.$user_id;?></span>

                </span>

            </div>
    <?php
}
add_action( 'woocommerce_before_account_navigation', 'adswth_woocommerce_before_account_navigation', 10 );

function adswth_woocommerce_after_account_navigation() {
	?>
        </div>
	<?php
}
add_action( 'woocommerce_after_account_navigation', 'adswth_woocommerce_after_account_navigation', 10 );