<?php
/**
 * User: Denis Zharov
 * Date: 17.09.2018
 * Time: 14:20
 */

/**
 * Require Classes
 */
spl_autoload_register( function ( $className ) {

	$className = ltrim( $className, '\\' );
	$fileName  = '';

	if ( $lastNsPos = strrpos( $className, '\\' ) ) {

		$namespace = substr( $className, 0, $lastNsPos );
		$className = substr( $className, $lastNsPos + 1 );

		$fileName = str_replace( '\\', DIRECTORY_SEPARATOR, $namespace ) . DIRECTORY_SEPARATOR;
	}

	$fileName .= $className . '.php';

	$file = ADSW_THEME_PATH . '/include/classes/' . $fileName;

	if ( file_exists( $file ) ) {
		require( $file );
	}
} );

/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require ADSW_THEME_PATH . '/include/core/functions/function-conditionals.php';
require ADSW_THEME_PATH . '/include/core/functions/function-global.php';
require ADSW_THEME_PATH . '/include/core/functions/function-defaults.php';
require ADSW_THEME_PATH . '/include/core/functions/function-setup.php';

require ADSW_THEME_PATH . '/include/core/functions/function-template.php';

require ADSW_THEME_PATH . '/blog/blog-init.php';

/**
 * Check theme update
 */
if( is_admin_bar_showing() && current_user_can('manage_options') ){
    require ADSW_THEME_PATH . '/include/core/functions/function-update.php';
    new \adswth\adsUpgrade();
}


/**
 * Helper functions
 */
require ADSW_THEME_PATH . '/include/core/helpers/helpers-frontend.php';

// Include Kirki
include_once( ADSW_THEME_PATH . '/include/admin/kirki/kirki.php' );

/**
 * Theme Admin
 */
if( current_user_can( 'manage_options' ) ){
	require ADSW_THEME_PATH . '/include/admin/admin-init.php';
}

/**
 * Theme Admin Kit
 */
if( current_user_can( 'manage_options' ) ){
	require ADSW_THEME_PATH . '/include/admin/kit/kit-init.php';
	require ADSW_THEME_PATH . '/include/admin/kit/kit-handlers.php';
	require ADSW_THEME_PATH . '/include/admin/controller.php' ;
}

/**
 * Theme options
 */

// Include Customizer Settings
include_once( ADSW_THEME_PATH . '/include/admin/customizer/customizer-config.php' );

// Include Options Helpers
include_once( ADSW_THEME_PATH .'/include/admin/options/helpers/options-helpers.php' );

// Add Options
//include_once( ADSW_THEME_PATH . '/include/admin/options/global/options-general.php' );
include_once( ADSW_THEME_PATH . '/include/admin/options/styles/options-css.php' );
include_once( ADSW_THEME_PATH . '/include/admin/options/header/options-header.php' );
include_once( ADSW_THEME_PATH . '/include/admin/options/page-front/options-page-front.php' );
include_once( ADSW_THEME_PATH . '/include/admin/options/footer/options-footer.php');

//Blog
include_once( ADSW_THEME_PATH . '/include/admin/options/blog/options-blog.php');



if( is_woocommerce_activated() ) {
	include_once( ADSW_THEME_PATH .'/include/admin/options/shop/options-shop.php' );
}

/**
 * Structure.
 * Template functions used throughout the theme.
 */
require ADSW_THEME_PATH .'/include/structure/structure-breadcrumbs.php';
require ADSW_THEME_PATH .'/include/structure/structure-header.php';

/**
 * Load WooCommerce functions
 */
if ( is_woocommerce_activated() ) {
	require ADSW_THEME_PATH . '/include/woocommerce/structure-wc-global.php';
	require ADSW_THEME_PATH . '/include/woocommerce/structure-wc-category-page.php';
	require ADSW_THEME_PATH . '/include/woocommerce/structure-wc-product-box.php';
	require ADSW_THEME_PATH . '/include/woocommerce/structure-wc-product-page.php';
	require ADSW_THEME_PATH . '/include/woocommerce/structure-wc-my-account.php';
	require ADSW_THEME_PATH . '/include/woocommerce/structure-wc-cart.php';
	require ADSW_THEME_PATH . '/include/woocommerce/structure-wc-checkout.php';
	require ADSW_THEME_PATH . '/include/woocommerce/wc-template-functions.php';

}

/**
 * ADSWTH Theme Widgets
 */
require ADSW_THEME_PATH . '/include/widgets/widget-payment-methods.php';
require ADSW_THEME_PATH . '/include/widgets/widget-security-methods.php';

/**
 * Theme Integrations
 */

require ADSW_THEME_PATH . '/include/integrations/integrations.php';
