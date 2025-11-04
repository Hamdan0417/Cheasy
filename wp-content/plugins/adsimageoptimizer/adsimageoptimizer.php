<?php
/**
 * Plugin Name: Ads SEO Image Optimizer
 * Description: Increase the speed of your site and gain additional traffic from Google with image compression and SEO image optimization.
 * Version: 1.2.7
 * Author: Yaroslav Nevskiy & Vitaly Kukin & Dmitriy Trifanov
 * Plugin URI: https://alidropship.com/addons/seo-image-optimizer/
 * Author URI: https://alidropship.com/
 **/
 
if( ! defined('IO_UPLOAD_DIR_DATA') ) define( 'IO_UPLOAD_DIR_DATA', wp_upload_dir() );
if( ! defined('IO_VERSION') )         define( 'IO_VERSION', '1.2.7' );
if( ! defined('IO_CORE_DIR') )        define( 'IO_CORE_DIR', 'core' );
if( ! defined('IO_PREFIX_CLASS') )    define( 'IO_PREFIX_CLASS', 'IO' );
if( ! defined('IO_PLUGIN_DIR') )      define( 'IO_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );
if( ! defined('IO_PLUGIN_PATH') )     define( 'IO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
if( ! defined('IO_WATERMARK_DIR') )   define( 'IO_WATERMARK_DIR', IO_UPLOAD_DIR_DATA['basedir'] . "/io-watermark" );
if( ! defined('IO_PLUGIN') )          define( 'IO_PLUGIN', io_factory_data() );
if( ! defined('IO_CODE') )            define( 'IO_CODE', 'ion81' );
if( ! defined('IO_ERROR') )           define( 'IO_ERROR', io_check_server() );

/**
 * Localization
 */
function io_lang_init() {
    
    load_plugin_textdomain('ads_IO');
}
add_action( 'init', 'io_lang_init' );

function io_factory_data() {
    
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    
    $primary = false;
    
    if( is_plugin_active( 'alids/alids.php' ) || is_plugin_active( 'sellvia-platform/sellvia-platform.php' )) {
        $primary = '\IO\core\helpers\alidsImageData';
    } elseif( is_plugin_active( 'alidswoo/alidswoo.php' ) ) {
        $primary = '\IO\core\helpers\alidswooImageData';
    } elseif( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        $primary = '\IO\core\helpers\wooImageData';
    }
    
    return $primary;
}

function io_check_server() {

    if( version_compare( '7.1', PHP_VERSION, '>' ) ) {
        return sprintf( 'PHP Version is not suitable. You need version 7.1+. %s',
            '<a href="https://alidropship.com/codex/6-install-ioncube-loader-hosting/" target="_blank">Learn more</a>.'
        );
    }

    $ion_args = [ 'ion71' => '7.1', 'ion72' => '7.2', 'ion81' => '8.1' ];
    $ver      = explode( '.', PHP_VERSION );
    $ion_pref = 'ion' . $ver[0] . $ver[1];

    if( $ion_pref != IO_CODE && $ver[0] . $ver[1] < 73 ) {
        return sprintf(
            'You installed AliDropship Image Optimizer plugin for PHP %1$s, but your version of PHP is %2$s.' . ' ' .
            'Please <a href="%3$s" target="_blank">download</a> and install AliDropship Image Optimizer plugin for PHP %2$s.',
            isset( $ion_args[ IO_CODE ] ) ? $ion_args[ IO_CODE ] : 'Unknown',
            PHP_VERSION,
            'https://alidropship.com/addons/IO/#updateaddon'
        );
    }

    $extensions = get_loaded_extensions();
    $key        = 'ionCube Loader';

    if( !in_array( $key, $extensions ) ) {
        return sprintf( __( '%s Not found' ), $key ) .
            '. <a href="https://alidropship.com/codex/6-install-ioncube-loader-hosting/" target="_blank">
            Please check instructions
        </a>.';
    }

    $plugins_local  = apply_filters( 'active_plugins', (array) get_option( 'active_plugins', [] ) );
    $plugins_global = (array) get_site_option( 'active_sitewide_plugins', [] );

    $isInstallAlids = in_array( 'alids/alids.php', $plugins_local ) || array_key_exists('alidswoo/alidswoo.php', $plugins_global);

    $isInstallWooAlids = in_array( 'alidswoo/alidswoo.php', $plugins_local ) || array_key_exists('alidswoo/alidswoo.php', $plugins_global);

    $isInstallSellvia = in_array( 'sellvia-platform/sellvia-platform.php', $plugins_local ) || array_key_exists('sellvia-platform/sellvia-platform.php', $plugins_global);

    $isInstallWoo = in_array( 'woocommerce/woocommerce.php', $plugins_local ) || array_key_exists('woocommerce/woocommerce.php', $plugins_global);

    $isInstallPlugins = $isInstallAlids || $isInstallWooAlids || $isInstallSellvia || $isInstallWoo;

    require_once( ABSPATH . 'wp-admin/includes/plugin.php');

    if( !$isInstallPlugins ) {
        return __( 'AliDropship Image Optimizer add-on requires Alidropship plugin or AliDropship Woo plugin for its proper work', 'IO' );
    }

    return false;
}

function io_check_display(){
    
    if( isset( $_GET['page'] ) ){
            if(    $_GET['page'] == 'image-optimizer-minimization' 
                || $_GET['page'] == 'image-optimizer-alt-meta' 
                || $_GET['page'] == 'image-optimizer-rename'
                || $_GET['page'] == 'image-optimizer-license'
                || $_GET['page'] == 'image-optimizer-watermark'
            ){
               return true;
        }  
    }

    return false;
}

function io_admin_notice__error() {
    
     if( IO_ERROR ) {
        
        $class   = 'notice notice-error';
        $message = __( 'Error!', 'ads_IO' ) . ' ' . IO_ERROR;
        
        printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
    }

    if( preg_replace( '~[^0-9]+~','',ini_get('memory_limit') ) < 256 && !stristr( ini_get('memory_limit'), 'g' ) && io_check_display() ) {
        $class   = 'notice notice-warning';
        $message = __( 'For correct operation, a minimum of 256 Mb RAM is required.', 'ads_IO' ) ;
        
        printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
    }
}
add_action( 'admin_notices', 'io_admin_notice__error' );

if( ! IO_ERROR ) {
    
    require_once __DIR__ . '/autoloader.php';
    require_once __DIR__ . '/functions.php';
    
    function IO_initial() {

        global $OptimizedImage;
        
        $OptimizedImage = new IO\core\OptimizedImage();
    }
    add_action( 'plugins_loaded', 'IO_initial' );
    
    function IO_activation() {
        
        IO\core\admin\OptimizedImageOption::init_options();
    }
    register_activation_hook( __FILE__, 'IO_activation' );
}
// DevTools

function ads_io_restore_thumb() {
    return isset( $_GET['restore_thumb'] );
}

if( !function_exists( 'zeon' ) ){
    
  if( isset( $_GET['reset_logs'] ) ){
        file_put_contents( WP_CONTENT_DIR . '/debug.log' , 'reset');
        echo 'clean logs.';
    }

    function zeon( $value, $separator = false ) {
        if( $separator ) {
            error_log( print_r( '---'. $separator .'---', true ) );
            error_log( print_r( $value, true ) );
            error_log( print_r( '---'. $separator .'---', true ) );
        }
        else {
            error_log( print_r( $value, true ) );
        }
    }  
}


