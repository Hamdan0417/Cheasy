<?php

/*************
 * Shop Panel
 *************/


\adswth\adsOptions::add_panel( 'woocommerce', [
	'title'    => __( 'Shop (WooCommerce)', 'davinciwoo' ),
    'priority' => 80,
] );

include_once( dirname( __FILE__ ).'/options-shop-product-settings.php' );
include_once( dirname( __FILE__ ).'/options-shop-product-page.php' );
include_once( dirname( __FILE__ ).'/options-shop-view.php' );
include_once( dirname( __FILE__ ).'/options-shop-product-catalog-mobile.php' );

