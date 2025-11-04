<?php
\adswth\adsOptions::add_section( 'product_settings', [
	'title'    => esc_attr__( 'Product Settings', 'davinciwoo' ),
	'panel'    => 'woocommerce',
	'priority' => 20,
] );


\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_price',
	'section'  => 'product_settings',
	'priority' => 10,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Price', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'price_color',
	'label'       => esc_attr__( 'Price color', 'davinciwoo' ),
	'section'     => 'product_settings',
	'default'     => adswth_defaults( 'price_color' ),
	'output' => [
		[
			'element'  => [
				'.woocommerce div.product p.price, .woocommerce div.product span.price',
				'.woocommerce.single-product div.product p.price, .woocommerce.single-product div.product span.price',
				'.woocommerce div.product .stock',
				'.woocommerce div.product .product-raiting-count .woocommerce-product-rating .review-enjoyed span',
				'.woocommerce div.product .product-raiting-count .rating-status-row .review-status-percent span'
			],
			'property' => 'color',
		],
	],
	'priority'    => 20,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_discount_badges',
	'section'  => 'product_settings',
	'priority' => 30,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Discount badges', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'discount_show',
	'section'     => 'product_settings',
	'description' => esc_attr__( 'Show discount badges on products', 'davinciwoo' ),
	'default'     => adswth_defaults( 'discount_show' ),
	'priority'    => 40,
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'transport'   => 'refresh',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'discount_background_color',
	'label'       => esc_attr__( 'Color', 'davinciwoo' ),
	'section'     => 'product_settings',
	'default'     => adswth_option( 'template_color' ),
	'output' => [
		[
			'element'  => '.onsale:before',
			'property' => 'background-color',
		],
	],
	'priority'    => 50,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'discount_color',
	'label'       => esc_attr__( 'Text color', 'davinciwoo' ),
	'section'     => 'product_settings',
	'default'     => adswth_option( 'discount_color' ),
	'output' => [
		[
			'element'  => '.onsale',
			'property' => 'color',
		],
	],
	'priority'    => 60,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_rating',
	'section'  => 'product_settings',
	'priority' => 70,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Rating', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'checkbox',
    'settings'    => 'product_average_rating_use',
    'section'     => 'product_settings',
    'label'       => __( 'Use average rating', 'davinciwoo' ),
    'default'     => adswth_defaults('product_average_rating_use'),
    'priority'    => 80,
    'transport' => 'auto',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'slider',
	'settings'    => 'product_average_rating',
	'label'       => esc_attr__( 'Average Rating', 'davinciwoo' ),
	'section'     => 'product_settings',
	'description' => __( 'Average rating for products without reviews.', 'davinciwoo' ),
	'default'     => adswth_defaults( 'product_average_rating' ),
	'choices'     => [
		'min'  => '0',
		'max'  => '5',
		'step' => '.1',
	],
	'priority'    => 90,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'stars_primary_color',
	'label'       => esc_attr__( 'Stars primary color', 'davinciwoo' ),
	'section'     => 'product_settings',
	'default'     => adswth_defaults( 'stars_primary_color' ),
	'output' => [
		[
			'element'  => '.woocommerce .star-rating span, .woocommerce p.stars:hover a::before, .woocommerce p.stars.selected a.active::before, .woocommerce p.stars.selected a:not(.active)::before',
			'property' => 'color',
		],
	],
	'priority'    => 100,
	'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'color',
	'settings'    => 'stars_secondary_color',
	'label'       => esc_attr__( 'Stars secondary color', 'davinciwoo' ),
	'section'     => 'product_settings',
	'default'     => adswth_defaults( 'stars_secondary_color' ),
	'output' => [
		[
			'element'  => '.woocommerce .star-rating::before, .woocommerce p.stars a::before, .woocommerce p.stars a:hover~a::before, .woocommerce p.stars.selected a.active~a::before',
			'property' => 'color',
		],
	],
	'priority'    => 110,
	'transport'   => 'auto',
]);