<?php
/**
 * User: Denis Zharov
 * Date: 17.09.2018
 * Time: 14:20
 */

if ( ! function_exists( 'is_nextend_facebook_login' ) ) {
	/**
	 * Returns true if Nextend facebook provider is enabled for v3
	 * or fallback return for Nextend facebook v2.
	 *
	 * @return bool
	 */
	function is_nextend_facebook_login() {
		if ( class_exists( 'NextendSocialLogin', false ) ) {
			return NextendSocialLogin::isProviderEnabled( 'facebook' );
		}
		return defined( 'NEW_FB_LOGIN' );
	}
}

if ( ! function_exists( 'is_nextend_google_login' ) ) {
	/**
	 * Returns true if Nextend google provider is enabled for v3
	 * or fallback return for Nextend google v1.
	 *
	 * @return bool
	 */
	function is_nextend_google_login() {
		if ( class_exists( 'NextendSocialLogin', false ) ) {
			return NextendSocialLogin::isProviderEnabled( 'google' );
		}
		return defined( 'NEW_GOOGLE_LOGIN' );
	}
}

if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	/**
	 * Returns true if WooCommerce plugin is activated
	 *
	 * @return bool
	 */
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' );
	}
}

if ( ! function_exists( 'is_adsw_activated' ) ) {
	/**
	 * Returns true if AliDropship Woo plugin is activated
	 *
	 * @return bool
	 */
	function is_adsw_activated() {

		$plugins_local = apply_filters( 'active_plugins', (array) get_option( 'active_plugins', [] ) );
		$plugins_global = (array) get_site_option( 'active_sitewide_plugins', [] );

		return ( in_array( 'alidswoo/alidswoo.php', $plugins_local ) || ( is_multisite() && array_key_exists( 'alidswoo/alidswoo.php' , $plugins_global ) ) ) && class_exists( '\adsw\Ads' );
	}
}

add_filter('wpcf7_autop_or_not', '__return_false');

