<?php

\adswth\adsOptions::add_section( 'blog_footer', [
    'title'    => __( 'Footer', 'davinciwoo' ),
    'panel'    => 'blog',
    'priority' => 40,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'      => 'checkbox',
    'settings'  => 'blog_footer_view',
    'section'   => 'blog_footer',
    'label'     => __( 'Use theme footer', 'davinciwoo' ),
    'default'   => adswth_defaults( 'blog_footer_view' ),
    'transport' => $transport,
    'priority'  => 10,
] );

\adswth\adsOptions::add_field( '', [
    'type'            => 'custom',
    'settings'        => 'footer_absolute_section_title',
    'label'           => '',
    'section'         => 'footer',
    'default'         => '<div class="options-title-divider">' . __( 'Copyright Notice', 'davinciwoo' ) . '</div>',
    'priority'        => 150,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'textarea',
    'settings'    => 'blog_footer_absolute_text_primary',
    'label'       => __( 'Bottom Text - Primary', 'davinciwoo' ),
    'section'     => 'blog_footer',
    'default'     => adswth_defaults( 'blog_footer_absolute_text_primary' ),
    'description' => esc_attr__('Add Any Text here...', 'davinciwoo'),
    'required'    => [
        [
            'setting'  => 'blog_footer_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority'    => 170,
    'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
    'type'        => 'color',
    'settings'    => 'blog_footer_absolute_text_primary_color',
    'label'       => esc_attr__( 'Primary text color', 'davinciwoo' ),
    'section'     => 'blog_footer',
    'default'     => adswth_defaults( 'blog_footer_absolute_text_primary_color' ),
    'output' => [
        [
            'element'  => '.blog-footer-absolute-primary',
            'property' => 'color',
        ],
    ],
    'required'    => [
        [
            'setting'  => 'blog_footer_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority'    => 180,
    'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'textarea',
    'settings'    => 'blog_footer_absolute_text_secondary',
    'label'       => __( 'Bottom Text - Secondary', 'davinciwoo' ),
    'section'     => 'blog_footer',
    'default'     => adswth_defaults( 'blog_footer_absolute_text_secondary' ),
    'description' => esc_attr__('Add Any Text here...', 'davinciwoo'),
    'required'    => [
        [
            'setting'  => 'blog_footer_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority'    => 190,
    'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option', [
    'type'        => 'color',
    'settings'    => 'blog_footer_absolute_text_secondary_color',
    'label'       => esc_attr__( 'Secondary text color', 'davinciwoo' ),
    'section'     => 'blog_footer',
    'default'     => adswth_defaults( 'blog_footer_absolute_text_secondary_color' ),
    'output' => [
        [
            'element'  => '.blog-footer-absolute-secondary',
            'property' => 'color',
        ],
    ],
    'required'    => [
        [
            'setting'  => 'blog_footer_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority'    => 200,
    'transport'   => 'auto',
]);


\adswth\adsOptions::add_field( 'option', [
    'type'        => 'color',
    'settings'    => 'blog_footer_absolute_background_color',
    'label'       => esc_attr__( 'Background color', 'davinciwoo' ),
    'section'     => 'blog_footer',
    'default'     => adswth_defaults( 'blog_footer_absolute_background_color' ),
    'output' => [
        [
            'element'  => '.footer-blog',
            'property' => 'background-color',
        ],
    ],
    'required'    => [
        [
            'setting'  => 'blog_footer_view',
            'operator' => '==',
            'value'    => 0,
        ],
    ],
    'priority'    => 210,
    'transport'   => 'auto',
]);


function adswth_refresh_blog_footer( WP_Customize_Manager $wp_customize ) {

    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }

    $wp_customize->selective_refresh->add_partial( 'blog_footer', [
        'selector'            => '#footer-blog',
        'settings'            => [
            'blog_footer_view',
        ],
    ] );

}
add_action( 'customize_register', 'adswth_refresh_blog_footer' );