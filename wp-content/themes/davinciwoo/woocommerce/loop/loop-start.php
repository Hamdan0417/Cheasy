<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$class_view = ' row row-gutters-7_5 justify-content-start';

if( is_product() || is_cart() || is_checkout() || is_checkout_pay_page() || is_single() )
	$class_view = '';

$columns = esc_attr( wc_get_loop_prop( 'columns' ) );
?>
<div class="products xl-columns-<?php echo $columns; ?> lg-columns-<?php echo $columns < 4 ? $columns : 4; ?> md-columns-<?php echo $columns < 3 ? $columns : 3; ?> <?php echo $class_view; ?>">
