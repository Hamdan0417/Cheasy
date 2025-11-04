<?php
if( !function_exists('adswth_wc_get_gallery_image_html') ) {
    // Copied and modified from woocommerce plugin and wc_get_gallery_image_html helper function.
    function adswth_wc_get_gallery_image_html( $attachment_id, $main_image = false, $size = 'woocommerce_single' ) {

        $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
        $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
        $image_size        = apply_filters( 'woocommerce_gallery_image_size', $size );
        $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
        $thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
        $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
        $image             = wp_get_attachment_image( $attachment_id, $image_size, false, array(
            'title'                         => get_post_field( 'post_title', $attachment_id ),
            'data-caption'                  => get_post_field( 'post_excerpt', $attachment_id ),
            'src'                           => $full_src[0],
            'data-src'                      => $full_src[0],
            'data-large_image'              => $full_src[0],
            'data-large_image_width'        => $full_src[1],
            'data-large_image_height'       => $full_src[2],
            'class'                         => $main_image ? 'wp-post-image skip-lazy' : 'skip-lazy', // skip-lazy, blacklist for Jetpack's lazy load.
        ) );
        $image_wrapper_class = $main_image ? 'slide first' : 'slide';

        return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" class="woocommerce-product-gallery__image swiper-slide '.$image_wrapper_class.'"><span class="makezoom" data-href="' . esc_url( $full_src[0] ) . '">' . $image . '</span></div>';
    }
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );


if ( ! function_exists( 'adswth_buyer_protection' ) ) {

	/**
	 * Output the buyer protection.
	 */
	function adswth_buyer_protection() {
		wc_get_template( 'single-product/buyer-protection.php' );
	}
}
add_action( 'woocommerce_after_single_product_summary', 'adswth_buyer_protection', 10 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'adswth_single_product_data', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'adswth_single_product_data', 'woocommerce_upsell_display', 20 );

add_action( 'adswth_single_product_upsell', 'woocommerce_upsell_display', 10 );
add_action( 'adswth_single_product_upsell', 'woocommerce_output_related_products', 20 );

function adswth_product_tabs( $tabs ){

	global $product;

	unset( $tabs[ 'reviews' ] );

	if( ! adswth_option( 'product_page_product_details_show' ) || empty( $product->get_description() ) ){
		unset( $tabs[ 'description' ] );
	} else {
		$tabs['description']['title'] = __( 'Product details', 'davinciwoo' );
	}


	if( ! adswth_option( 'product_page_item_specifics_show' ) ){
		unset( $tabs[ 'additional_information' ] );
	} else {
		$tabs['additional_information']['title'] = __( 'Item specifics', 'davinciwoo' );
	}

	if( adswth_option( 'product_page_shipping_show' ) ) {

		$tabs['shipping'] = [
			'title'    => __( 'Shipping & Payment', 'davinciwoo' ),
			'priority' => 50,
			'callback' => 'adswth_shipping_and_free_returns'
		];
	}


	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'adswth_product_tabs', 99 );

if ( ! function_exists( 'adswth_shipping_and_free_returns' ) ) {

	/**
	 * Output the attributes tab content.
	 */
	function adswth_shipping_and_free_returns() {
		wc_get_template( 'single-product/tabs/shipping.php' );
	}
}


if ( ! function_exists( 'adswth_recently_viewed_display' ) ) {

	/**
	 * Output the attributes tab content.
	 */
	function adswth_recently_viewed_display() {
		wc_get_template( 'single-product/recently.php' );
	}
}
add_action( 'adswth_single_product_footer', 'adswth_recently_viewed_display', 10 );

function adswth_product_comments_template() {
	comments_template();
}
add_action( 'adswth_single_product_data', 'adswth_product_comments_template', 30);

function adswth_comment_form_fields ( $comment_fields ){

	$item = $comment_fields[ 'comment' ];
	unset($comment_fields[ 'comment' ]);
	array_push($comment_fields, $item);

	return $comment_fields;
}
//add_filter( 'comment_form_fields', 'adswth_comment_form_fields',  10 );

remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );


function adswth_woocommerce_get_script_data(  $params, $handle ){

	if( $handle == 'wc-single-product' ){

		$params[ 'i18n_required_reviews_author_error' ] = adswth_option( 'product_page_reviews_author_error' );
		$params[ 'i18n_required_reviews_email_error' ] = adswth_option( 'product_page_reviews_email_error' );
		$params[ 'i18n_required_reviews_text_error' ] = adswth_option( 'product_page_reviews_text_error' );

		if( adswth_option( 'product_page_reviews_terms_conditions_show' ) ) {
			$params['i18n_required_reviews_terms_conditions_error'] = adswth_option( 'product_page_reviews_terms_conditions_error' );
		}
	}
	return $params;
}
add_filter( 'woocommerce_get_script_data', 'adswth_woocommerce_get_script_data', 10, 2);
