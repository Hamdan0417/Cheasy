<?php
/**
 * ElgrecoWoo functions and definitions
 *
 * @package elgrecowoo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'ADSW_THEME_VERSION' ) ) define( 'ADSW_THEME_VERSION', wp_get_theme('elgrecowoo')->get( 'Version' ) );
if ( ! defined( 'ADSW_THEME_PATH' ) )    define( 'ADSW_THEME_PATH', get_template_directory() );
if ( ! defined( 'ADSW_THEME_URL' ) )     define( 'ADSW_THEME_URL', get_template_directory_uri() );
if ( ! defined( 'ADSW_THEME_MIN' ) )     define( 'ADSW_THEME_MIN', '.min' ); // Production ADD .min
if ( ! defined( 'ADSW_THEME_CODE' ) )    define( 'ADSW_THEME_CODE', adsth_getioncode() );
if ( ! defined( 'ADSW_THEME_ERROR' ) )   define( 'ADSW_THEME_ERROR', adsth_check_server() );

add_action('init', function () {
    load_theme_textdomain('elgrecowoo');
});

function adsth_getioncode()
{
    if (version_compare('8.0', PHP_VERSION, '<')) {
        return 'ion81';
    }
    if (version_compare('7.1', PHP_VERSION, '<')) {
        return 'ion72';
    }
    return 'ion71';

}

function adsth_check_server() {
    
    if( version_compare( '7.1', PHP_VERSION, '>' ) )
        return sprintf(
            'PHP Version is not suitable. You need version 7.1+. %s',
            '<a href="https://alidropship.com/codex/6-install-ioncube-loader-hosting/" target="_blank">Learn more</a>.'
        );
    
    $ion_args = [ 'ion71' => '7.1', 'ion72' => '7.2', 'ion81' => '8.1' ];
    $ver      = explode( '.', PHP_VERSION );
    $version  = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION . '.' . PHP_RELEASE_VERSION;
    $ion_pref = 'ion' . $ver[ 0 ] . $ver[ 1 ];
    
    if( $ion_pref != ADSW_THEME_CODE && $ver[ 0 ] . $ver[ 1 ] < 73 )
        return sprintf(
            'You installed El Greco theme for PHP %1$s, but your version of PHP is %2$s.' . ' ' .
            'Please install El Greco theme for PHP %2$s.',
            isset( $ion_args[ ADSW_THEME_CODE ] ) ? $ion_args[ ADSW_THEME_CODE ] : 'Unknown',
            $version
        );
    
    $extensions = get_loaded_extensions();
    
    $key = 'ionCube Loader';
    
    if ( ! in_array( $key, $extensions ) )
        return sprintf(
            '%s Loader not found. El Greco theme can\'t be activated. %s', $key,
            '<a href="https://alidropship.com/codex/6-install-ioncube-loader-hosting/" target="_blank">
            Please check instructions
        </a>.'
        );
    
    return false;
}

function adsth_admin_notice__error() {
    
    if( ADSW_THEME_ERROR ) {
        
        $class = 'notice notice-error';
        $message = __( 'AliDropship plugin alert: Error!', 'ads' ) . ' ' . ADSW_THEME_ERROR;
        
        printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
    }
}
add_action( 'admin_notices', 'adsth_admin_notice__error' );

if( ! ADSW_THEME_ERROR ) {
    require ADSW_THEME_PATH . '/include/core/core.php';
    require ADSW_THEME_PATH . '/include/init.php';
    if ( ! defined( 'ADSW_THEME_LAZY_LOAD' ) )   define( 'ADSW_THEME_LAZY_LOAD', adswth_option( 'performance_enable_lazyload' ) );
}
/**
 * Note: It's not recommended to add any custom code here. Please use a child theme so that your customizations aren't lost during updates.
 * Learn more here: http://codex.wordpress.org/Child_Themes
 */