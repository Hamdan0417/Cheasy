<?php
\adswth\adsOptions::add_section( 'page_front_products', [
	'title'    => esc_attr__( 'Products', 'davinciwoo' ),
	'panel'    => 'page_front',
	'priority' => 40,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'switch',
	'settings'    => 'page_front_products_block_show',
	'section'     => 'page_front_products',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_attr__( 'Show', 'davinciwoo' ),
		'off' => esc_attr__( 'Hide', 'davinciwoo' ),
	],
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'sortable',
	'settings'    => 'page_front_products_sorting',
	'label'       => __( 'Blocks visibility and order', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'page_front_products_sorting' ),
	'choices'     => [
		'top_selling'  => esc_attr__( 'Top Selling Products', 'davinciwoo' ),
		'onsale'       => esc_attr__( 'On Sale', 'davinciwoo' ),
		'new_arrivals' => esc_attr__( 'New Arrivals', 'davinciwoo' ),
		'recommended'  => esc_attr__( 'We Recommend', 'davinciwoo' ),
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
	],
	'priority'    => 20,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_products_top_selling',
	'section'  => 'page_front_products',
	'priority'    => 100,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'Top Selling Products', 'davinciwoo' ) . '</div>',
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'top_selling',
		]
	],
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'text',
	'settings'    => 'products_top_selling_title',
	'label'       => __( 'Title', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     =>  adswth_defaults( 'products_top_selling_title' ),
	'description' => esc_attr__('Top selling products section title.', 'davinciwoo'),
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'top_selling',
		]
	],
	'priority'    => 105,
	'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'radio-image',
	'settings'    => 'products_top_selling_scheme',
	'label'       => __( 'Block layout', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_top_selling_scheme' ),
	'choices'     => [
		'masonry' => ADSW_THEME_URL . '/include/admin/customizer/images/icons/masonry.svg',
		'line'    => ADSW_THEME_URL . '/include/admin/customizer/images/icons/line.svg',
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'top_selling',
		]
	],
	'priority'    => 110,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'radio-buttonset',
	'settings'    => 'products_top_selling_count',
	'label'       => esc_attr__( 'Number of columns', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_top_selling_count' ),
	'choices'         => [
		'6' => __( '6', 'davinciwoo' ),
		'5' => __( '5', 'davinciwoo' ),
		'4' => __( '4', 'davinciwoo' ),
		'3' => __( '3', 'davinciwoo' ),
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'top_selling',
		],
		[
			'setting'  => 'products_top_selling_scheme',
			'operator' => '==',
			'value'    => 'line',
		]
	],
	'priority'    => 115,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'number',
	'settings'    => 'products_top_selling_volume',
	'label'       => esc_attr__( 'Number of products in the block', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_top_selling_volume' ),
	'choices'         => [
		'min'  => 1,
		'max'  => 20,
		'step' => 1
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'top_selling',
		],
		[
			'setting'  => 'products_top_selling_scheme',
			'operator' => '==',
			'value'    => 'line',
		]
	],
	'priority'    => 120,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_products_onsale',
	'section'  => 'page_front_products',
	'priority'    => 200,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'On Sale', 'davinciwoo' ) . '</div>',
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'onsale',
		]
	],
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'text',
	'settings'    => 'products_onsale_title',
	'label'       => __( 'Title', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_onsale_title' ),
	'description' => esc_attr__('On Sale section title.', 'davinciwoo'),
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'onsale',
		]
	],
	'priority'    => 205,
	'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'radio-image',
	'settings'    => 'products_onsale_scheme',
	'label'       => __( 'Block layout', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_onsale_scheme' ),
	'choices'     => [
		'masonry' => ADSW_THEME_URL . '/include/admin/customizer/images/icons/masonry.svg',
		'line'    => ADSW_THEME_URL . '/include/admin/customizer/images/icons/line.svg',
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'onsale',
		]
	],
	'priority'    => 210,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'radio-buttonset',
	'settings'    => 'products_onsale_count',
	'label'       => esc_attr__( 'Number of columns', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_onsale_count' ),
	'choices'         => [
		'6' => __( '6', 'davinciwoo' ),
		'5' => __( '5', 'davinciwoo' ),
		'4' => __( '4', 'davinciwoo' ),
		'3' => __( '3', 'davinciwoo' ),
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'onsale',
		],
		[
			'setting'  => 'products_onsale_scheme',
			'operator' => '==',
			'value'    => 'line',
		]
	],
	'priority'    => 215,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'number',
	'settings'    => 'products_onsale_volume',
	'label'       => esc_attr__( 'Number of products in the block', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_onsale_volume' ),
	'choices'         => [
		'min'  => 1,
		'max'  => 20,
		'step' => 1
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'onsale',
		],
		[
			'setting'  => 'products_onsale_scheme',
			'operator' => '==',
			'value'    => 'line',
		]
	],
	'priority'    => 220,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_products_new_arrivals',
	'section'  => 'page_front_products',
	'priority'    => 300,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'New Arrivals', 'davinciwoo' ) . '</div>',
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'new_arrivals',
		]
	],
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'text',
	'settings'    => 'products_new_arrivals_title',
	'label'       => __( 'Title', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_new_arrivals_title' ),
	'description' => esc_attr__( 'New Arrivals section title.', 'davinciwoo' ),
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'new_arrivals',
		]
	],
	'priority'    => 305,
	'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'radio-image',
	'settings'    => 'products_new_arrivals_scheme',
	'label'       => __( 'Block layout', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_new_arrivals_scheme' ),
	'choices'     => [
		'masonry' => ADSW_THEME_URL . '/include/admin/customizer/images/icons/masonry.svg',
		'line'    => ADSW_THEME_URL . '/include/admin/customizer/images/icons/line.svg',
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'new_arrivals',
		]
	],
	'priority'    => 310,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'radio-buttonset',
	'settings'    => 'products_new_arrivals_count',
	'label'       => esc_attr__( 'Number of columns', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_new_arrivals_count' ),
	'choices'         => [
		'6' => __( '6', 'davinciwoo' ),
		'5' => __( '5', 'davinciwoo' ),
		'4' => __( '4', 'davinciwoo' ),
		'3' => __( '3', 'davinciwoo' ),
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'new_arrivals',
		],
		[
			'setting'  => 'products_new_arrivals_scheme',
			'operator' => '==',
			'value'    => 'line',
		]
	],
	'priority'    => 315,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'number',
	'settings'    => 'products_new_arrivals_volume',
	'label'       => esc_attr__( 'Number of products in the block', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_new_arrivals_volume' ),
	'choices'         => [
		'min'  => 1,
		'max'  => 20,
		'step' => 1
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'new_arrivals',
		],
		[
			'setting'  => 'products_new_arrivals_scheme',
			'operator' => '==',
			'value'    => 'line',
		]
	],
	'priority'    => 320,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_products_recommended',
	'section'  => 'page_front_products',
	'priority'    => 400,
	'default'  => '<div class="options-title-divider">' . esc_attr__( 'We Recommend', 'davinciwoo' ) . '</div>',
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'recommended',
		]
	],
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'text',
	'settings'    => 'products_recommended_title',
	'label'       => __( 'Title', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_recommended_title' ),
	'description' => esc_attr__('We Recommend section title.', 'davinciwoo'),
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'recommended',
		]
	],
	'priority'    => 405,
	'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'radio-image',
	'settings'    => 'products_recommended_scheme',
	'label'       => __( 'Block layout', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_recommended_scheme' ),
	'choices'     => [
		'masonry' => ADSW_THEME_URL . '/include/admin/customizer/images/icons/masonry.svg',
		'line'    => ADSW_THEME_URL . '/include/admin/customizer/images/icons/line.svg',
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting' => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'recommended',
		]
	],
	'priority'    => 410,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'radio-buttonset',
	'settings'    => 'products_recommended_count',
	'label'       => esc_attr__( 'Number of columns', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_recommended_count' ),
	'choices'         => [
		'6' => __( '6', 'davinciwoo' ),
		'5' => __( '5', 'davinciwoo' ),
		'4' => __( '4', 'davinciwoo' ),
		'3' => __( '3', 'davinciwoo' ),
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'recommended',
		],
		[
			'setting'  => 'products_recommended_scheme',
			'operator' => '==',
			'value'    => 'line',
		]
	],
	'priority'    => 415,
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'number',
	'settings'    => 'products_recommended_volume',
	'label'       => esc_attr__( 'Number of products in the block', 'davinciwoo' ),
	'section'     => 'page_front_products',
	'default'     => adswth_defaults( 'products_recommended_volume' ),
	'choices'         => [
		'min'  => 1,
		'max'  => 20,
		'step' => 1
	],
	'required'    => [
		[
			'setting'  => 'page_front_products_block_show',
			'operator' => '==',
			'value'    => 1,
		],
		[
			'setting'  => 'page_front_products_sorting',
			'operator' => 'contains',
			'value'    => 'recommended',
		],
		[
			'setting'  => 'products_recommended_scheme',
			'operator' => '==',
			'value'    => 'line',
		]
	],
	'priority'    => 420,
	'transport'   => $transport,
] );

function adswth_refresh_page_front_products( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'page_front_products', [
		'selector'            => '#products-front',
		'container_inclusive' => true,
		'settings'            => [
			'page_front_products_block_show',
			'page_front_products_sorting'
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/page-front/page-front', 'products');
		},
	] );

	$wp_customize->selective_refresh->add_partial( 'page_front_products_top_selling', [
		'selector'            => '#products-front-top_selling',
		'container_inclusive' => true,
		'settings'            => [
			'products_top_selling_title',
			'products_top_selling_scheme',
			'products_top_selling_count',
			'products_top_selling_volume'
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/page-front/partials/section', 'top_selling');
		},
	] );

	$wp_customize->selective_refresh->add_partial( 'page_front_products_onsale', [
		'selector'            => '#products-front-onsale',
		'container_inclusive' => true,
		'settings'            => [
			'products_onsale_title',
			'products_onsale_scheme',
			'products_onsale_count',
			'products_onsale_volume'
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/page-front/partials/section', 'onsale');
		},
	] );

	$wp_customize->selective_refresh->add_partial( 'page_front_products_new_arrivals', [
		'selector'            => '#products-front-new_arrivals',
		'container_inclusive' => true,
		'settings'            => [
			'products_new_arrivals_title',
			'products_new_arrivals_scheme',
			'products_new_arrivals_count',
			'products_new_arrivals_volume'
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/page-front/partials/section', 'new_arrivals');
		},
	] );

	$wp_customize->selective_refresh->add_partial( 'page_front_products_recommended', [
		'selector'            => '#products-front-recommended',
		'container_inclusive' => true,
		'settings'            => [
			'products_recommended_title',
			'products_recommended_scheme',
			'products_recommended_count',
			'products_recommended_volume'
		],
		'render_callback'     => function() {
			return get_template_part('template-parts/page-front/partials/section', 'recommended');
		},
	] );
}
add_action( 'customize_register', 'adswth_refresh_page_front_products' );
