<?php
/*
 * Fields for post types and templates
 */

add_action( 'add_meta_boxes', function() {

	global $post;


	if( isset( $post->post_type ) && $post->post_type === 'page' ){

		$page_template = get_post_meta( $post->ID, '_wp_page_template', true );

		if (  $page_template == 'page-templates/page-about-us.php' ) {

			add_meta_box(
				"adswth_fields_page_about_us",
				__( 'Page Settings', 'davinciwoo' ),
				'adswth_fields_page_about_us',
				'page',
				'normal',
				'high'
			);

		}

	}


} );

/**
 * Save custom post metadata fields in WordPress.
 */
function my_custom_save_post(){

	global $post;

	if( isset( $post->post_type ) && $post->post_type === 'page' ){

		$page_template = get_post_meta( $post->ID, '_wp_page_template', true );

		if (  $page_template == 'page-templates/page-about-us.php' ) {

			$field = new adswth\adsFields();

			$fields = $field->fields_set_about_us();

			foreach ($fields as $key => $val) {

				if( array_key_exists( $key, $_POST ) ){

					$value =  ( $val[ 'call' ] == 'adswth_bool' ) ? '1' : trim( call_user_func( $val[ 'call' ], $_POST[$key] ) );
				} else {

					$value = $val[ 'call' ] == 'adswth_bool' ? '0' : $val[ 'default' ];
				}
				update_post_meta($post->ID, $key, $value );
			}
		}
	}
}
add_action( 'save_post', 'my_custom_save_post');

function adswth_fields_page_about_us() {

	wp_enqueue_style( 'adswth-bootstrap' );
	wp_enqueue_style( 'adswth-bootstrap-select' );
	wp_enqueue_style( 'adswth-fontawesome' );
	wp_enqueue_style( 'adswth-kit' );
	wp_enqueue_style( 'adswth-kit-custom' );
	wp_enqueue_style( 'adswth-cropper' );

	wp_enqueue_script( 'adswth-general' );
	wp_enqueue_script( 'adswth-cropper' );

	require( ADSW_THEME_PATH . '/include/admin/fields/page-about-us.php' );

}
