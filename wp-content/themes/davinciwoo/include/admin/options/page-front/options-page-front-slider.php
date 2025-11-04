<?php
\adswth\adsOptions::add_section( 'page_front_slider', [
	'title'    => esc_attr__( 'Slider', 'davinciwoo' ),
	'panel'    => 'page_front',
	'priority' => 10,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_slider_menu',
	'section'  => 'page_front_slider',
	'priority' => 5,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Slider Menu', 'davinciwoo' ) . '</div>',
] );
\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'slider_menu_show',
	//'label'       => esc_attr__( 'Header tip show', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'transport'   => $transport,
] );
\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_slider',
	'section'  => 'page_front_slider',
	'priority'    => 20,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Slider', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'select',
	'settings'    => 'slider_layout',
	'label'       => esc_attr__( 'Layout', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => '0',
	'priority'    => 30,
	'choices'     => [
		'1' => __( 'Slider Only', 'davinciwoo' ),
		'2' => __( 'Slider + 1 banner', 'davinciwoo' ),
		'3' => __( 'Slider + 2 banners', 'davinciwoo' ),
	],
	'transport'   => 'auto',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'repeater',
	'settings'     => 'main_banner',
	'label'       => esc_html__( 'Slides', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'priority'    => 40,
	'row_label' => [
		'type'  => 'text',
		'value' => esc_html__('Slide ', 'davinciwoo' ),
	],
	'button_label' => esc_html__( 'Add new slide', 'davinciwoo' ),
	'default'      => adswth_defaults( 'main_banner' ),
	'fields'       => [
		'slide_image' => [
			'type'        => 'image',
			'label'       => esc_html__( 'Image', 'davinciwoo' ),
			'description' => esc_attr__( 'Recommended size: 1050*440px', 'davinciwoo' ),
		],
		'slide_image_xs' => [
			'type'        => 'image',
			'label'       => esc_html__( 'Image for mobile', 'davinciwoo' ),
			'description' => esc_attr__( 'Recommended size: 375*440px', 'davinciwoo' ),
		],
		'slide_view_type' => [
			'type'        => 'radio',
			'label'       => esc_html__( 'Slide view type', 'davinciwoo' ),
			'choices'         => [
				'default'     => esc_html__( 'Default', 'davinciwoo' ),
				'image_only'  => esc_html__( 'Image only', 'davinciwoo' )
			],
			'default' => 'default',
		],
		'slide_url' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Slide URL', 'davinciwoo' ),
			'description' => esc_html__( 'Link slide to a certain page', 'davinciwoo' ),
			'default'     => '',
		],
		'slide_title' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Title', 'davinciwoo' ),
			//'description' => esc_html__( 'This will be the link URL', 'davinciwoo' ),
			'default'     => '',
			'sanitize_callback' => 'wp_kses_post',
		],
		'slide_title_color' => [
			'type'        => 'color',
			'label'       => esc_html__( 'Title color', 'davinciwoo' ),
			//'description' => esc_html__( 'This will be the link URL', 'davinciwoo' ),
			'default'     => '#FFFFFF',
		],
        'slide_title_font_size' => [
			'type'        => 'number',
			'label'       => esc_html__( 'Title font size', 'davinciwoo' ),
			'default'     => '22',
            'choices'     => [
                'min'  => 10,
                'max'  => 50,
                'step' => 1,
            ],
		],
		'slide_text' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Subtitle', 'davinciwoo' ),
			//'description' => esc_html__( 'This will be the link URL', 'davinciwoo' ),
			'default'     => '',
			'sanitize_callback' => 'wp_kses_post',
		],
		'slide_text_color' => [
			'type'        => 'color',
			'label'       => esc_html__( 'Subtitle color', 'davinciwoo' ),
			//'description' => esc_html__( 'This will be the link URL', 'davinciwoo' ),
			'default'     => '#FFFFFF',
		],
        'slide_text_font_size' => [
            'type'        => 'number',
            'label'       => esc_html__( 'Subtitle font size', 'davinciwoo' ),
            'default'     => '14',
            'choices'     => [
                'min'  => 10,
                'max'  => 50,
                'step' => 1,
            ],
        ],
		'main_button_text' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Main Button Text', 'davinciwoo' ),
			//'description' => esc_html__( 'This will be the label for your link', 'davinciwoo' ),
			'default'     => '',
		],
		'main_button_url'  => [
			'type'        => 'text',
			'label'       => esc_html__( 'Main Button URL', 'davinciwoo' ),
			//'description' => esc_html__( 'This will be the link URL', 'davinciwoo' ),
			'default'     => '',
		],
		'additional_button_type' => [
			'type'        => 'radio',
			'label'       => esc_html__( 'Additional Button Type', 'davinciwoo' ),
			'choices'         => [
				'none'  => esc_html__( 'None', 'davinciwoo' ),
				'text'  => esc_html__( 'Text', 'davinciwoo' ),
				'video' => esc_html__( 'Video', 'davinciwoo' ),
			],
			'default' => 'none',
		],
		'additional_button_text' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Additional Button Text', 'davinciwoo' ),
			//'description' => esc_html__( 'This will be the label for your link', 'davinciwoo' ),
			'default'     => '',
		],
		'additional_button_url'  => [
			'type'        => 'text',
			'label'       => esc_html__( 'Additional Button URL', 'davinciwoo' ),
			//'description' => esc_html__( 'This will be the link URL', 'davinciwoo' ),
			'default'     => '',
		],
		'slide_overlay_color' => [
			'type'        => 'color',
			'label'       => esc_html__( 'Slide text overlay color', 'davinciwoo' ),
			//'description' => esc_html__( 'This will be the link URL', 'davinciwoo' ),
			'default'     => 'rgba(0, 0, 0, 0.6)',
			'choices'     => [
				'alpha' => true,
			],
		],

	]
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'checkbox',
	'settings'    => 'main_banner_autoplay',
	'label'       => esc_html__( 'Autoplay', 'davinciwoo' ),
	'description' => esc_html__( 'Enable checkbox to use autoplay', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'main_banner_autoplay' ),
	'priority'    => 40,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'number',
	'settings'    => 'main_banner_autoplay_slide_delay',
	'label'       => esc_html__( 'Slide delay', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'main_banner_autoplay_slide_delay' ),
	'priority'    => 50,
	'choices'     => [
		'min'  => 1,
		'step' => 0.5,
	],
	'required'    => [
		[
			'setting'  => 'main_banner_autoplay',
			'operator' => '==',
			'value'    => 1,
		],
	],
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'main_banner_btn_primary_color',
	'label'       => esc_attr__( 'Main button color', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_option( 'btn_primary_color' ),
	'output' => [
		[
			'element'  => [
				'.main-slider .btn-primary',
			],
			'property' => 'background-color'
		],
		[
			'element'  => [
				'.main-slider .btn-primary',
			],
			'property' => 'border-color',
		],
	],
	'priority'    => 60,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'main_banner_btn_primary_color_hover',
	'label'       => esc_attr__( 'Main button hover color', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_option( 'btn_primary_color_hover' ),
	'output' => [
		[
			'element'  => [
				'.main-slider .btn-primary:hover, .main-slider .btn-primary:focus, .main-slider .btn-primary:active',
				'.main-slider .btn-primary:not(:disabled):not(.disabled):active:focus',
				'.main-slider .btn-primary:not(:disabled):not(.disabled).active:focus',
				'.main-slider .btn-primary.disabled',
				'.main-slider .btn-primary:disabled'
			],
			'property' => 'background-color',
		],[
			'element'  => [
				'.main-slider .btn-primary:hover, .main-slider .btn-primary:focus, .main-slider .btn-primary:active',
				'.main-slider .btn-primary:not(:disabled):not(.disabled):active:focus',
				'.main-slider .btn-primary:not(:disabled):not(.disabled).active:focus',
				'.main-slider .btn-primary.disabled',
				'.main-slider .btn-primary:disabled'
			],
			'property' => 'border-color',
		],

	],
	'priority'    => 70,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'main_banner_btn_primary_text_color',
	'label'       => esc_attr__( 'Main button text color', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_option( 'btn_primary_text_color' ),
	'output' => [
		[
			'element'  => [
				'.main-slider .btn-primary',
			],
			'property' => 'color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 80,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'main_banner_btn_primary_text_color_hover',
	'label'       => esc_attr__( 'Main button text hover color', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_option( 'btn_primary_text_color_hover' ),
	'output' => [
		[
			'element'  => [
				'.main-slider .btn-primary:hover, .main-slider .btn-primary:focus, .main-slider .btn-primary:active',
				'.main-slider .btn-primary:not(:disabled):not(.disabled):active:focus',
				'.main-slider .btn-primary:not(:disabled):not(.disabled).active:focus',
				'.main-slider .btn-primary.disabled',
				'.main-slider .btn-primary:disabled'
			],
			'property' => 'color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 90,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_slider_additional_banners',
	'section'  => 'page_front_slider',
	'priority' => 100,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Additional banners', 'davinciwoo' ) . '</div>',
	'required' => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 2,
		],
	],
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'image',
	'settings'    => 'additional_banner_1_image',
	'label'       => __( 'Banner 1 image', 'davinciwoo' ),
	//'description' => esc_attr__( 'Recommended size: 1050*480px', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'additional_banner_1_image' ),
	'priority'    => 110,
	'transport'   => $transport,
	'required'    => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 2,
		],
	],
] );
\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'textarea',
	'settings'    => 'additional_banner_1_text',
	'label'       => __( 'Banner 1 text', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'additional_banner_1_text' ),
	'priority'    => 120,
	'required'    => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 2,
		],
	],
	'transport' => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'additional_banner_1_text_color',
	'label'       => esc_attr__( 'Banner 1 text color', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'additional_banner_1_text_color' ),
	'output' => [
		[
			'element'  => [
				'#additional-banner-1 .main-banner-text'
			],
			'property' => 'color',
		],

	],
	'required'    => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 2,
		],
	],
	'priority'    => 130,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'link',
	'settings'    => 'additional_banner_1_link',
	'label'       => __( 'Banner 1 Link', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'additional_banner_1_link' ),
	'priority'    => 140,
	'required'    => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 2,
		],
	],
	'transport' => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'additional_banner_1_overlay_color',
	'label'       => esc_attr__( 'Banner 1 overlay color', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'additional_banner_1_overlay_color' ),
	'output' => [
		[
			'element'  => [
				'#additional-banner-1 .main-banner-text'
			],
			'property' => 'background-color',
		],

	],
	'choices'     => [
		'alpha' => true,
	],
	'required'    => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 2,
		],
	],
	'priority'    => 150,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'image',
	'settings'    => 'additional_banner_2_image',
	'label'       => __( 'Banner 2 image', 'davinciwoo' ),
	//'description' => esc_attr__( 'Recommended size: 1050*480px', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'additional_banner_2_image' ),
	'priority'    => 160,
	'transport'   => $transport,
	'required'    => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 3,
		],
	],
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'textarea',
	'settings'    => 'additional_banner_2_text',
	'label'       => __( 'Banner 2 Text', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'additional_banner_2_text' ),
	'priority'    => 170,
	'required'    => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 3,
		],
	],
	'transport' => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'additional_banner_2_text_color',
	'label'       => esc_attr__( 'Banner 2 text color', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'additional_banner_2_text_color' ),
	'output' => [
		[
			'element'  => [
				'#additional-banner-2 .main-banner-text'
			],
			'property' => 'color',
		],

	],
	'required'    => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 3,
		],
	],
	'priority'    => 180,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'link',
	'settings'    => 'additional_banner_2_link',
	'label'       => __( 'Banner 2 Link', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'additional_banner_2_link' ),
	'priority'    => 190,
	'required'    => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 3,
		],
	],
	'transport' => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'additional_banner_2_overlay_color',
	'label'       => esc_attr__( 'Banner 2 overlay color', 'davinciwoo' ),
	'section'     => 'page_front_slider',
	'default'     => adswth_defaults( 'additional_banner_2_overlay_color' ),
	'output' => [
		[
			'element'  => [
				'#additional-banner-2 .main-banner-text'
			],
			'property' => 'background-color',
		],

	],
	'choices'     => [
		'alpha' => true,
	],
	'required'    => [
		[
			'setting'  => 'slider_layout',
			'operator' => '>=',
			'value'    => 3,
		],
	],
	'priority'    => 200,
	'transport'   => 'auto',
]);

function adswth_refresh_page_front_slider_menu( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	// Slider Menu
	$wp_customize->selective_refresh->add_partial( 'slider-menu', [
		'selector'            => '.slider-menu-wrap',
		'container_inclusive' => true,
		'settings'            => [ 'slider_menu_show'  ],
		'render_callback'     => function() {
			return get_template_part('template-parts/page-front/page-front', 'slider-menu');
		},
	] );

	// Slider Area
	$wp_customize->selective_refresh->add_partial( 'slider-area', [
		'selector'            => '.main-slider-wrap',
		'container_inclusive' => true,
		'settings'            => [
			'slider_layout',
			'additional_banner_1_image',
			'additional_banner_1_text',
			'additional_banner_1_link',
			'additional_banner_2_image',
			'additional_banner_2_text',
			'additional_banner_2_link'
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/page-front/page-front', 'slider');
		},
	] );

}
add_action( 'customize_register', 'adswth_refresh_page_front_slider_menu' );