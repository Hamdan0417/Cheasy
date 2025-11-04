<?php
\adswth\adsOptions::add_section( 'page_front_promotion', [
	'title'    => esc_attr__( 'Promotion', 'davinciwoo' ),
	'panel'    => 'page_front',
	'priority' => 50,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'text',
	'settings'    => 'front_page_sidebar_title',
	'label'       => __( 'Front Page Sidebar Title', 'davinciwoo' ),
	'section'     => 'page_front_promotion',
	'default'     => adswth_defaults( 'front_page_sidebar_title' ),
	'priority'    => 10,
	'transport'   => 'postMessage',
] );

function adswth_refresh_page_front_promotion( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'page_front_promotion', [
		'selector' => '#front-page-sidebar .sidebar-title', // You can also select a css class
		'settings' => [
			'front_page_sidebar_title'
		]
	] );
}
add_action( 'customize_register', 'adswth_refresh_page_front_promotion' );
