<?php
/**
 * User: Denis Zharov
 * Date: 17.09.2018
 * Time: 14:20
 */

if ( ! function_exists( 'adswth_kirki_update_url' ) ) {
	function adswth_kirki_update_url( $config ) {
		$config['url_path'] = ADSW_THEME_URL . '/include/admin/kirki/';
		return $config;
	}
}
add_filter( 'kirki/config', 'adswth_kirki_update_url' );

/**
 * Configuration for the Kirki Customizer
 */
\adswth\adsOptions::add_config( 'option', [
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
	'disable_output' => false
] );
