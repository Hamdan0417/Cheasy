<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

$qty_start = '<button type="button" value="-" class="minus button is-form"><i class="icon-minus"></i></button>';
$qty_end   = '<button type="button" value="+" class="plus button is-form"><i class="icon-plus"></i></button>';

if ( empty( $max_value ) ) {
	$max_value = 9999;
}

// In some cases we wish to display the quantity but not allow for it to be changed.
if ( $max_value && $min_value === $max_value ) {
    $is_readonly = true;
    $input_value = $min_value;
} else {
    $is_readonly = false;
}

	?>
	<div class="quantity buttons_added">
        <?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
		<?php echo $qty_start; ?>
		<label class="order-1" for="<?php echo esc_attr( $input_id ); ?>"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></label>
		<input
			type="text"
            <?php wp_readonly( $is_readonly ); ?>
			id="<?php echo esc_attr( $input_id ); ?>"
			class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
			step="<?php echo esc_attr( $step ); ?>"
			min="<?php echo esc_attr( $min_value ); ?>"
			max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
			name="<?php echo esc_attr( $input_name ); ?>"
			value="<?php echo esc_attr( $input_value ); ?>"
            aria-label="<?php esc_attr_e( 'Product quantity', 'woocommerce' ); ?>"
			size="4"
            placeholder="<?php echo esc_attr( $placeholder ); ?>"
			inputmode="<?php echo esc_attr( $inputmode ); ?>"
            onkeyup="this.value=this.value.replace(/[^\d]/,'')"/>
		<?php echo $qty_end; ?>
        <?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
	</div>
