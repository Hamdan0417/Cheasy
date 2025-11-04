<?php
\adswth\adsOptions::add_section( 'colors', [
	'title' => __( 'Colors', 'davinciwoo' ),
	'panel' => 'style',
	'priority' => 10,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_color_general',
	'section'  => 'style',
	'priority' => 10,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'General', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'template_color',
	'label'       => esc_attr__( 'Template color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'template_color' ),
	'output' => [
		[
			'element'  => [
				'.tabs .nav-tabs li .active',
				'.pagination ul.page-numbers li>span.current',
			],
			'property' => 'color',
		],
        [
            'element'  => [
	            '.header-top',
	            '.mobile-search',
	            '.mobile-menu-header',
	            'ul.slider-menu>li.menu-item:hover>a, ul.product-categories>li.cat-item:hover>a',
	            '.tabs .nav-tabs li .active:after'
            ],
            'property' => 'background-color',
        ],
		[
			'element'  => [
				'.pagination ul.page-numbers li>span.current',
			],
			'property' => 'border-bottom-color',
		],
		[
			'element'  => [
				'.woocommerce div.product .product-description-area .tabs .tab-content .panel-heading .panel-title a',
			],
			'property' => 'color',
			'media_query' => '@media (max-width: 575px)'
		],
		[
			'element'  => [
				'.woocommerce div.product .product-description-area .tabs .tab-content .panel-heading .panel-title a',
			],
			'property' => 'border-bottom-color',
			'media_query' => '@media (max-width: 575px)'
		],
	],
	'priority'    => 20,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_color_link',
	'section'  => 'style',
	'priority' => 30,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Links', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'link_color',
	'label'       => esc_attr__( 'Color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'link_color' ),
	'output' => [
		[
			'element'  => [
				'a',
				'a:visited',
                'ul.nav-dropdown-default>li.menu-item.current-menu-item>a',
                'ul.product-categories li.cat-item.current-cat>a',
                'ul.slider-menu>li.menu-item.current-menu-item>a',
                '.search_page_results h3 span.search-query',
                '.search_page_results p span.search-query',
                '.search_form .search_item a'
			],
			'property' => 'color',
		],
        [
			'element'  => [
                '.category_list a.active'
			],
			'property' => 'color',
            'suffix'   => '!important'
		],
        [
			'element'  => [
                '.category_list a.active:after'
			],
			'property' => 'background'
		],

	],
	'priority'    => 40,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'link_hover_color',
	'label'       => esc_attr__( 'Hover color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'link_hover_color' ),
	'output' => [
		[
			'element'  => [
				'a:hover',
                '.search_form .search_item a:hover',
                '.header-currency-switcher .dropdown-menu li a:hover'
			],
			'property' => 'color',
		],

	],
	'priority'    => 50,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_color_primary_button',
	'section'  => 'style',
	'priority' => 60,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Primary button', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_primary_color',
	'label'       => esc_attr__( 'Color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'btn_primary_color' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary',
				'.woocommerce #respond input#submit.alt',
				'.woocommerce a.button.alt',
				'.woocommerce button.button.alt',
				'.woocommerce input.button.alt',
                '.woocommerce-page .wc-block-components-button'
			],
			'property' => 'background-color'
		],
		[
			'element'  => [
				'.btn-primary',
				'.woocommerce #respond input#submit.alt',
				'.woocommerce a.button.alt',
				'.woocommerce button.button.alt',
				'.woocommerce input.button.alt',
                '.woocommerce-page .wc-block-components-button'
			],
			'property' => 'border-color',
		],
	],
	'priority'    => 70,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_primary_color_hover',
	'label'       => esc_attr__( 'Hover color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'btn_primary_color_hover' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary:hover, .btn-primary:focus, .btn-primary:active',
				'.btn-primary:not(:disabled):not(.disabled):active:focus',
				'.btn-primary:not(:disabled):not(.disabled).active:focus',
				'.woocommerce #respond input#submit.alt:hover',
				'.woocommerce a.button.alt:hover',
				'.woocommerce button.button.alt:hover',
				'.woocommerce input.button.alt:hover',
				'.woocommerce #respond input#submit.alt:focus',
				'.woocommerce a.button.alt:focus',
				'.woocommerce button.button.alt:focus',
				'.woocommerce input.button.alt:focus',
				'.woocommerce #respond input#submit.alt',
				'.woocommerce a.button.alt:active',
				'.woocommerce button.button.alt:active',
				'.woocommerce input.button.alt:active',
                '.woocommerce-page .wc-block-components-button:hover',
				'.btn-primary.disabled',
				'.btn-primary:disabled'
			],
			'property' => 'background-color',
		],[
			'element'  => [
				'.btn-primary:hover, .btn-primary:focus, .btn-primary:active',
				'.btn-primary:not(:disabled):not(.disabled):active:focus',
				'.btn-primary:not(:disabled):not(.disabled).active:focus',
				'.woocommerce #respond input#submit.alt:hover',
				'.woocommerce a.button.alt:hover',
				'.woocommerce button.button.alt:hover',
				'.woocommerce input.button.alt:hover',
				'.woocommerce #respond input#submit.alt:focus',
				'.woocommerce a.button.alt:focus',
				'.woocommerce button.button.alt:focus',
				'.woocommerce input.button.alt:focus',
				'.woocommerce #respond input#submit.alt',
				'.woocommerce a.button.alt:active',
				'.woocommerce button.button.alt:active',
				'.woocommerce input.button.alt:active',
                '.woocommerce-page .wc-block-components-button:hover',
				'.btn-primary.disabled',
				'.btn-primary:disabled'
			],
			'property' => 'border-color',
		],

	],
	'priority'    => 80,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_primary_text_color',
	'label'       => esc_attr__( 'Text color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'btn_primary_text_color' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary',
				'.woocommerce #respond input#submit.alt',
				'.woocommerce a.button.alt',
				'.woocommerce button.button.alt',
				'.woocommerce input.button.alt'
			],
			'property' => 'color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 90,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_primary_text_color_hover',
	'label'       => esc_attr__( 'Text hover color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'btn_primary_text_color_hover' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary:hover, .btn-primary:focus, .btn-primary:active',
				'.btn-primary:not(:disabled):not(.disabled):active:focus',
				'.btn-primary:not(:disabled):not(.disabled).active:focus',
				'.woocommerce #respond input#submit.alt:hover',
				'.woocommerce a.button.alt:hover',
				'.woocommerce button.button.alt:hover',
				'.woocommerce input.button.alt:hover',
				'.woocommerce #respond input#submit.alt:focus',
				'.woocommerce a.button.alt:focus',
				'.woocommerce button.button.alt:focus',
				'.woocommerce input.button.alt:focus',
				'.woocommerce #respond input#submit.alt',
				'.woocommerce a.button.alt:active',
				'.woocommerce button.button.alt:active',
				'.woocommerce input.button.alt:active',
				'.btn-primary.disabled',
				'.btn-primary:disabled'
			],
			'property' => 'color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 100,
	'transport'   => 'auto',
]);


\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_color_secondary_button',
	'section'  => 'style',
	'priority' => 110,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Secondary button', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_secondary_color',
	'label'       => esc_attr__( 'Color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'btn_secondary_color' ),
	'output' => [
		[
			'element'  => [
				'.btn-secondary',
				'.button.wc-forward'
			],
			'property' => 'background-color',
            'suffix'   => '!important'
		],
		[
			'element'  => [
				'.btn-secondary',
				'.button.wc-forward'
			],
			'property' => 'border-color',
            'suffix'   => '!important'
		],
	],
	'priority'    => 120,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_secondary_color_hover',
	'label'       => esc_attr__( 'Hover color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'btn_secondary_color_hover' ),
	'output' => [
		[
			'element'  => [
				'.btn-secondary:hover', '.btn-secondary:focus', '.btn-secondary:active',
				'.btn-secondary:not(:disabled):not(.disabled):active:focus',
				'.btn-secondary:not(:disabled):not(.disabled).active:focus',
				'.button.wc-forward:hover',
				'.button.wc-forward:focus',
                '.button.wc-forward:active',
				'.button.wc-forward:not(:disabled):not(.disabled):active:focus',
				'.button.wc-forward:not(:disabled):not(.disabled).active:focus',
				'.btn-secondary:disabled',
				'.btn-secondary.disabled',
				'.button.wc-forward:disabled',
				'.button.wc-forward.disabled',
				'.btn-secondary:disabled:hover',
				'.btn-secondary.disabled:hover',
				'.button.wc-forward:disabled:hover',
				'.button.wc-forward.disabled:hover'
			],
			'property' => 'background-color',
			'suffix'   => '!important'
		],[
			'element'  => [
				'.btn-secondary:hover', '.btn-secondary:focus', '.btn-secondary:active',
				'.btn-secondary:not(:disabled):not(.disabled):active:focus',
				'.btn-secondary:not(:disabled):not(.disabled).active:focus',
				'.button.wc-forward:hover',
				'.button.wc-forward:focus',
				'.button.wc-forward:active',
				'.button.wc-forward:not(:disabled):not(.disabled):active:focus',
				'.button.wc-forward:not(:disabled):not(.disabled).active:focus',
				'.btn-secondary:disabled',
				'.btn-secondary.disabled',
				'.button.wc-forward:disabled',
				'.button.wc-forward.disabled',
				'.btn-secondary:disabled:hover',
				'.btn-secondary.disabled:hover',
				'.button.wc-forward:disabled:hover',
				'.button.wc-forward.disabled:hover'
			],
			'property' => 'border-color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 130,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_secondary_text_color',
	'label'       => esc_attr__( 'Text color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'btn_secondary_text_color' ),
	'output' => [
		[
			'element'  => [
				'.btn-secondary',
				'.button.wc-forward'
			],
			'property' => 'color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 140,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_secondary_text_color_hover',
	'label'       => esc_attr__( 'Text hover color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_defaults( 'btn_secondary_text_color_hover' ),
	'output' => [
		[
			'element'  => [
				'.btn-secondary:hover', '.btn-secondary:focus', '.btn-secondary:active',
				'.btn-secondary:not(:disabled):not(.disabled):active:focus',
				'.btn-secondary:not(:disabled):not(.disabled).active:focus',
				'.button.wc-forward:hover',
				'.button.wc-forward:focus',
				'.button.wc-forward:active',
				'.button.wc-forward:not(:disabled):not(.disabled):active:focus',
				'.button.wc-forward:not(:disabled):not(.disabled).active:focus',
				'.btn-secondary:disabled',
				'.btn-secondary.disabled',
				'.button.wc-forward:disabled',
				'.button.wc-forward.disabled',
				'.btn-secondary:disabled:hover',
				'.btn-secondary.disabled:hover',
				'.button.wc-forward:disabled:hover',
				'.button.wc-forward.disabled:hover'
			],
			'property' => 'color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 150,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_header_cart_button',
	'section'  => 'style',
	'default'  => '<div class="options-title-divider">' . __( 'Header Cart Button', 'davinciwoo' ) . '</div>',
	'priority' => 160,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_cart_color',
	'label'       => esc_attr__( 'Color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_option( 'btn_cart_color' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary.btn-cart',
			],
			'property' => 'background-color'
		],
		[
			'element'  => [
				'.btn-primary.btn-cart',
			],
			'property' => 'border-color',
		],
	],
	'priority'    => 170,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_cart_color_hover',
	'label'       => esc_attr__( 'Hover color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_option( 'btn_cart_color_hover' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary.btn-cart:hover, .btn-primary.btn-cart:focus, .btn-primary.btn-cart:active',
				'.btn-primary.btn-cart:not(:disabled):not(.disabled):active:focus',
				'.btn-primary.btn-cart:not(:disabled):not(.disabled).active:focus',
				'.btn-primary.btn-cart.disabled',
				'.btn-primary.btn-cart:disabled'
			],
			'property' => 'background-color',
		],[
			'element'  => [
				'.btn-primary.btn-cart:hover, .btn-primary.btn-cart:focus, .btn-primary.btn-cart:active',
				'.btn-primary.btn-cart:not(:disabled):not(.disabled):active:focus',
				'.btn-primary.btn-cart:not(:disabled):not(.disabled).active:focus',
				'.btn-primary.btn-cart.disabled',
				'.btn-primary.btn-cart:disabled'
			],
			'property' => 'border-color',
		],

	],
	'priority'    => 180,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_cart_text_color',
	'label'       => esc_attr__( 'Text color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_option( 'btn_primary_text_color' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary.btn-cart',
			],
			'property' => 'color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 190,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'btn_cart_text_color_hover',
	'label'       => esc_attr__( 'Text hover color', 'davinciwoo' ),
	'section'     => 'style',
	'default'     => adswth_option( 'btn_primary_text_color_hover' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary.btn-cart:hover, .btn-primary.btn-cart:focus, .btn-primary.btn-cart:active',
				'.btn-primary.btn-cart:not(:disabled):not(.disabled):active:focus',
				'.btn-primary.btn-cart:not(:disabled):not(.disabled).active:focus',
				'.btn-primary.btn-cart.disabled',
				'.btn-primary.btn-cart:disabled'
			],
			'property' => 'color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 200,
	'transport'   => 'auto',
]);