<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * MAIN REQUEST
 */
function adswth_ajax_action_request() {

	$obj      = new \adswth\adsHandlers();
	$response = $obj->actions( $_POST );

	echo json_encode( $response );
	die();
}
add_action('wp_ajax_adswth_action_request', 'adswth_ajax_action_request');

/**
 * @throws Exception
 */
function adswth_actions() {

	$obj = adswth\adsActions::create( $_POST['adswth_controller'] );

	$response = $obj->actions( $_POST );

	echo json_encode( $response );

	die();
}
add_action('wp_ajax_adswth_actions', 'adswth_actions');