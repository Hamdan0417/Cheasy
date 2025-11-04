<?php
\adswth\adsOptions::add_section( 'blog_heading', [
    'title'    => __( 'Heading', 'davinciwoo' ),
    'panel'    => 'blog',
    'priority' => 60,
] );

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'text',
    'settings'    => 'blog_shop_this_story_heading',
    'label'       => __( 'Shop this story heading', 'davinciwoo' ),
    'section'     => 'blog_heading',
    'default'     => adswth_defaults( 'blog_shop_this_story_heading' ),
    'priority'    => 10,
    'transport'   => 'auto',
]);

\adswth\adsOptions::add_field( 'option',  [
    'type'        => 'text',
    'settings'    => 'blog_further_reading_heading',
    'label'       => __( 'Further reading heading', 'davinciwoo' ),
    'section'     => 'blog_heading',
    'default'     => adswth_defaults( 'blog_further_reading_heading' ),
    'priority'    => 20,
    'transport'   => 'auto',
]);