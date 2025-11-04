<?php
\adswth\adsOptions::add_section( 'page_front_features', [
	'title'    => esc_attr__( 'Features', 'davinciwoo' ),
	'panel'    => 'page_front',
	'priority' => 30,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'features_block_show',
	'section'     => 'page_front_features',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'repeater',
	'settings'    => 'features_list',
	'label'       => esc_attr__( 'Features', 'davinciwoo' ),
	'section'     => 'page_front_features',
	'priority'    => 20,
	'row_label' => [
		'type'  => 'field',
		'value' => esc_attr__( 'Feature', 'davinciwoo' ),
		'field' => 'feature_title',
	],
	'button_label' => esc_attr__('Add feature', 'davinciwoo' ),
	'default'      => adswth_defaults( 'features_list' ),
	'fields' => [
		'feature_image' => [
			'type'        => 'image',
			'label'       => __( 'Icon', 'davinciwoo' ),
			'description' => esc_attr__( 'Recommended: 70*70px, png or svg ', 'davinciwoo' ),
			'default'     => '',
		],
		'feature_title' => [
			'type'        => 'textarea',
			'label'       => esc_attr__( 'Title', 'davinciwoo' ),
			'description' => esc_attr__( 'Use <strong> for bold text', 'davinciwoo' ),
			'default'     => '',
		],
		'feature_text' => [
			'type'        => 'textarea',
			'label'       => esc_attr__( 'Text', 'davinciwoo' ),
			'description' => esc_attr__( 'Use <strong> for bold text', 'davinciwoo' ),
			'default'     => '',
		],
	],
	'required'    => [
		[
			'setting'  => 'features_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'feature_title_color',
	'label'       => esc_attr__( 'Features titles color', 'davinciwoo' ),
	'section'     => 'page_front_features',
	'default'     => adswth_defaults( 'feature_title_color' ),
	'output' => [
		[
			'element'  => '.feature .title',
			'property' => 'color',
		],
	],
	'required'    => [
		[
			'setting'  => 'features_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 30,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'feature_title_bold_color',
	'label'       => esc_attr__( 'Features titles bold color', 'davinciwoo' ),
	'section'     => 'page_front_features',
	'default'     => adswth_defaults( 'feature_title_bold_color' ),
	'output' => [
		[
			'element'  => '.feature .title strong',
			'property' => 'color',
		],
	],
	'required'    => [
		[
			'setting'  => 'features_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 40,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'feature_text_color',
	'label'       => esc_attr__( 'Features text color', 'davinciwoo' ),
	'section'     => 'page_front_features',
	'default'     => adswth_defaults( 'feature_text_color' ),
	'output' => [
		[
			'element'  => '.feature .text',
			'property' => 'color',
		],
	],
	'required'    => [
		[
			'setting'  => 'features_block_show',
			'operator' => '==',
			'value'    => 1,
		]
	],
	'priority'    => 50,
	'transport'   => 'auto',
]);

function adswth_refresh_page_front_features( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'page_front_features', [
		'selector'            => '.features-wrap',
		'container_inclusive' => true,
		'settings'            => [
			'features_block_show',
			'features_list'
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/page-front/page-front', 'features');
		},
	] );
}
add_action( 'customize_register', 'adswth_refresh_page_front_features' );
