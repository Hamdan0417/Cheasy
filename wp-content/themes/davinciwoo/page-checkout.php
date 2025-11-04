<?php
/*
Template name: WooCommerce - Checkout
*/

if( is_woocommerce_activated() ) {

	wc_get_template_part( 'checkout/layouts/checkout' );
}
