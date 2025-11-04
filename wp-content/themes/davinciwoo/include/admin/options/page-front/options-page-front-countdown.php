<?php
\adswth\adsOptions::add_section( 'page_front_countdown', [
	'title'    => esc_attr__( 'Super Sale Banner', 'davinciwoo' ),
	'panel'    => 'page_front',
	'priority' => 20,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'countdown_block_show',
	'section'     => 'page_front_countdown',
	'default'     => adswth_defaults( 'countdown_block_show' ),
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'textarea',
	'settings'    => 'countdown_text',
	'label'       => __( 'Super sale banner text', 'davinciwoo' ),
	'section'     => 'page_front_countdown',
	'default'     => adswth_defaults( 'countdown_text' ),
	'description' => esc_attr__('Customize super sale banner text. Use tag <span> to make text colorized.', 'davinciwoo'),
	'required'    => [
		[
			'setting'  => 'countdown_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 30,
	'transport'   => 'postMessage',
] );
\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'countdown_text_color',
	'label'       => esc_attr__( 'Super sale banner text color', 'davinciwoo' ),
	'section'     => 'page_front_countdown',
	'default'     => adswth_option( 'template_color' ),
	'output' => [
		[
			'element'  => '.countdown .text',
			'property' => 'color',
		],
		[
			'element'  => '#clock .clock .item',
			'property' => 'background',
		],
		[
			'element'  => '#clock .clock .item',
			'property' => 'border-color',
		],
		[
			'element'  => '#clock .clock .item span',
			'property' => 'color',
		],
	],
	'required'    => [
		[
			'setting'  => 'countdown_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 40,
	'transport'   => 'auto',
]);
\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'countdown_text_discount_color',
	'label'       => esc_attr__( 'Super sale banner <span> text color', 'davinciwoo' ),
	'section'     => 'page_front_countdown',
	'default'     => adswth_defaults( 'countdown_text_discount_color' ),
	'output' => [
		[
			'element'  => '.countdown .text span',
			'property' => 'color',
		]
	],
	'required'    => [
		[
			'setting'  => 'countdown_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 50,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'countdown_background_color',
	'label'       => esc_attr__( 'Super sale banner background color', 'davinciwoo' ),
	'section'     => 'page_front_countdown',
	'default'     => adswth_defaults( 'countdown_background_color' ),
	'output' => [
		[
			'element'  => '.countdown-wrap',
			'property' => 'background-color',
		]
	],
	'required'    => [
		[
			'setting'  => 'countdown_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 50,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'countdown_show',
	'section'     => 'page_front_countdown',
	'description' => esc_attr__('Show countdown timer', 'davinciwoo'),
	'default'     => adswth_defaults( 'countdown_show' ),
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'required'    => [
		[
			'setting'  => 'countdown_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 60,
	'transport'   => 'auto',
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'countdown_type',
	'section'     => 'page_front_countdown',
	'description' => esc_attr__('Run Countdown timer automatically or set end date manually', 'davinciwoo'),
	'default'     => adswth_defaults( 'countdown_type' ),
	'choices'     => [
		'on'  => esc_attr__( 'Manual', 'davinciwoo' ),
		'off' => esc_attr__( 'Auto', 'davinciwoo' ),
	],
	'required'    => [
		[
			'setting'  => 'countdown_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'countdown_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 70,
	'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'date',
	'settings'    => 'countdown_date',
	'section'     => 'page_front_countdown',
	'label'       => esc_html__( 'Countdown schedule', 'davinciwoo' ),
	'description' => __( 'Set countdown end date.', 'davinciwoo' ),
	'required'    => [
		[
			'setting'  => 'countdown_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'countdown_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'countdown_type',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'sanitize_callback' => 'adswth_sanitize_clock_time',
	'sanitize_js_callback' => 'adswth_sanitize_clock_time',
	'priority'    => 80,
	'transport'   => 'postMessage',
]);

function adswth_refresh_page_front_countdown( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	// Countdown-view
	$wp_customize->selective_refresh->add_partial( 'page_front_countdown', [
		'selector'            => '.countdown-wrap',
		'container_inclusive' => true,
		'settings'            => [
			'countdown_block_show',
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/page-front/page-front', 'countdown');
		},
	] );
}
add_action( 'customize_register', 'adswth_refresh_page_front_countdown' );

