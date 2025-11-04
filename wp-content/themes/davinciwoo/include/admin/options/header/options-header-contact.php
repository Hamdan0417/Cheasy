<?php
\adswth\adsOptions::add_section( 'header_contact', [
	'title'       => __( 'Call to action', 'davinciwoo' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'davinciwoo' ),
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'textarea',
	'settings'    => 'header_call_to_action',
	'label'       => __( 'Сustom text', 'davinciwoo' ),
	'section'     => 'header_contact',
	'default'     => adswth_defaults( 'header_call_to_action' ),
	'priority'    => 10,
	'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'textarea',
	'settings'    => 'header_phone',
	'label'       => __( 'Phone number', 'davinciwoo' ),
	'section'     => 'header_contact',
	'default'     => adswth_defaults( 'header_phone' ),
	'priority'    => 20,
	'transport'   => 'postMessage',
] );

function adswth_refresh_header_contact( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	// Header contact
	$wp_customize->selective_refresh->add_partial( 'header-contact', [
		'selector' => '.header-contact',
		'container_inclusive' => true,
		'settings' => [ 'header_call_to_action', 'header_phone' ],
	] );

}
add_action( 'customize_register', 'adswth_refresh_header_contact' );

