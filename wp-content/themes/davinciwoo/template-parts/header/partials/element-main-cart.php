<?php
if( is_woocommerce_activated() ){
	/**
	 * adswth_main_cart hook
     *
	 * @hooked adswth_header_wishlist - 10
	 */
	do_action( 'adswth_main_cart' );?>

<?php } else { ?>
	<?php adswth_header_element_error( 'woocommerce' ); ?>
<?php } //endif; ?>
