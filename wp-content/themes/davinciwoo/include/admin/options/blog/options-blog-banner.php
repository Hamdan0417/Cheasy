<?php

\adswth\adsOptions::add_section( 'blog_banner', [
    'title'    => __( 'Banner', 'davinciwoo' ),
    'panel'    => 'blog',
    'priority' => 20,
] );

\adswth\adsOptions::add_field( '', [
    'type'     => 'custom',
    'settings' => 'custom_blog_banner_main',
    'section'  => 'blog_banner',
    'priority' => 10,
    'default'  => '<div class="options-title-divider">' . esc_attr__( 'Main banner', 'davinciwoo' ) . '</div>',
] );


\adswth\adsOptions::add_field( 'option', [
    'type'        => 'image',
    'settings'    => 'blog_banner_main',
    'label'       => __( 'Banner ad image', 'davinciwoo' ),
    'description' => esc_attr__( 'Recommended size: 728*90px', 'davinciwoo' ),
    'section'     => 'blog_banner',
    'default'     => adswth_option( 'blog_banner_main' ),
    'priority'    => 20,
    'transport'   => $transport,
] );



\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'link',
    'settings'    => 'blog_banner_main_link',
    'label'       => __( 'Banner ad link', 'davinciwoo' ),
    'section'     => 'blog_banner',
    'default'     => adswth_defaults( 'blog_banner_main_link' ),
    'required'    => [
        [
            'setting'  => 'blog_header_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority'    => 30,
    'transport'   => $transport,
]);

\adswth\adsOptions::add_field( '', [
    'type'     => 'custom',
    'settings' => 'custom_blog_banner_single',
    'section'  => 'blog_banner',
    'priority' => 40,
    'default'  => '<div class="options-title-divider">' . esc_attr__( 'Single banner', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
    'type'        => 'image',
    'settings'    => 'blog_banner_single',
    'label'       => __( 'Single page banner ad', 'davinciwoo' ),
    'description' => esc_attr__( 'Recommended size: 250*250px', 'davinciwoo' ),
    'section'     => 'blog_banner',
    'default'     => adswth_option( 'blog_banner_single' ),
    'priority'    => 50,
    'transport'   => $transport,
] );



\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'link',
    'settings'    => 'blog_banner_single_link',
    'label'       => __( 'Banner ad link', 'davinciwoo' ),
    'section'     => 'blog_banner',
    'default'     => adswth_defaults( 'blog_banner_single_link' ),
    'required'    => [
        [
            'setting'  => 'blog_header_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority'    => 50,
    'transport'   => $transport,
]);

function adswth_refresh_blog_banner( WP_Customize_Manager $wp_customize ) {

    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }

    $wp_customize->selective_refresh->add_partial( 'blog_banner', [
        'selector'            => '.content_plus',
        'container_inclusive' => false,
        'settings'            => [
            'blog_banner_main',
            'blog_banner_main_link'
        ],
    ] );


}
add_action( 'customize_register', 'adswth_refresh_blog_banner' );