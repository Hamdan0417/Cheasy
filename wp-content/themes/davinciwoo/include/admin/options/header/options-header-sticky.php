<?php
\adswth\adsOptions::add_section( 'header_sticky', [
	'title'       => __( 'Sticky Header', 'davinciwoo' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'davinciwoo' ),
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'switch',
    'settings'    => 'header_sticky_show',
    'description' => __( 'Enable sticky header', 'davinciwoo' ),
    'section'     => 'header_sticky',
    'default'     => adswth_defaults( 'header_sticky_show' ),
    'priority'    => 10,
    'choices'     => [
        'on'  => esc_attr__( 'Show', 'davinciwoo' ),
        'off' => esc_attr__( 'Hide', 'davinciwoo' ),
    ],

] );