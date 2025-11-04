<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}
$use_average_rating = adswth_option( 'product_average_rating_use' );
$default_average_rating = $use_average_rating ? adswth_option( 'product_average_rating' ) : 0.1;

$rating_count  = $product->get_rating_count();
$review_count  = $product->get_review_count();
$rating_counts = $product->get_rating_counts();
$average       = ( $review_count > 0 ) ? $product->get_average_rating() : $default_average_rating;
$total_sales   = $product->get_total_sales();

$enjoyed_5 = isset( $rating_counts[5] ) ? intval( $rating_counts[5] ) : 0;
$enjoyed_4 = isset( $rating_counts[4] ) ? intval( $rating_counts[4] ) : 0;

$enjoyed   = ( intval( $rating_count ) > 0 ) ? round( ( $enjoyed_4 + $enjoyed_5 ) / $rating_count * 100, 1 ) : false; ?>
<?php if( ( adswth_option( 'product_page_rating_show' ) ) || adswth_option( 'product_page_share_show' ) ) { ?>
<div class="row align-items-center woocommerce-product-rating-wrap">

    <div class="col-auto mr-auto">
	    <?php if ( adswth_option( 'product_page_rating_show' ) ) { ?>
        <div class="woocommerce-product-rating">
            <?php echo wc_get_rating_html( $average, $rating_count ); ?>
            <?php if ( comments_open() && $review_count > 0 ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf( _n( '%s review', '%s reviews', $review_count, 'davinciwoo' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?></a><?php endif ?>
        </div>
	    <?php } //endif; ?>
        <?php if( ( $enjoyed && adswth_option( 'product_page_rating_details_show' ) ) || ( $total_sales && adswth_option( 'product_page_orders_count_show' ) ) ) { ?>
        <div class="woocommerce-product-rating-description">
            <?php if( $enjoyed && adswth_option( 'product_page_rating_details_show') ) {  echo '<span>' . $enjoyed . '%</span>&nbsp;' .__( 'of buyers enjoyed this product!', 'davinciwoo' ); } ?>
            <?php if( ( $enjoyed && adswth_option( 'product_page_rating_details_show' ) ) && ( $total_sales && adswth_option( 'product_page_orders_count_show' ) ) ) {  echo ' '; } ?>
            <?php if($total_sales && adswth_option( 'product_page_orders_count_show' ) ) {  echo  $total_sales . ' ' . __( 'orders', 'davinciwoo' ); } ?>
        </div>
        <?php } //endif; ?>
    </div>

	<?php if( adswth_option( 'product_page_share_show' ) ) { ?>
    <div class="col-auto ml-auto">
        <div class="sharePopup"><div class="share-btn"></div></div>
    </div>
	<?php } //endif; ?>
</div>
<?php } //endif; ?>