<?php
/**
 * DavinciWoo functions and definitions
 *
 * @package davinciwoo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !defined('ADSW_THEME_VERSION') ) define( 'ADSW_THEME_VERSION', wp_get_theme('davinciwoo')->get( 'Version' ) );
if ( !defined('ADSW_THEME_PATH') ) define( 'ADSW_THEME_PATH', get_template_directory() );
if ( !defined('ADSW_THEME_URL') ) define( 'ADSW_THEME_URL', get_template_directory_uri() );
if ( !defined('ADSW_THEME_MIN') ) define( 'ADSW_THEME_MIN', '.min' ); // Production ADD .MIN

$ver      = explode( '.', PHP_VERSION );
$version = $ver[ 0 ] . $ver[ 1 ];
if($version < 72){
    $ion_pref = 'ion71';
} else {
    $ion_pref = 'ion72';
}
if ( ! defined( 'ADSW_IONPREF' ) ) define( 'ADSW_IONPREF', $ion_pref);

add_action( 'init', function() {
	load_theme_textdomain( 'davinciwoo' );
} );

require ADSW_THEME_PATH . '/include/core/core.php';
require ADSW_THEME_PATH . '/include/init.php';

/**
 * Note: It's not recommended to add any custom code here. Please use a child theme so that your customizations aren't lost during updates.
 * Learn more here: http://codex.wordpress.org/Child_Themes
 */