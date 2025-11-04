<?php

\adswth\adsOptions::add_section( 'blog_header', [
    'title'    => __( 'Header', 'davinciwoo' ),
    'panel'    => 'blog',
    'priority' => 10,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'      => 'checkbox',
    'settings'  => 'blog_header_view',
    'section'   => 'blog_header',
    'label'     => __( 'Use theme header', 'davinciwoo' ),
    'default'   => adswth_defaults( 'blog_header_view' ),
    'transport' => $transport,
    'priority'  => 10,
] );


\adswth\adsOptions::add_field( '', [
    'type'     => 'custom',
    'settings' => 'custom_blog_logo',
    'section'  => 'blog_header',
    'required'    => [
        [
            'setting'  => 'blog_header_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority' => 20,
    'default'  => '<div class="options-title-divider">' . esc_attr__( 'Logo', 'davinciwoo' ) . '</div>',
] );


\adswth\adsOptions::add_field( 'option', [
    'type'        => 'image',
    'settings'    => 'blog_logo',
    'label'       => __( 'Logo image', 'davinciwoo' ),
    'description' => esc_attr__( 'Recommended size: 350*75px', 'davinciwoo' ),
    'section'     => 'blog_header',
    'default'     => adswth_option( 'site_logo' ),
    'required'    => [
        [
            'setting'  => 'blog_header_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority'    => 30,
    'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'slider',
    'settings'    => 'blog_logo_width',
    'label'       => __( 'Logo container max width', 'davinciwoo' ),
    'section'     => 'blog_header',
    'default'     => adswth_defaults( 'blog_logo_width' ),
    'choices'     => [
        'min'  => 30,
        'max'  => 400,
        'step' => 1
    ],
    'output' => [
        [
            'element'  => '#header-blog .blog-logo-wrap',
            'property' => 'width',
            'units' => 'px'
        ]
    ],
    'required'    => [
        [
            'setting'  => 'blog_header_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority'    => 40,
    'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'text',
    'settings'    => 'blog_back_text',
    'label'       => __( 'Back to shop button text', 'davinciwoo' ),
    'section'     => 'blog_header',
    'default'     => adswth_defaults( 'blog_back_text' ),
    'required'    => [
        [
            'setting'  => 'blog_header_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority'    => 40,
    'transport'   => $transport,
]);

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'link',
    'settings'    => 'blog_back_link',
    'label'       => __( 'Back to shop button link', 'davinciwoo' ),
    'section'     => 'blog_header',
    'default'     => adswth_defaults( 'blog_back_link' ),
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

function adswth_refresh_blog_header( WP_Customize_Manager $wp_customize ) {

    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }

    $wp_customize->selective_refresh->add_partial( 'blog_header', [
        'selector'            => '#header-blog',
        'settings'            => [
            'blog_header_view',
        ],
    ] );

    // logo image
    $wp_customize->selective_refresh->add_partial( 'blog_logo', [
        'selector' => '.blog-logo-area',
        'container_inclusive' => false,
        'settings' => [ 'blog_logo' ],
        'render_callback' => function() {
            return get_template_part( 'template-parts/blog/partials/header', 'logo' );
        },
    ] );

    // Back to shop button text
    $wp_customize->selective_refresh->add_partial( 'blog_back_text', [
        'selector' => '.blog-back-area',
        'container_inclusive' => false,
        'settings' => [ 'blog_back_text', 'blog_back_link' ],
        'render_callback' => function() {
            return get_template_part( 'blog/template-parts/partials/header', 'block-back' );
        },
    ] );
}
add_action( 'customize_register', 'adswth_refresh_blog_header' );