<?php

function adswth_logo_name_customizer( $wp_customize ) {
	global $transport;
	$wp_customize->get_setting('blogname')->transport = $transport;
	$wp_customize->get_setting('blogdescription')->transport = $transport;
}
add_action( 'customize_register', 'adswth_logo_name_customizer' );

\adswth\adsOptions::add_section( 'title_tagline', [
	'title'       => __( 'Logo & Site Identity', 'davinciwoo' ),
	'panel'       => 'header',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'image',
	'settings'    => 'site_logo',
	'label'       => __( 'Logo image', 'davinciwoo' ),
	'description' => esc_attr__( 'Recommended size: 250*65px', 'davinciwoo' ),
	'section'     => 'title_tagline',
	'default'     => adswth_defaults( 'site_logo' ),
    'choices'     => [
        'save_as' => 'array',
    ],
	'transport'   => $transport,
] );

\adswth\adsOptions::add_field( 'option',  [
	'type'        => 'slider',
	'settings'    => 'logo_width',
	'label'       => __( 'Logo container width', 'davinciwoo' ),
	'section'     => 'title_tagline',
	'default'     => adswth_defaults( 'logo_width' ),
	'choices'     => [
		'min'  => 30,
		'max'  => 320,
		'step' => 1
    ],
	'output' => [
		[
			'element'  => '.header-main .site-logo-wrap',
			'property' => 'width',
			'units' => 'px'
		]
	],
    'transport'  => 'auto',
]);

function adswth_refresh_header_main( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	// logo image
	$wp_customize->selective_refresh->add_partial( 'site-logo', [
		'selector' => '.site-logo-wrap',
		'container_inclusive' => true,
		'settings' => [ 'site_logo' ],
		'render_callback' => function() {
			return get_template_part( 'template-parts/header/partials/element-main', 'logo' );
		},
	] );

}
add_action( 'customize_register', 'adswth_refresh_header_main' );