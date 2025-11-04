<?php
/**
 *	Plugin Name: AliDropship Woo Product Video
 *	Plugin URI: https://alidropship.com/
 *	Description: Add video to single product page gallery
 *	Version: 0.8.1
 *	Text Domain: adswpv
 *	Requires at least: WP 5.4.1
 *	Author: Bogdan Gorchakov
 *	Author URI: https://yellowduck.me/
 *	License: MIT
 *  License URI:  http://www.opensource.org/licenses/mit-license.php
 */
 
if( ! defined('ADSWPV_VERSION') ) define( 'ADSWPV_VERSION', '0.8.1' );
if( ! defined('ADSWPV_PATH') )    define( 'ADSWPV_PATH', plugin_dir_path( __FILE__ ) );
if( ! defined('ADSWPV_URL') )     define( 'ADSWPV_URL', plugins_url('alids-woo-product-video') );
if( ! defined('ADSWPV_MIN' ) )    define( 'ADSWPV_MIN', '.min' ); // Production ADD .min
if( ! defined('ADSWPV_CODE') )    define( 'ADSWPV_CODE', 'ion72' );
if( ! defined('ADSWPV_ERROR') )   define( 'ADSWPV_ERROR', adswpv_check_server() );
/**
 * Localization
 */
function adswpv_lang_init() {
    
    load_plugin_textdomain( 'adswprv' );
}
add_action( 'init', 'adswpv_lang_init' );

function adswpv_check_server() {
    
    if( version_compare( '7.1', PHP_VERSION, '>' ) )
        return sprintf('PHP Version is not suitable. You need version 7.1+. %s',
            '<a href="https://alidropship.com/codex/6-install-ioncube-loader-hosting/" target="_blank">Learn more</a>.'
        );
    
    $ion_args = [ 'ion71' => '7.1', 'ion72' => '7.2', 'ion81' => '8.1' ];
    $ver      = explode('.', PHP_VERSION);
    $ion_pref = 'ion' . $ver[0] . $ver[1];
    
    if( $ion_pref != ADSWPV_CODE && $ver[0] . $ver[1] < 73 ) {
        return sprintf(
            'You installed AliDropship Woo Product Video plugin for PHP %1$s, but your version of PHP is %2$s.' . ' ' .
            'Please <a href="%3$s" target="_blank">download</a> and install AliDropship Post Purchase Upsell for PHP %2$s.',
            isset( $ion_args[ ADSWPV_CODE ] ) ? $ion_args[ ADSWPV_CODE ] : 'Unknown',
            PHP_VERSION,
            'https://alidropship.com/addons/ads_ppu/#updateaddon'
        );
    }
    
    $extensions = get_loaded_extensions();
    $key        = 'ionCube Loader';
    
    if( ! in_array( $key, $extensions ) )
        return sprintf( '%s Not found', $key) .
            '. <a href="https://alidropship.com/codex/6-install-ioncube-loader-hosting/" target="_blank">
            Please check instructions
        </a>.';
    
    $plugins_local  = apply_filters( 'active_plugins', (array) get_option( 'active_plugins', [] ) );
    $plugins_global = (array) get_site_option( 'active_sitewide_plugins', [] );
    
    require_once( ABSPATH . 'wp-admin/includes/plugin.php');
    
    if(
        ! is_multisite() &&
        ! in_array( 'woocommerce/woocommerce.php', $plugins_local ) ) {
        
        deactivate_plugins( ADSWPV_PATH . basename( __FILE__ ) );
        
        return __('AliDropship Woo Product Video add-on requires WooCommerce plugin for its proper work');
    }
    
    if( is_multisite()
        && ! array_key_exists( 'woocommerce/woocommerce.php', $plugins_global )
    ) {
        deactivate_plugins( ADSWPV_PATH . basename( __FILE__ ) );
        return __('AliDropship Woo Product Video add-on requires WooCommerce plugin for its proper work');
    }
    
    return false;
}

/**
 * adswpvideo_admin_notice__error
 */
function adswpvideo_admin_notice__error() {
    
    if( ADSWPV_ERROR )
        printf(
            '<div class="notice notice-error"><p>%s</p></div>',
            __( 'Error!', 'adswprv' ) . ' ' . ADSWPV_ERROR
        );
}

add_action( 'admin_notices', 'adswpvideo_admin_notice__error' );

if( ! ADSWPV_ERROR ) {
    
    if( is_admin() ) :
        
        require( ADSWPV_PATH . 'core/setup.php' );
        require( ADSWPV_PATH . 'core/update.php' );
        
        register_activation_hook( __FILE__, 'adswpv_install' );
        register_activation_hook( __FILE__, 'adswpv_activate' );
        register_uninstall_hook( __FILE__, 'adswpv_uninstall' );
    
    endif;
    
    require( ADSWPV_PATH . 'core/core.php' );
    require( ADSWPV_PATH . 'core/init.php' );
}
