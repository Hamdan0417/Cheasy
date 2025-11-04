<?php
\adswth\adsOptions::add_section( 'header_top', [
	'title'       => esc_attr__( 'Top Header', 'davinciwoo' ),
	'panel'       => 'header',
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_header_top_colors',
	'section'  => 'header_top',
	'priority'    => 10,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Colors', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'header_top_text_color',
	'label'       => esc_attr__( 'Text color', 'davinciwoo' ),
	'section'     => 'header_top',
	'default'     => adswth_defaults( 'header_top_text_color' ),
	'output' => [
		[
			'element'  => [
				'.header-top',
				'.header-top a',
				'.mobile-search .search-input-container .search-field',
				//'.mobile-search .search-input-container .search-field::placeholder', ERROR! MS Edge
				'.mobile-menu-sidebar, .mobile-menu-sidebar a',
				'.mobile-menu-header .mobile-menu-close',
				'.mobile-search .search-input-container .scopes .scope',
				'.mobile-search .search-input-container .scopes .scope2',
				'.mobile-search .search-input-container .scopes .clear-search',
			],
			'property' => 'color',
		],

	],
	'priority'    => 20,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'header_top_text_color_hover',
	'label'       => esc_attr__( 'Text hover color', 'davinciwoo' ),
	'section'     => 'header_top',
	'default'     => adswth_defaults( 'header_top_text_color_hover' ),
	'output' => [
		[
			'element'  => [
				'ul.topmenu>li.menu-item>a:hover',
				'ul.topmenu>li.current-menu-item>a',
                '.header-account a:hover',
                '.ship-tip a:hover',
                '.header-currency-switcher .current-currency:hover',
			],
			'property' => 'color',
		],[
			'element'  => [
				'ul.topmenu>li.menu-item>a:hover',
				'ul.topmenu>li.current-menu-item>a',
			],
			'property' => 'border-bottom-color',
		],

	],
	'priority'    => 30,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_header_tip',
	'section'  => 'header_top',
	'priority'    => 40,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Custom header text and icon', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'header_tip_show',
	'section'     => 'header_top',
	'default'     => adswth_defaults('header_tip_show'),
	'priority'    => 50,
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'transport' => $transport,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'checkbox',
    'settings'    => 'header_tip_icon_custom',
    'section'     => 'header_top',
    'label'       => __( 'Use custom header icon', 'davinciwoo' ),
    'default'     => adswth_defaults('header_tip_icon_custom'),
    'priority'    => 55,
    'required'    => [
        [
            'setting'  => 'header_tip_show',
            'operator' => '==',
            'value'    => '1',
        ],
    ],
    'transport' => $transport,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'image',
	'settings'    => 'header_tip_icon',
	'label'       => esc_attr__( 'Custom header icon', 'davinciwoo' ),
	'section'     => 'header_top',
	'description' => esc_attr__( 'Recommended size: 50*50px', 'davinciwoo' ),
    //'default'     => adswth_defaults('header_tip_icon'),
	'priority'    => 60,
	'required'    => [
	    [
            'setting'  => 'header_tip_icon_custom',
            'operator' => '==',
            'value'    => '1',
        ],
		[
			'setting'  => 'header_tip_show',
			'operator' => '==',
			'value'    => '1',
		],
	],
	'transport' => $transport,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'textarea',
	'settings'    => 'header_tip_text',
	'label'       => __( 'Custom header text', 'davinciwoo' ),
	'section'     => 'header_top',
	'default'     => esc_attr__( 'Free worldwide shipping', 'davinciwoo' ),
	'priority'    => 70,
	'required'    => [
		[
			'setting'  => 'header_tip_show',
			'operator' => '==',
			'value'    => '1',
		],
	],
	'transport' => 'postMessage',
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_currency_switcher',
	'section'  => 'header_top',
	'priority'    => 80,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Currency switcher', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'header_currency_switcher_show',
    'description' => __( 'Enable built-in currency switcher in AliDropship Woo plugin settings', 'davinciwoo' ),
	'section'     => 'header_top',
	'default'     => adswth_defaults( 'header_currency_switcher_show' ),
	'priority'    => 90,
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'transport' => $transport,
] );

function adswth_refresh_header_top( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	// Header Tip
	$wp_customize->selective_refresh->add_partial( 'header-tip', [
		'selector' => '.ship-tip-wrap',
		'container_inclusive' => true,
		'settings' => [ 'header_tip_show', 'header_tip_icon_custom', 'header_tip_icon' ],
		'render_callback' => function() {
			return get_template_part( 'template-parts/header/partials/element-top', 'tip' );
		},
	] );

	// Header Currency Switcher
	$wp_customize->selective_refresh->add_partial( 'header-switcher-show', [
		'selector' => '.header-currency-switcher-wrap',
		'container_inclusive' => true,
		'settings' => [ 'header_currency_switcher_show'  ],
		'render_callback' => function() {
			return get_template_part( 'template-parts/header/partials/element-top', 'currency-switcher' );
		},
	] );
}
add_action( 'customize_register', 'adswth_refresh_header_top' );
