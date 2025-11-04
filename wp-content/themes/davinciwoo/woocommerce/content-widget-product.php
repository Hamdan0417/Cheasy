<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}
$use_average_rating = adswth_option( 'product_average_rating_use' );
$default_average_rating = $use_average_rating ? adswth_option( 'product_average_rating' ) : 0.1;

$rating_count = $product->get_rating_count();
$average_rating = ( $rating_count > 0 ) ? $product->get_average_rating() : $default_average_rating;

?>
<div class="product product-small">

	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>

	<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
        <div class="box-image">
            <div class="box-image-wrap">
                <div class="box-image-inner">
                    <?php echo wp_kses_post( $product->get_image() ); ?>
                </div>
            </div>
        </div>


		<span class="product-title"><?php echo esc_html( $product->get_name() ); ?></span>
	</a>

    <div class="woocommerce-product-rating">
        <?php echo wc_get_rating_html( $average_rating, $rating_count ); ?>
        <?php if( $rating_count > 0 ) { ?>
            <span class="count call-item">(<?php echo $rating_count; ?>)</span>
        <?php } //endif; ?>
    </div>


	<?php if ( $price_html = $product->get_price_html() ) : ?>
        <span class="price"><?php echo wp_kses_post( $price_html ); ?></span>
	<?php endif; ?>

	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>

</div>
