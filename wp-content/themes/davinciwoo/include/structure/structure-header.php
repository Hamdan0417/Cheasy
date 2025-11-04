<?php

function adswth_body_class( $classes ) {

	if( is_front_page() && is_woocommerce_activated() )
		$classes[] = 'woocommerce';

	return $classes;
}
add_filter( 'body_class', 'adswth_body_class' );