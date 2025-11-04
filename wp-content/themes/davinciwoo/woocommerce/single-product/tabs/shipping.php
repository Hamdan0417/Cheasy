<?php
/**
 * Shipping & Payment description tab
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo wp_unslash(adswth_option( 'product_page_shipping_content' ));
?>
