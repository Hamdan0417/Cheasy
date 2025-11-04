<?php
\adswth\adsOptions::add_section( 'blog-style', [
    'title'       => __( 'Style', 'davinciwoo' ),
    //'description' => __( 'Theme styles', 'davinciwoo' ),
    'panel'       => 'blog',
    'priority'    => 50
] );

\adswth\adsOptions::add_field( '', [
    'type'     => 'custom',
    'settings' => 'custom_title_blog_color_primary_button',
    'section'  => 'blog-style',
    'priority' => 60,
    'default'  => '<div class="options-title-divider">' . esc_attr__( 'Primary button', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
    'type'        => 'color',
    'settings'    => 'blog_btn_primary_color',
    'label'       => esc_attr__( 'Color', 'davinciwoo' ),
    'section'     => 'blog-style',
    'default'     => adswth_option( 'btn_primary_color' ),
    'output' => [
        [
            'element'  => [
                '.btn-blog.btn-primary',
            ],
            'property' => 'background-color'
        ],
        [
            'element'  => [
                '.btn-blog.btn-primary',
            ],
            'property' => 'border-color',
        ],
    ],
    'priority'    => 70,
    'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
    'type'        => 'color',
    'settings'    => 'blog_btn_primary_color_hover',
    'label'       => esc_attr__( 'Hover color', 'davinciwoo' ),
    'section'     => 'blog-style',
    'default'     => adswth_option( 'btn_primary_color_hover' ),
    'output' => [
        [
            'element'  => [
                '.btn-blog.btn-primary:hover, .btn-blog.btn-primary:focus, .btn-blog.btn-primary:active',
                '.btn-blog.btn-primary:not(:disabled):not(.disabled):active:focus',
                '.btn-blog.btn-primary:not(:disabled):not(.disabled).active:focus',
                '.btn-blog.btn-primary.disabled',
                '.btn-blog.btn-primary:disabled'
            ],
            'property' => 'background-color',
        ],[
            'element'  => [
                '.btn-blog.btn-primary:hover, .btn-blog.btn-primary:focus, .btn-blog.btn-primary:active',
                '.btn-blog.btn-primary:not(:disabled):not(.disabled):active:focus',
                '.btn-blog.btn-primary:not(:disabled):not(.disabled).active:focus',
                '.btn-blog.btn-primary.disabled',
                '.btn-blog.btn-primary:disabled'
            ],
            'property' => 'border-color',
        ],

    ],
    'priority'    => 80,
    'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option', [
    'type'        => 'color',
    'settings'    => 'blog_btn_primary_text_color',
    'label'       => esc_attr__( 'Text color', 'davinciwoo' ),
    'section'     => 'blog-style',
    'default'     => adswth_option( 'btn_primary_text_color' ),
    'output' => [
        [
            'element'  => [
                '.btn-blog.btn-primary',
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
    'settings'    => 'blog_btn_primary_text_color_hover',
    'label'       => __( 'Text hover color', 'davinciwoo' ),
    'section'     => 'blog-style',
    'default'     => adswth_option( 'btn_primary_text_color_hover' ),
    'output' => [
        [
            'element'  => [
                '.btn-blog.btn-primary:hover, .btn-blog.btn-primary:focus, .btn-blog.btn-primary:active',
                '.btn-blog.btn-primary:not(:disabled):not(.disabled):active:focus',
                '.btn-blog.btn-primary:not(:disabled):not(.disabled).active:focus',
                '.btn-blog.btn-primary.disabled',
                '.btn-blog.btn-primary:disabled'
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
    'settings' => 'custom_title_blog_color_secondary_button',
    'section'  => 'blog-style',
    'priority' => 110,
    'default'  => '<div class="options-title-divider">' . __( 'Secondary button', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
    'type'        => 'color',
    'settings'    => 'blog_btn_secondary_color',
    'label'       => __( 'Color', 'davinciwoo' ),
    'section'     => 'blog-style',
    'default'     => adswth_option( 'btn_secondary_color' ),
    'output' => [
        [
            'element'  => [
                '.btn-blog.btn-secondary',
            ],
            'property' => 'background-color',
            'suffix'   => '!important'
        ],
        [
            'element'  => [
                '.btn-blog.btn-secondary',
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
    'settings'    => 'blog_btn_secondary_color_hover',
    'label'       => esc_attr__( 'Hover color', 'davinciwoo' ),
    'section'     => 'blog-style',
    'default'     => adswth_option( 'btn_secondary_color_hover' ),
    'output' => [
        [
            'element'  => [
                '.btn-blog.btn-secondary:hover', '.btn-blog.btn-secondary:focus', '.btn-blog.btn-secondary:active',
                '.btn-blog.btn-secondary:not(:disabled):not(.disabled):active:focus',
                '.btn-blog.btn-secondary:not(:disabled):not(.disabled).active:focus',
            ],
            'property' => 'background-color',
            'suffix'   => '!important'
        ],[
            'element'  => [
                '.btn-blog.btn-secondary:hover', '.btn-blog.btn-secondary:focus', '.btn-blog.btn-secondary:active',
                '.btn-blog.btn-secondary:not(:disabled):not(.disabled):active:focus',
                '.btn-blog.btn-secondary:not(:disabled):not(.disabled).active:focus',
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
    'settings'    => 'blog_btn_secondary_text_color',
    'label'       => esc_attr__( 'Text color', 'davinciwoo' ),
    'section'     => 'blog-style',
    'default'     => adswth_option( 'btn_secondary_text_color' ),
    'output' => [
        [
            'element'  => [
                '.btn-blog.btn-secondary',
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
    'settings'    => 'blog_btn_secondary_text_color_hover',
    'label'       => esc_attr__( 'Text hover color', 'davinciwoo' ),
    'section'     => 'blog-style',
    'default'     => adswth_option( 'btn_secondary_text_color_hover' ),
    'output' => [
        [
            'element'  => [
                '.btn-blog.btn-secondary:hover', '.btn-blog.btn-secondary:focus', '.btn-blog.btn-secondary:active',
                '.btn-blog.btn-secondary:not(:disabled):not(.disabled):active:focus',
                '.btn-blog.btn-secondary:not(:disabled):not(.disabled).active:focus',
            ],
            'property' => 'color',
            'suffix'   => '!important'
        ],

    ],
    'priority'    => 150,
    'transport'   => 'auto',
]);
