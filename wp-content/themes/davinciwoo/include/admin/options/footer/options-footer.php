<?php
/**
 * Footer panel.
 */

\adswth\adsOptions::add_section( 'footer', [
	'title'    => __( 'Footer', 'davinciwoo' ),
    'priority' => 60,
] );

\adswth\adsOptions::add_field( '', [
	'type'            => 'custom',
	'settings'        => 'custom_html_footer_widgets',
	'label'           => '',
	'section'         => 'footer',
	'default'         => '<div class="options-title-divider" style="margin-bottom:15px">' . __( 'Widgets', 'davinciwoo' ) . '</div><p>' . __( 'Click the button to go to Widgets', 'davinciwoo' ) . '</p><div><button style="margin-bottom:15px" class="button button-primary" data-to-panel="widgets">' . __( 'Edit Widgets', 'davinciwoo' ) . '</button></div>',
	'priority'        => 10,
] );

\adswth\adsOptions::add_field( '', [
	'type'            => 'custom',
	'settings'        => 'footer_1_custom_title',
	'label'           => '',
	'section'         => 'footer',
	'default'         => '<div class="options-title-divider">' . __( 'Footer 1', 'davinciwoo' ) . '</div>',
	'priority'        => 20,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'footer_1_show',
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_1_show' ),
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'priority'    => 30,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'            => 'radio-buttonset',
	'settings'        => 'footer_1_columns',
	'label'           => __( 'Columns', 'davinciwoo' ),
	'section'         => 'footer',
	'default'         => adswth_defaults( 'footer_1_columns' ),
	'choices'         => [
		'6' => __( '6', 'davinciwoo' ),
		'5' => __( '5', 'davinciwoo' ),
		'4' => __( '4', 'davinciwoo' ),
		'3' => __( '3', 'davinciwoo' ),
		'2' => __( '2', 'davinciwoo' ),
		'1' => __( '1', 'davinciwoo' ),
	],
	'priority'    => 40,
	'transport'       => $transport,

] );
\adswth\adsOptions::add_field( '', [
	'type'            => 'custom',
	'settings'        => 'footer_2_custom_title',
	'label'           => '',
	'section'         => 'footer',
	'default'         => '<div class="options-title-divider">' . __( 'Footer 2', 'davinciwoo' ) . '</div>',
	'priority'        => 50,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'footer_2_show',
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_2_show' ),
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'priority'    => 60,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'            => 'radio-buttonset',
	'settings'        => 'footer_2_columns',
	'label'           => __( 'Columns', 'davinciwoo' ),
	'section'         => 'footer',
	'default'         => adswth_defaults( 'footer_2_columns' ),
	'choices'         => [
		'6' => __( '6', 'davinciwoo' ),
		'5' => __( '5', 'davinciwoo' ),
		'4' => __( '4', 'davinciwoo' ),
		'3' => __( '3', 'davinciwoo' ),
		'2' => __( '2', 'davinciwoo' ),
		'1' => __( '1', 'davinciwoo' ),
	],
	'priority'        => 70,
	'transport'       => $transport,

] );

\adswth\adsOptions::add_field( '', [
	'type'            => 'custom',
	'settings'        => 'footer_style_title',
	'label'           => '',
	'section'         => 'footer',
	'default'         => '<div class="options-title-divider">' . __( 'Footer Style', 'davinciwoo' ) . '</div>',
	'priority'        => 80,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'footer_background_color',
	'label'       => esc_attr__( 'Background color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_background_color' ),
	'output' => [
		[
			'element'  => '.footer-wrapper',
			'property' => 'background-color',
		],
	],
	'priority'    => 90,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'footer_divider_color',
	'label'       => esc_attr__( 'Divider color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_divider_color' ),
	'output' => [
		[
			'element'  => '.footer-wrapper .divider',
			'property' => 'background-color',
		],
	],
	'priority'    => 100,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'footer_widget_title_color',
	'label'       => esc_attr__( 'Widget title color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_widget_title_color' ),
	'output' => [
		[
			'element'  => '.footer-widgets .widget-title',
			'property' => 'color',
		],
	],
	'priority'    => 110,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'footer_widget_text_color',
	'label'       => esc_attr__( 'Widget text color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_widget_text_color' ),
	'output' => [
		[
			'element'  => '.footer-widgets',
			'property' => 'color',
		],
	],
	'priority'    => 120,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'footer_widget_link_color',
	'label'       => esc_attr__( 'Widget link color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_widget_link_color' ),
	'output' => [
		[
			'element'  => '.footer-widgets .widget a',
			'property' => 'color',
		],
	],
	'priority'    => 130,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'footer_widget_link_hover_color',
	'label'       => esc_attr__( 'Widget link hover color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_widget_link_hover_color' ),
	'output' => [
		[
			'element'  => '.footer-widgets .widget a:hover, .footer-widgets .widget a:active, .footer-widgets .widget a:focus',
			'property' => 'color',
		],
	],
	'priority'    => 140,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'            => 'custom',
	'settings'        => 'footer_absolute_section_title',
	'label'           => '',
	'section'         => 'footer',
	'default'         => '<div class="options-title-divider">' . __( 'Copyright Notice', 'davinciwoo' ) . '</div>',
	'priority'        => 150,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'footer_absolute_show',
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_absolute_show' ),
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'priority'    => 160,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'textarea',
	'settings'    => 'footer_absolute_text_primary',
	'label'       => __( 'Bottom Text - Primary', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_absolute_text_primary' ),
	'description' => esc_attr__('Add Any Text here...', 'davinciwoo'),
	'required'    => [
		[
			'setting'  => 'footer_absolute_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 170,
	'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'footer_absolute_text_primary_color',
	'label'       => esc_attr__( 'Primary text color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_absolute_text_primary_color' ),
	'output' => [
		[
			'element'  => '.footer-absolute-primary',
			'property' => 'color',
		],
	],
	'required'    => [
		[
			'setting'  => 'footer_absolute_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 180,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'textarea',
	'settings'    => 'footer_absolute_text_secondary',
	'label'       => __( 'Bottom Text - Secondary', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_absolute_text_secondary' ),
	'description' => esc_attr__('Add Any Text here...', 'davinciwoo'),
	'required'    => [
		[
			'setting'  => 'footer_absolute_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 190,
	'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'footer_absolute_text_secondary_color',
	'label'       => esc_attr__( 'Secondary text color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_absolute_text_secondary_color' ),
	'output' => [
		[
			'element'  => '.footer-absolute-secondary',
			'property' => 'color',
		],
	],
	'required'    => [
		[
			'setting'  => 'footer_absolute_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 200,
	'transport'   => 'auto',
]);


\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'footer_absolute_background_color',
	'label'       => esc_attr__( 'Background color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'footer_absolute_background_color' ),
	'output' => [
		[
			'element'  => '.footer-absolute',
			'property' => 'background-color',
		],
	],
	'required'    => [
		[
			'setting'  => 'footer_absolute_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 210,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'            => 'custom',
	'settings'        => 'back_to_top_title',
	'label'           => '',
	'section'         => 'footer',
	'default'         => '<div class="options-title-divider">' . __( 'Back To Top Button', 'davinciwoo' ) . '</div>',
	'priority'        => 220,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'back_to_top_show',
	'section'     => 'footer',
	'default'     => adswth_defaults( 'back_to_top_show' ),
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'priority'    => 230,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'            => 'radio-buttonset',
	'settings'        => 'back_to_top_position',
	'label'           => __( 'Position', 'davinciwoo' ),
	'section'         => 'footer',
	'default'         => adswth_defaults( 'back_to_top_position' ),
	'choices'         => [
		'left'  => __( 'Left', 'davinciwoo' ),
		'right' => __( 'Right', 'davinciwoo' ),
	],
	'required'    => [
		[
			'setting'  => 'back_to_top_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'        => 240,
	'transport'       => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'back_to_top_icon_color',
	'label'       => esc_attr__( 'Icon color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_option( 'back_to_top_icon_color' ),
	'output' => [
		[
			'element'  => '.back-to-top',
			'property' => 'color',
		],
	],
	'required'    => [
		[
			'setting'  => 'back_to_top_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 250,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'back_to_top_icon_hover_color',
	'label'       => esc_attr__( 'Icon hover color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'back_to_top_icon_hover_color' ),
	'output' => [
		[
			'element'  => '.back-to-top:hover',
			'property' => 'color',
		],
	],
	'required'    => [
		[
			'setting'  => 'back_to_top_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 260,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'back_to_top_background_color',
	'label'       => esc_attr__( 'Background color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'back_to_top_background_color' ),
	'output' => [
		[
			'element'  => '.back-to-top',
			'property' => 'background-color',
		],
	],
	'required'    => [
		[
			'setting'  => 'back_to_top_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 270,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'back_to_top_background_hover_color',
	'label'       => esc_attr__( 'Background hover color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_option( 'back_to_top_background_hover_color' ),
	'output' => [
		[
			'element'  => '.back-to-top:hover',
			'property' => 'background-color',
		],
	],
	'required'    => [
		[
			'setting'  => 'back_to_top_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 280,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'back_to_top_border_color',
	'label'       => esc_attr__( 'Border color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_option( 'back_to_top_border_color' ),
	'output' => [
		[
			'element'  => '.back-to-top',
			'property' => 'border-color',
		],
	],
	'required'    => [
		[
			'setting'  => 'back_to_top_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 290,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'back_to_top_border_hover_color',
	'label'       => esc_attr__( 'Border hover color', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_option( 'back_to_top_border_hover_color' ),
	'output' => [
		[
			'element'  => '.back-to-top:hover',
			'property' => 'border-color',
		],
	],
	'required'    => [
		[
			'setting'  => 'back_to_top_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 300,
	'transport'   => 'auto',
]);
\adswth\adsOptions::add_field( 'option', [
	'type'        => 'slider',
	'settings'    => 'back_to_top_border_radius',
	'label'       => esc_attr__( 'Border radius', 'davinciwoo' ),
	'section'     => 'footer',
	'default'     => adswth_defaults( 'back_to_top_border_radius' ),
	'choices'     => [
		'min'  => '0',
		'max'  => '25',
		'step' => '1',
	],
	'output' => [
		[
			'element'  => '.back-to-top',
			'property' => 'border-radius',
			'units'    => 'px'
		],
	],
	'required'    => [
		[
			'setting'  => 'back_to_top_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 310,
	'transport'   => 'auto',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'            => 'checkbox',
	'settings'        => 'back_to_top_mobile',
	'label'           => __( 'Show on Mobile', 'davinciwoo' ),
	'section'         => 'footer',
	'default'         => adswth_defaults( 'back_to_top_mobile' ),
	'priority'        => 320,
	'transport'       => $transport,
]);

function adswth_refresh_footer( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	// Footer-widgets-area
	$wp_customize->selective_refresh->add_partial( 'footer', [
		'selector'            => '#footer',
		'container_inclusive' => false,
		'settings'            => [
			'footer_1_show',
			'footer_1_columns',
			'footer_2_show',
			'footer_2_columns'
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/footer/footer');
		},
	] );

	// Footer-absolute
	$wp_customize->selective_refresh->add_partial( 'footer-absolute', [
		'selector'            => '#footer-absolute',
		'container_inclusive' => true,
		'settings'            => [
			'footer_absolute_show'
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/footer/footer-absolute');
		},
	] );

	// back to top Button
	$wp_customize->selective_refresh->add_partial( 'back-to-top', [
		'selector'            => '#back-to-top',
		'container_inclusive' => true,
		'settings'            => [
			'back_to_top_show',
			'back_to_top_position',
			'back_to_top_mobile'
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/footer/back-to-top');
		},
	] );

}
add_action( 'customize_register', 'adswth_refresh_footer' );