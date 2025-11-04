<?php
/**
 *	Plugin Name: AliDropship Social Tools
 *	Plugin URI: https://alidropship.com/
 *	Description: Widgets: Social Icons, Facebook Likebox, Instagram Feed
 *	Version: 1.1.1
 *	Text Domain: adswst
 *	Requires at least: WP 5.4.1
 *	Author: Denis Zharov
 *	Author URI: https://yellowduck.me/
 *	License: MIT
 *  License URI:  http://www.opensource.org/licenses/mit-license.php
 */

if ( ! defined( 'ADSWST_VERSION' ) ) define( 'ADSWST_VERSION', '1.1.1' );
if ( ! defined( 'ADSWST_PATH' ) )    define( 'ADSWST_PATH', plugin_dir_path( __FILE__ ) );
if ( ! defined( 'ADSWST_URL' ) )     define( 'ADSWST_URL', str_replace( [ 'https:', 'http:' ], '', plugins_url( 'alids-social-tools' ) ) );

/**
 * Localization
 */
function adswst_lang_init() {

	load_plugin_textdomain( 'adswst' );
}
add_action( 'init', 'adswst_lang_init' );

if( is_admin() ) :

	require( ADSWST_PATH . 'core/setup.php');
	require( ADSWST_PATH . 'core/update.php');

	register_activation_hook( __FILE__, 'adswst_install' );
	register_activation_hook( __FILE__, 'adswst_activate' );
	register_uninstall_hook( __FILE__, 'adswst_uninstall' );

endif;

require( ADSWST_PATH . 'core/core.php');
require( ADSWST_PATH . 'core/init.php');
