<?php

\adswth\adsOptions::add_panel( 'page_front', [
	'title'       => __( 'Front Page', 'davinciwoo' ),
	'description' => __( 'Change Front Page Options here.', 'davinciwoo' ),
    'priority'    => 70,
] );

include_once( dirname( __FILE__ ) . '/options-page-front-slider.php' );
include_once( dirname( __FILE__ ) . '/options-page-front-countdown.php' );
include_once( dirname( __FILE__ ) . '/options-page-front-features.php' );
include_once( dirname( __FILE__ ) . '/options-page-front-products.php' );
include_once( dirname( __FILE__ ) . '/options-page-front-promotion.php' );
include_once( dirname( __FILE__ ) . '/options-page-front-subscribe.php' );
