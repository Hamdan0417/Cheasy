<?php

function adswth_woocommerce_breadcrumb_defaults( $args ){

	$args[  'delimiter' ]  = '<i class="icon-right-open"></i>';
	$args[ 'wrap_before' ] = '<nav class="adswth-breadcrumb">';

	return $args;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'adswth_woocommerce_breadcrumb_defaults',  10, 1 );

function adswth_add_percentage_to_sale_badge( $html, $post, $product ) {

	if( ! adswth_option( 'discount_show' ) || $product->is_type('grouped') )
		return '';

	if( $product->is_type('variable')){
		$percentages = array();

		// Get all variation prices
		$prices = $product->get_variation_prices();

		// Loop through variation prices
		foreach( $prices['price'] as $key => $price ){
			// Only on sale variations
			if( $prices['regular_price'][$key] !== $price ){
				// Calculate and set in the array the percentage for each variation on sale
				$percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
			}
		}
		// We keep the highest value
		$percentage = max($percentages) . '%';
	} else {
		$regular_price = (float) $product->get_regular_price();
		$sale_price    = (float) $product->get_sale_price();

		$percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
	}
	return '<div class="onsale"><span><strong>-' . $percentage . '</strong></span></div>';
}
add_filter( 'woocommerce_sale_flash', 'adswth_add_percentage_to_sale_badge', 20, 3 );

function adswth_you_save_sale_badge($product ) {

	if( ! adswth_option( 'discount_show' ) )
		return '';
    $you_save_class = "yousave_block";
    $percentage = false;
	if( $product->is_type('variable')){
		$percentages = array();

		// Get all variation prices
		$prices = $product->get_variation_prices();
		if(empty($prices['price']) || $prices['price'] == 0) return '';

		$min_sale_price = min($prices['sale_price']);
		$max_sale_price = max($prices['sale_price']);
		$min_regular_price = min($prices['regular_price']);
		$max_regular_price = max($prices['regular_price']);


		// Loop through variation prices
		foreach( $prices['price'] as $key => $price ){
			// Only on sale variations
			if( $prices['regular_price'][$key] !== $price ){
				// Calculate and set in the array the percentage for each variation on sale
				$percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
			}
		}

		// We keep the highest value
        if(!empty($percentages)):
		    $percentage = max($percentages) . '%';
        endif;
		if($min_sale_price != $max_sale_price){
            $difference = wc_price($min_regular_price - $min_sale_price ) . " – " . wc_price($max_regular_price - $max_sale_price );
            $you_save_class .= " yousave_block_hidden";
        } else {
            $difference = wc_price($min_regular_price - $min_sale_price);
        }
	} else {
		$regular_price = (float) $product->get_regular_price();
		$sale_price    = (float) $product->get_sale_price();
        if($sale_price):
            $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
            $difference = wc_price($regular_price - $sale_price);
        endif;
	}
    $you_save_text = __( 'You save', 'elgrecowoo' );
	if($percentage) {
        $return = '<div class="' . $you_save_class . '">'
            . $you_save_text .
            ' <span class="yousave_block_discount">' . $percentage . '</span> <span class="yousave_block_difference">(' . $difference . ')</span>
               </div>';
    } else {
        $return = '';
    }
	return $return;
}
add_filter( 'adswth_sale_badge', 'adswth_you_save_sale_badge', 20, 3 );

function adswth_woocommerce_product_categories_widget_args( $args ) {

	$args[ 'show_count' ] = adswth_option( 'menu_product_cat_show_count' );
    $args['walker'] = new adswth\walker\adsCategoriesMenu();

	return $args;
}
add_filter( 'woocommerce_product_categories_widget_args', 'adswth_woocommerce_product_categories_widget_args' , 99, 1);

function adswth_checkout_breadcrumb_class( $endpoint ){
	$classes = [];
	if( $endpoint == 'cart' && is_cart() ||
	    $endpoint == 'checkout' && is_checkout() && !is_wc_endpoint_url( 'order-received' ) ||
	    $endpoint == 'order-received' && is_wc_endpoint_url( 'order-received' ) ) {
		$classes[] = 'current';
	} else{
		$classes[] = 'hide-for-small';
	}
    if($endpoint == 'cart' && !adswth_option( 'use_shoppingcart' )){
        $classes[] = 'cart-bc';
    }

	return implode( ' ', $classes );
}

/**
 * Track product views.
 */
function adswth_wc_track_product_view() {
	if ( ! is_singular( 'product' ) || is_active_widget( false, false, 'woocommerce_recently_viewed_products', true ) ) {
		return;
	}

	global $post;

	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
		$viewed_products = array();
	} else {
		$viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
	}

	// Unset if already in viewed products list.
	$keys = array_flip( $viewed_products );

	if ( isset( $keys[ $post->ID ] ) ) {
		unset( $viewed_products[ $keys[ $post->ID ] ] );
	}

	$viewed_products[] = $post->ID;

	if ( count( $viewed_products ) > 15 ) {
		array_shift( $viewed_products );
	}

	// Store for session only.
	wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}

add_action( 'template_redirect', 'adswth_wc_track_product_view', 20 );

/**
 * Remove all of the hooks from an action.
 */
//add_action( 'wp_head', 'adswth_remove_action', 999 );
function adswth_remove_action(){
    remove_all_actions( 'woocommerce_after_add_to_cart_quantity' );
}

//add I recommend to product reviews
function adswth_add_i_recommend_to_reviews(){
    if(adswth_option('spp_show_i_recommend_badge')){
        $html = "<div class='i-recommend-this-product'><i class='icon-thumbs-up-alt'></i> " . __('Yes, I recommend this product', 'elgrecowoo') . "</div>";
        echo $html;
    }
}
add_action( 'woocommerce_review_after_comment_text', 'adswth_add_i_recommend_to_reviews' );

/**
 * Change related products count
 */
function adswth_related_products_limit() {
    global $product;

    $args['posts_per_page'] = 8;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'adswth_related_products_limit', 20 );

if ( ! function_exists( 'adswth_woocommerce_template_loop_product_thumbnail' ) ) {

    /**
     * Get the product thumbnail for the loop.
     */
    function adswth_woocommerce_template_loop_product_thumbnail() {
        $src = ADSW_THEME_LAZY_LOAD ? 'data-src' : 'src';
        $srcSet = adswth_option( 'performance_enable_lazyload' ) ? 'data-srcset' : 'srcset';
        $small_thumbnail_size = apply_filters( 'subcategory_archive_thumbnail_size', 'woocommerce_thumbnail' );
        $thumbnail_id = get_post_thumbnail_id();
        $image_src = wp_get_attachment_image_src( $thumbnail_id,'woocommerce_thumbnail' );
        $image_srcset = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $thumbnail_id, $small_thumbnail_size ) : false;
        $image_sizes  = function_exists( 'wp_get_attachment_image_sizes' ) ? wp_get_attachment_image_sizes( $thumbnail_id, $small_thumbnail_size ) : false;

        if(!empty($image_src)){ ?>
            <img
                <?php echo $src; ?>="<?php echo $image_src[0]?>"
                class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                <?php echo $srcSet?>="<?php echo $image_srcset?>"
                sizes="<?php echo $image_sizes?>"
            />
        <?php }
    }
}

add_filter('woocommerce_register_post_type_product', 'adswth_remove_shop_default_description');

function adswth_remove_shop_default_description($args){
    $args['description'] = '';
    return $args;
}