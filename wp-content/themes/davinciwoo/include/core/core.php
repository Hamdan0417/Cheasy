<?php
/**
 * DavinciWoo theme core
 * This is where all Theme Functions
 *
 * @author     Denis Zharov
 * @package    davinciwoo
 * @since      0.1.0
 */

if( !function_exists('pr') ){

	function pr($any){
		print_r( "<pre>" );
		print_r( $any );
		print_r( "</pre>" );
	}
}

if( !function_exists('vd') ){

	function vd($any){
		echo ( "<pre>" );
		var_dump( $any );
		echo( "</pre>" );
	}
}

function adswth_bool( $str ) {

	return $str === '1' ? '1': '0';
}

/**
 * Parse any str to float
 *
 * @param $value
 *
 * @return string
 */
function adswth_floatvalue( $value ) {

	$value = html_entity_decode( $value, ENT_QUOTES, "UTF-8" );

	$value = preg_replace('/[^0-9,.]/', '', $value, -1 );

	if( preg_match( '/(\d+\,\d+)+\.\d+/', $value ) ){
		$value = str_replace( ',', '', $value );
	}

	$value = str_replace( ',', '.', $value );

	return number_format( floatval( $value ), 2, '.', '' );
}

/**
 * Remove all simbols [0-9]
 *
 * @param $int
 *
 * @return mixed
 */
function adswth_integer( $int ) {
	return preg_replace( '/\D/', '', $int );
}

function adswth_is_url( $url ) {
	return (bool) preg_match( '|(\/\/)(www\.)?(.)*[\.](.)*$|iu', $url );
}

function adswth_is_external( $url ) {
	return strripos( $url, $_SERVER[ "SERVER_NAME" ] ) === false;
}

function adswth_parse_args( $defaults, $args ) {

	$foo = [];

	foreach( $defaults as $key => $val ){
		$foo[ $key ] = isset( $args[ $key ] ) && $args[ $key ] ? $args[ $key ] : $val;
	}

	return $foo;
}

/**
 * Get ids product which was viewed
 *
 * @return bool|array
 */
function adswth_recently_viewed_ids() {

	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : []; // @codingStandardsIgnoreLine
	$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

	if ( is_singular( 'product' ) ) {

		global $post;

		$key = array_search( $post->ID, $viewed_products );

		if ( $key !== false ) {
			unset( $viewed_products[ $key ] );
		}
	}

	return array_slice( $viewed_products, 0, 4);
}

function adswth_get_field( $name, $field_set, $post_id = false, $type = 'post' ){

	if ( ! $post_id ){

		global $post;
		$post_id = $post->ID;
	}

	$field = new adswth\adsFields();

	return $field->get_field( $name, $field_set, $post_id, $type );
}

function adswth_the_field( $name, $field_set, $post_id = false, $type = 'post' ){

	echo adswth_get_field( $name, $field_set, $post_id, $type );
}

