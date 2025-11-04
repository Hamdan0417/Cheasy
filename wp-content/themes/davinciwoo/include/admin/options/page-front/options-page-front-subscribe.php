<?php
\adswth\adsOptions::add_section( 'page_front_subscribe', [
	'title'    => esc_attr__( 'Subscribe Form', 'davinciwoo' ),
	'panel'    => 'page_front',
	'description' => __( 'Subscription form settings for collecting users’ emails', 'davinciwoo' ),
	'priority' => 60,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'subscribe_block_show',
	'section'     => 'page_front_subscribe',
	'default'     => adswth_defaults( 'subscribe_block_show' ),
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'code',
	'settings'    => 'subscribe_code',
	'label'       => esc_attr__( 'Subscribe Form Code', 'textdomain' ),
	'description' => esc_attr__( 'Paste your ‘Autoresponder’ code here.', 'textdomain' ),
	'section'     => 'page_front_subscribe',
	'default'     => adswth_defaults( 'subscribe_code' ),
	'choices'     => [
		'language' => 'html',
	],
	'required'    => [
		[
			'setting'  => 'subscribe_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 20,
	'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'subscribe_background_color',
	'label'       => esc_attr__( 'Background color', 'davinciwoo' ),
	'section'     => 'page_front_subscribe',
	'default'     => adswth_defaults( 'subscribe_background_color' ),
	'output' => [
		[
			'element'  => '#subscribe-form-block',
			'property' => 'background-color',
		]
	],
	'required'    => [
		[
			'setting'  => 'subscribe_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 30,
	'transport'   => 'auto',
]);

function adswth_refresh_page_front_subscribe( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	// Countdown-view
	$wp_customize->selective_refresh->add_partial( 'page_front_subscribe', [
		'selector'            => '#subscribe-form-block',
		'container_inclusive' => true,
		'settings'            => [
			'subscribe_block_show',
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/page-front/page-front', 'subscribe');
		},
	] );
}
add_action( 'customize_register', 'adswth_refresh_page_front_subscribe' );