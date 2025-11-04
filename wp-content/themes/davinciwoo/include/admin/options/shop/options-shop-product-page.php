<?php

\adswth\adsOptions::add_section( 'product-page', [
	'title' => __( 'Product Page', 'davinciwoo' ),
	'panel' => 'woocommerce',
]);

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_product_gallery',
	'section'  => 'product-page',
	'default'  => '<div class="options-title-divider">' . __( 'Gallery', 'davinciwoo' ) . '</div>',
	'priority' => 10,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'            => 'radio-image',
	'settings'        => 'product_image_style',
	'label'           => __( 'Product Image Style', 'davinciwoo' ),
	'section'         => 'product-page',
	'default'         =>  adswth_defaults( 'product_image_style' ),
	'choices'         => [
		'normal'   => ADSW_THEME_URL . '/include/admin/customizer/images/icons/product-gallery.svg',
		'vertical' => ADSW_THEME_URL . '/include/admin/customizer/images/icons/product-gallery-vertical.svg',
	],
	'required'    => [
		[
			'setting'  => 'product_gallery_woocommerce',
			'operator' => '==',
			'value'    => 0,
		]
	],
	'priority'    => 20
] );

\adswth\adsOptions::add_field( 'option', [
	'type'            => 'slider',
	'settings'        => 'product_image_thumbnails_columns',
	'label'           => __( 'Previews count', 'davinciwoo' ),
	'section'         => 'product-page',
	'default'         =>  adswth_defaults( 'product_image_thumbnails_columns' ),
	'choices'     => [
		'min'  => '4',
		'max'  => '8',
		'step' => '1',
	],
	'required'    => [
		[
			'setting'  => 'product_gallery_woocommerce',
			'operator' => '==',
			'value'    => 0,
		],
		[
			'setting'  => 'product_image_style',
			'operator' => '==',
			'value'    => 'normal',
		]
	],
	'priority'    => 20
] );

\adswth\adsOptions::add_field( 'option', [
	'type'            => 'radio-buttonset',
	'settings'        => 'product_image_thumbnails_position',
	'label'           => __( 'Previews position', 'davinciwoo' ),
	'section'         => 'product-page',
	'default'         =>  adswth_defaults( 'product_image_thumbnails_position' ),
	'choices'         => [
		'left'  => __( 'Left', 'davinciwoo' ),
		'right' => __( 'Right', 'davinciwoo' ),
	],
	'required'    => [
		[
			'setting'  => 'product_gallery_woocommerce',
			'operator' => '==',
			'value'    => 0,
		],
		[
			'setting'  => 'product_image_style',
			'operator' => '==',
			'value'    => 'vertical',
		]
	],
	'priority'    => 30
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_product_rating',
	'section'  => 'product-page',
	'default'  => '<div class="options-title-divider">' . __( 'Rating', 'davinciwoo' ) . '</div>',
	'priority' => 40,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_rating_show',
	'section'   => 'product-page',
	'label'     => __( 'Show rating', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_rating_show' ),
	'transport' => $transport,
	'priority'  => 50,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_rating_details_show',
	'section'   => 'product-page',
	'label'     => __( 'Show rating details', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_rating_details_show' ),
	'transport' => $transport,
	'priority'  => 60,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_orders_count_show',
	'section'   => 'product-page',
	'label'     => __( 'Show orders count', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_orders_count_show' ),
	'transport' => $transport,
	'priority'  => 70,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_product_share',
	'section'  => 'product-page',
	'default'  => '<div class="options-title-divider">' . __( 'Social Media Share Buttons', 'davinciwoo' ) . '</div>',
	'priority' => 80,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_share_show',
	'section'   => 'product-page',
	'label'     => __( 'Show share buttons', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_share_show' ),
	'transport' => $transport,
	'priority'  => 90,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_add_to_cart_button',
	'section'  => 'product-page',
	'default'  => '<div class="options-title-divider">' . __( 'Add to Cart Button', 'davinciwoo' ) . '</div>',
	'priority' => 100,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'      => 'checkbox',
    'settings'  => 'add_to_cart_button_sticky',
    'section'   => 'product-page',
    'label'     => __( 'Enable sticky \'Add to cart\' button', 'davinciwoo' ),
    'default'   => adswth_defaults( 'add_to_cart_button_sticky' ),
    'transport' => $transport,
    'priority'  => 101,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'add_to_cart_button_color',
	'label'       => esc_attr__( 'Color', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_option( 'btn_primary_color' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary.single_add_to_cart_button',
			],
			'property' => 'background-color'
		],
		[
			'element'  => [
				'.btn-primary.single_add_to_cart_button',
			],
			'property' => 'border-color',
		],
	],
	'priority'    => 110,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'add_to_cart_button_color_hover',
	'label'       => esc_attr__( 'Hover and disabled color', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_option( 'btn_primary_color_hover' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary.single_add_to_cart_button:hover, .btn-primary.single_add_to_cart_button:focus, .btn-primary.single_add_to_cart_button:active',
				'.btn-primary.single_add_to_cart_button:not(:disabled):not(.disabled):active:focus',
				'.btn-primary.single_add_to_cart_button:not(:disabled):not(.disabled).active:focus',
				'.btn-primary.single_add_to_cart_button.disabled',
				'.btn-primary.single_add_to_cart_button:disabled'
			],
			'property' => 'background-color',
		],[
			'element'  => [
				'.btn-primary.single_add_to_cart_button:hover, .btn-primary.single_add_to_cart_button:focus, .btn-primary.single_add_to_cart_button:active',
				'.btn-primary.single_add_to_cart_button:not(:disabled):not(.disabled):active:focus',
				'.btn-primary.single_add_to_cart_button:not(:disabled):not(.disabled).active:focus',
				'.btn-primary.single_add_to_cart_button.disabled',
				'.btn-primary.single_add_to_cart_button:disabled'
			],
			'property' => 'border-color',
		],

	],
	'priority'    => 120,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'add_to_cart_button_text_color',
	'label'       => esc_attr__( 'Text color', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_option( 'btn_primary_text_color' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary.single_add_to_cart_button',
			],
			'property' => 'color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 130,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'add_to_cart_button_text_color_hover',
	'label'       => esc_attr__( 'Text hover color', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_option( 'btn_primary_text_color_hover' ),
	'output' => [
		[
			'element'  => [
				'.btn-primary.single_add_to_cart_button:hover, .btn-primary.single_add_to_cart_button:focus, .btn-primary.single_add_to_cart_button:active',
				'.btn-primary.single_add_to_cart_button:not(:disabled):not(.disabled):active:focus',
				'.btn-primary.single_add_to_cart_button:not(:disabled):not(.disabled).active:focus',
				'.btn-primary.single_add_to_cart_button.disabled',
				'.btn-primary.single_add_to_cart_button:disabled'
			],
			'property' => 'color',
			'suffix'   => '!important'
		],

	],
	'priority'    => 140,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_meta',
	'section'  => 'product-page',
	'default'  => '<div class="options-title-divider">' . __( 'Product Meta', 'davinciwoo' ) . '</div>',
	'priority' => 150,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_meta_sku_show',
	'section'   => 'product-page',
	'label'     => __( 'Show SKU', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_meta_sku_show' ),
	'transport' => $transport,
	'priority'  => 160,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_meta_category_show',
	'section'   => 'product-page',
	'label'     => __( 'Show Categories', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_meta_category_show' ),
	'transport' => $transport,
	'priority'  => 170,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_meta_tag_show',
	'section'   => 'product-page',
	'label'     => __( 'Show Tags', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_meta_tag_show' ),
	'transport' => $transport,
	'priority'  => 180,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_buyer_protection',
	'section'  => 'product-page',
	'default'  => '<div class="options-title-divider">' . __( 'Buyer Protection', 'davinciwoo' ) . '</div>',
	'priority' => 190,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_buyer_protection_show',
	'section'   => 'product-page',
	'label'     => __( 'Show buyer protection', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_buyer_protection_show' ),
	'tra.nsport' => $transport,
	'priority'  => 200,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'product_page_buyer_protection_icon_color',
	'label'       => esc_attr__( 'Buyer protection color', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_option( 'template_color' ),
	'output' => [
		[
			'element'  => '.buyer-protection-wrap.reliable .icon',
			'property' => 'fill',
		],
		[
			'element'  => '.buyer-protection-wrap.reliable i',
			'property' => 'color',
		],
	],
	'required'    => [
		[
			'setting'  => 'product_page_buyer_protection_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 210,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'product_page_buyer_protection_color',
	'label'       => esc_attr__( 'Buyer protection color', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_option( 'template_color' ),
	'output' => [
		[
			'element'  => '.buyer-protection-wrap.reliable',
			'property' => 'color',
		],
	],
	'required'    => [
		[
			'setting'  => 'product_page_buyer_protection_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 220,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_product_tabs',
	'section'  => 'product-page',
	'default'  => '<div class="options-title-divider">' . __( 'Product Tabs', 'davinciwoo' ) . '</div>',
	'priority' => 230,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_product_details_show',
	'section'   => 'product-page',
	'label'     => __( 'Show "Product details" tab', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_product_details_show' ),
	'transport' => $transport,
	'priority'  => 240,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_item_specifics_show',
	'section'   => 'product-page',
	'label'     => __( 'Show "Item specifics" tab', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_item_specifics_show' ),
	'transport' => $transport,
	'priority'  => 250,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'      => 'checkbox',
	'settings'  => 'product_page_shipping_show',
	'section'   => 'product-page',
	'label'     => __( 'Show "Shipping & Payment" tab', 'davinciwoo' ),
	'default'   => adswth_defaults( 'product_page_shipping_show' ),
	'transport' => $transport,
	'priority'  => 260,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_product_reviews',
	'section'  => 'product-page',
	'default'  => '<div class="options-title-divider">' . __( 'Reviews', 'davinciwoo' ) . '</div>',
	'priority' => 270,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'textarea',
	'settings'    => 'product_page_reviews_author_error',
	'label'       => esc_attr__( 'Author name verification error text', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_defaults( 'product_page_reviews_author_error' ),
	'priority'    => 280,
] );
\adswth\adsOptions::add_field( 'option', [
	'type'        => 'textarea',
	'settings'    => 'product_page_reviews_email_error',
	'label'       => esc_attr__( 'Email verification error text', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_defaults( 'product_page_reviews_email_error' ),
	'priority'    => 290,
] );
\adswth\adsOptions::add_field( 'option', [
	'type'        => 'textarea',
	'settings'    => 'product_page_reviews_text_error',
	'label'       => esc_attr__( 'Review text verification error text', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_defaults( 'product_page_reviews_text_error' ),
	'priority'    => 300,
] );
\adswth\adsOptions::add_field( 'option', [
	'type'        => 'toggle',
	'settings'    => 'product_page_reviews_terms_conditions_show',
	'label'       => esc_attr__( 'Show Terms & Conditions checkbox', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_defaults( 'product_page_reviews_terms_conditions_show' ),
	'priority'    => 310,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'textarea',
	'settings'    => 'product_page_reviews_terms_conditions_text',
	'label'       => esc_attr__( 'Terms & Conditions text', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_defaults( 'product_page_reviews_terms_conditions_text' ),
	'required'    => [
		[
			'setting'  => 'product_page_reviews_terms_conditions_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 320,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'textarea',
	'settings'    => 'product_page_reviews_terms_conditions_error',
	'label'       => esc_attr__( 'Terms & Conditions error text', 'davinciwoo' ),
	'section'     => 'product-page',
	'default'     => adswth_defaults( 'product_page_reviews_terms_conditions_error' ),
	'required'    => [
		[
			'setting'  => 'product_page_reviews_terms_conditions_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 330,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'      => 'checkbox',
    'settings'  => 'product_page_recommendation_show',
    'section'   => 'product-page',
    'label'     => __( 'Show recommended products', 'davinciwoo' ),
    'default'   => adswth_defaults( 'product_page_recommendation_show' ),
    'transport' => $transport,
    'priority'  => 340,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'      => 'checkbox',
    'settings'  => 'product_page_related_show',
    'section'   => 'product-page',
    'label'     => __( 'Show related products', 'davinciwoo' ),
    'default'   => adswth_defaults( 'product_page_related_show' ),
    'transport' => $transport,
    'priority'  => 350,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'      => 'checkbox',
    'settings'  => 'product_page_recently_show',
    'section'   => 'product-page',
    'label'     => __( 'Show recently viewed products', 'davinciwoo' ),
    'default'   => adswth_defaults( 'product_page_recently_show' ),
    'transport' => $transport,
    'priority'  => 360,
] );

function adswth_refresh_product_page( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'product_page_gallery', [
		'selector'            => '.product-gallery',
		'settings'            => [
			'custom_title_product_gallery',
		],
	] );

	$wp_customize->selective_refresh->add_partial( 'product_page_rating', [
		'selector'            => '.woocommerce-product-rating-wrap',
		'settings'            => [
			'product_page_rating_show',
			'product_page_rating_details_show',
			'product_page_orders_count_show',
			'product_page_share_show',

		],
		'render_callback'     => function() {
			return woocommerce_template_single_rating();
		},
	] );

	$wp_customize->selective_refresh->add_partial( 'product_page_meta', [
		'selector'            => '.product_meta',
		'container_inclusive' => true,
		'settings'            => [
			'product_page_meta_sku_show',
			'product_page_meta_category_show',
			'product_page_meta_tag_show',

		],
		'render_callback'     => function() {
			return woocommerce_template_single_meta();
		},
	] );



	$wp_customize->selective_refresh->add_partial( 'product_buyer_protection', [
		'selector'            => '.buyer-protection-wrap',
		'container_inclusive' => true,
		'settings'            => [
			'product_page_buyer_protection_show',
		],
		'render_callback'     => function() {
			return adswth_buyer_protection();
		},
	] );

	$wp_customize->selective_refresh->add_partial( 'product_page_product_tabs', [
		'selector'            => '.product-description-area .tabs.wrapper',
		'container_inclusive' => true,
		'settings'            => [
			'product_page_product_details_show',
			'product_page_item_specifics_show',
			'product_page_shipping_show',
		],
		'render_callback'     => function() {
			return woocommerce_output_product_data_tabs();
		},
	] );

    $wp_customize->selective_refresh->add_partial( 'product_recommendation', [
        'selector'            => '.product-sidebar .upsells',
        'container_inclusive' => true,
        'settings'            => [
            'product_page_recommendation_show',
        ],

    ] );

    $wp_customize->selective_refresh->add_partial( 'product_related', [
        'selector'            => '.related',
        'container_inclusive' => true,
        'settings'            => [
            'product_page_related_show',
        ],

    ] );

    $wp_customize->selective_refresh->add_partial( 'product_recently', [
        'selector'            => '.recently-viewed',
        'container_inclusive' => true,
        'settings'            => [
            'product_page_recently_show',
        ],

    ] );

}
add_action( 'customize_register', 'adswth_refresh_product_page' );