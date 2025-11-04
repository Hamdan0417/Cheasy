<?php
/**
 * Loop Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}
$use_average_rating = adswth_option( 'product_average_rating_use' );
$default_average_rating = $use_average_rating ? adswth_option( 'product_average_rating' ) : 0.1;

$rating_count = $product->get_rating_count();

$average_rating = $product->get_average_rating();

if( $rating_count == 0 ){

    $type = $product->get_type();

    if( $type == 'variation' ){
        $parent = wc_get_product( $product->get_parent_id() );
        $rating_count = $parent->get_rating_count();
        $average_rating = $parent->get_average_rating();
    }
}
$average_rating = ( $rating_count > 0 ) ? $product->get_average_rating() : $default_average_rating;
?>

	<div class="woocommerce-product-rating">
		<?php echo wc_get_rating_html( $average_rating, $rating_count ); ?>
		<?php if($rating_count > 0 ) { ?>
		<span class="count call-item">(<?php echo $rating_count; ?>)</span>
		<?php } //endif; ?>
	</div>