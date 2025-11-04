<?php

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 5 );

function adswth_before_woocommerce_cart_totals(){
	echo '<div class="col-xl-5 col-lg-6 order-2 col-md-8">';
}
add_action( 'woocommerce_cart_collaterals', 'adswth_before_woocommerce_cart_totals', 9 );

function adswth_after_woocommerce_cart_totals(){
	echo '</div>';
}
add_action( 'woocommerce_cart_collaterals', 'adswth_after_woocommerce_cart_totals', 11 );