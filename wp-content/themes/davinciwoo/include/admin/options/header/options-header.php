<?php

\adswth\adsOptions::add_panel( 'header', [
	'title'       => __( 'Header', 'davinciwoo' ),
	'description' => __( 'Change Theme Header Options here.', 'davinciwoo' ),
    'priority'    => 50,
] );

include_once( dirname( __FILE__ ) . '/options-header-logo.php' );
include_once( dirname( __FILE__ ) . '/options-header-top.php' );
include_once( dirname( __FILE__ ) . '/options-header-account.php' );
include_once( dirname( __FILE__ ) . '/options-header-contact.php' );
include_once( dirname( __FILE__ ) . '/options-header-sticky.php' );