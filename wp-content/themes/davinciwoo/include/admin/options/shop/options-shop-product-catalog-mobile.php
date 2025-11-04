<?php
\adswth\adsOptions::add_section( 'woocommerce-catalog-mobile', [
	'title' => __( 'Product Catalog (mobile)', 'davinciwoo' ),
	'panel' => 'woocommerce',
    'priority'       => 15,
]);


\adswth\adsOptions::add_field( 'option', [
    'type'        => 'radio-buttonset',
    'settings'    => 'woo_product_cat_mob',
    'label'       => __( 'Products per row', 'davinciwoo' ),
    'description' => __( 'How many products should be shown per row?', 'davinciwoo' ),
    'section'     => 'woocommerce-catalog-mobile',
    'default'     => adswth_defaults( 'woo_product_cat_mob' ),
    'priority'    => 10,
    'choices'     => [
        '1'       => __( '1 per row', 'davinciwoo' ),
        '2'       => __( '2 per row', 'davinciwoo' ),
    ],
] );