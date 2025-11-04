<?php
\adswth\adsOptions::add_section( 'header_account', [
	'title'       => __( 'Account', 'davinciwoo' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'davinciwoo' ),
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'checkbox',
    'settings'    => 'header_account_show',
    'label'       => __( 'Enable "Login"', 'davinciwoo' ),
    'section'     => 'header_account',
    'default'     => adswth_defaults('header_account_show'),
    'priority'    => 10,
    'transport' => 'auto',
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'checkbox',
	'settings'    => 'header_account_register',
	'label'       => __( 'Show "Register" label', 'davinciwoo' ),
	'section'     => 'header_account',
    'priority'    => 20,
    'required'    => [
        [
            'setting'  => 'header_account_show',
            'operator' => '==',
            'value'    => '1',
        ],
    ],
	'transport' => $transport,
] );

function adswth_refresh_header_top_account( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	// Account
	$wp_customize->selective_refresh->add_partial( 'header-account', [
		'selector' => '.header-account-wrap',
		'container_inclusive' => true,
		'settings' => [ 'header_account_register' ],
		'render_callback' => function() {
			return get_template_part( 'template-parts/header/partials/element-top', 'account' );
		},
	] );
}
add_action( 'customize_register', 'adswth_refresh_header_top_account' );