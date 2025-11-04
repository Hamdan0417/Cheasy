<?php

\adswth\adsOptions::add_section( 'type', [
	'title' => __( 'Typography', 'davinciwoo' ),
	'panel' => 'style',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'     => 'checkbox',
	'settings' => 'disable_fonts',
	'label'    => __( 'Disable google fonts. No fonts will be loaded from Google.', 'davinciwoo' ),
	'section'  => 'type',
	'default'  => 0,
] );

\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_type_headings',
	'section'  => 'type',
	'default'  => '<div class="options-title-divider">' . __( 'Headlines', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'        => 'typography',
	'settings'    => 'type_headings',
	'description' => __( 'This is the font for all H1, H2, H3, H5, H6 titles.', 'davinciwoo' ),
	'label'       => esc_attr__( 'Font', 'davinciwoo' ),
	'section'     => 'type',
	'default'     => [
		'font-family' => 'Open Sans',
	],
	'output'      => [
		[
			'element' => 'h1,h2,h3,h4,h5,h6',
		],
	],
] );


\adswth\adsOptions::add_field( '', [
	'type'     => 'custom',
	'settings' => 'custom_title_type_base',
	'section'  => 'type',
	'default'  => '<div class="options-title-divider">' . __( 'Base', 'davinciwoo' ) . '</div>',
] );

\adswth\adsOptions::add_field( 'option', [
	'type'     => 'typography',
	'settings' => 'type_texts',
	'label'    => esc_attr__( 'Base Text Font', 'davinciwoo' ),
	'section'  => 'type',
	'default'  => [
		'font-family' => 'Open Sans',
	],
	'output'      => [
		[
			'element' => 'body',
		],
	],
] );
\adswth\adsOptions::add_field( 'option', [
	'type'     => 'typography',
	'settings' => 'type_texts',
	'label'    => esc_attr__( 'Base Text Font', 'davinciwoo' ),
	'section'  => 'type',
	'default'  => [
		'font-family' => 'Open Sans',
	],
	'output'      => [
		[
			'element' => 'body',
		],
	],
] );