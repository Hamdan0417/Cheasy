<?php
\adswth\adsOptions::add_section( 'blog_subscribe', [
    'title'    => esc_attr__( 'Subscribe Form', 'davinciwoo' ),
    'panel'    => 'blog',
    'description' => __( 'Subscription form settings for collecting users’ emails', 'davinciwoo' ),
    'priority' => 30,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'switch',
    'settings'    => 'blog_subscribe_block_show',
    'section'     => 'blog_subscribe',
    'default'     => adswth_defaults( 'blog_subscribe_block_show' ),
    'priority'    => 10,
    'choices'     => [
        'on'  => esc_attr__( 'Show', 'davinciwoo' ),
        'off' => esc_attr__( 'Hide', 'davinciwoo' ),
    ],
    'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option', [
    'type'        => 'code',
    'settings'    => 'blog_subscribe_code',
    'label'       => esc_attr__( 'Subscribe Form Code', 'textdomain' ),
    'description' => esc_attr__( 'Paste your ‘Autoresponder’ code here.', 'textdomain' ),
    'section'     => 'blog_subscribe',
    'default'     => adswth_defaults( 'blog_subscribe_code' ),
    'choices'     => [
        'language' => 'html',
    ],
    'required'    => [
        [
            'setting'  => 'blog_subscribe_block_show',
            'operator' => '==',
            'value'    => 1,
        ]
    ],
    'priority'    => 20,
    'transport'   => 'postMessage',
] );

\adswth\adsOptions::add_field( 'option', [
    'type'        => 'color',
    'settings'    => 'blog_subscribe_background_color',
    'label'       => esc_attr__( 'Background color', 'davinciwoo' ),
    'section'     => 'blog_subscribe',
    'default'     => adswth_defaults( 'blog_subscribe_background_color' ),
    'output' => [
        [
            'element'  => '.subscribe_cont',
            'property' => 'background-color',
        ]
    ],
    'required'    => [
        [
            'setting'  => 'blog_subscribe_block_show',
            'operator' => '==',
            'value'    => 1,
        ]
    ],
    'priority'    => 30,
    'transport'   => 'auto',
]);

function adswth_refresh_blog_subscribe( WP_Customize_Manager $wp_customize ) {

    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }

    // Countdown-view
    $wp_customize->selective_refresh->add_partial( 'page_front_subscribe', [
        'selector'            => '.subscribe_cont',
        'container_inclusive' => true,
        'settings'            => [
            'blog_subscribe_block_show',
        ],
        'render_callback'     => function() {
            return get_template_part('blog/template-parts/partials/subscribe');
        },
    ] );
}
add_action( 'customize_register', 'adswth_refresh_blog_subscribe' );