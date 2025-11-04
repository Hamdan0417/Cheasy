<?php
/**
 * YITH wishlist integration
 */

if ( ! function_exists( 'adswth_wishlist_integrations_scripts' ) ) {
	/**
	 * Enqueues wishlist integrations scripts
	 */
	function adswth_wishlist_integrations_scripts() {
		global $integrations_uri;

		wp_dequeue_style( 'yith-wcwl-main' );
		wp_deregister_style( 'yith-wcwl-main' );

		wp_dequeue_style( 'yith_wcas_frontend' );
		wp_deregister_style( 'yith_wcas_frontend' );

        wp_dequeue_style( 'jquery-yith-wcwl' );
        wp_deregister_style( 'jquery-yith-wcwl' );

        //wp_enqueue_script( 'davinciwoo-yith-wcwl',  ADSW_THEME_URL . '/include/integrations/wc-yith-wishlist/wishlist' . ADSW_THEME_MIN . '.js', [ 'jquery' ], ADSW_THEME_VERSION, true );
		wp_enqueue_script( 'davinciwoo-woocommerce-wishlist',  ADSW_THEME_URL . '/include/integrations/wc-yith-wishlist/yith-wishlist' . ADSW_THEME_MIN . '.js', [ 'jquery', 'davinciwoo-js' ], ADSW_THEME_VERSION, true );
		wp_enqueue_style( 'davinciwoo-woocommerce-wishlist', ADSW_THEME_URL . '/include/integrations/wc-yith-wishlist/yith-wishlist' . ADSW_THEME_MIN . '.css', [ 'davinciwoo-css-main', 'davinciwoo-css-color-scheme' ], ADSW_THEME_VERSION, 'all' );
	}
}
add_action( 'wp_enqueue_scripts', 'adswth_wishlist_integrations_scripts' );

if ( ! function_exists( 'adswth_product_wishlist_button' ) ) {
	/**
	 * Add wishlist Button to Product Image
	 */
	function adswth_product_wishlist_button() {
		 echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	}
}
add_action( 'adswth_product_image_tools_top', 'adswth_product_wishlist_button', 2 );
add_action( 'adswth_product_box_tools_top', 'adswth_product_wishlist_button', 2 );

if ( ! function_exists( 'adswth_header_wishlist' ) ) {
	/**
	 * Header Wishlist element
	 */
	function adswth_header_wishlist( $elements ) { ?>
		<a href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>" class="wishlist-link" data-count="<?php echo YITH_WCWL()->count_products() ; ?>" title="<?php _e( 'Wishlist', 'davinciwoo' ); ?>">
			<?php
			if(YITH_WCWL()->count_products() > 0){
				echo adswth_get_icon('heart');
			} else {
				echo adswth_get_icon('heart-empty');
			} ?>
		</a>
	<?php }
}
add_action( 'adswth_main_cart', 'adswth_header_wishlist', 10 );

if ( ! function_exists( 'adswth_update_wishlist_count' ) ) {
	/**
	 * Update Wishlist Count
	 */
	function adswth_update_wishlist_count() {
		wp_send_json( YITH_WCWL()->count_products() );
	}
}
add_action( 'wp_ajax_adswth_update_wishlist_count', 'adswth_update_wishlist_count' );
add_action( 'wp_ajax_nopriv_adswth_update_wishlist_count', 'adswth_update_wishlist_count' );


if ( ! function_exists( 'adswth_mobile_wishlist_link' ) ) {
	/**
	 * add wishlist link to mobile menu
	 */
	function adswth_mobile_wishlist_link() {
		echo '<li><a href="'. YITH_WCWL()->get_wishlist_url() . '"> ' . __('Wishlist', 'davinciwoo') . '</a></li>';
	}
}
add_action( 'adswth_mobile_menu_li', 'adswth_mobile_wishlist_link' );

