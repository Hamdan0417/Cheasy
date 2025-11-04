<?php
/**
 * User: Denis Zharov
 * Date: 17.09.2018
 * Time: 14:20
 */

if( ! function_exists( 'adswth_defaults' ) ){
	function adswth_defaults( $option ) {
		$foo = [
			//Colors
			'template_color' => '#6b4c90',
			'link_color' => '#967bb6',
			'link_hover_color' => '#6b4c90',

			'btn_primary_color' => '#967bb6',
			'btn_primary_color_hover' => '#6b4c90',
			'btn_primary_text_color' => '#FFFFFF',
			'btn_primary_text_color_hover' => '#FFFFFF',

			'btn_secondary_color' => '#444444',
			'btn_secondary_color_hover' => '#222222',
			'btn_secondary_text_color' => '#FFFFFF',
			'btn_secondary_text_color_hover' => '#FFFFFF',

            'btn_cart_color' => '#48cccd',
            'btn_cart_color_hover' => '#22bdbd',


			//Header
			'header_top_text_color' => '#f0eaf4',
			'header_top_text_color_hover' => '#FFFFFF',
			'header_tip_show' => 1,
            'header_tip_icon_custom' => 0,
			'header_tip_text' => __( 'Free worldwide shipping', 'davinciwoo' ),

            'header_account_show' => true,
			'header_account_register' => false,

			'header_currency_switcher_show' => 1,

			'site_logo' => ADSW_THEME_URL . '/assets/images/logo.svg',
			'logo_width' => 265,
			'header_call_to_action' => __( 'Got a question? Call us!', 'davinciwoo' ),
			'header_phone' => '(800) 888-888',

            'header_sticky_show' => false,

			//Menus
			'menu_product_cat_show_count' => true,

			//Front Page Slider Area
			'slider_menu_show' => 1,
			'slider_layout' => 1,
			'main_banner' => [
				[
					'slide_image' => ADSW_THEME_URL . '/assets/images/defaults/slider/slider_default_1.jpg',
					'slide_image_xs'  => ADSW_THEME_URL . '/assets/images/defaults/slider/slider_default_1_xs.jpg',
					'slide_view_type' => 'default',
					'slide_url' => '',
					'slide_title' => __( "Stylish, fresh, beautiful", 'davinciwoo' ),
					'slide_title_color' => '#FFFFFF',
                    'slide_title_font_size' => '22',
					'slide_text' => 'Kitchen essentials to make your everyday life unique',
					'slide_text_color' => '#FFFFFF',
                    'slide_text_font_size' => '14',
					'main_button_text' => esc_html__( 'Shop Now', 'davinciwoo' ),
					'main_button_url' => '/shop/',
					'additional_button_type' => 'video',
					'additional_button_text' => esc_html__( 'View Video', 'davinciwoo' ),
					'additional_button_url'  => 'https://www.youtube.com/watch?v=rsbZbmMk3BY',
					'slide_overlay_color' => 'rgba(0, 0, 0, 0.6)',
				],
				[
					'slide_image' => ADSW_THEME_URL . '/assets/images/defaults/slider/slider_default_2.jpg',
					'slide_image_xs'  => ADSW_THEME_URL . '/assets/images/defaults/slider/slider_default_2_xs.jpg',
					'slide_view_type' => 'default',
					'slide_url' => '',
					'slide_title' => __( "We're in the mood for modern", 'davinciwoo' ),
					'slide_title_color' => '#FFFFFF',
                    'slide_title_font_size' => '22',
					'slide_text' => 'Discover our all-time favorites',
					'slide_text_color' => '#FFFFFF',
                    'slide_text_font_size' => '14',
					'main_button_text' => esc_html__( 'Shop Now', 'davinciwoo' ),
					'main_button_url' => '/shop/',
					'additional_button_type' => 'none',
					'additional_button_text' => '',
					'additional_button_url'  => '',
					'slide_overlay_color' => 'rgba(0, 0, 0, 0.6)',
				],
				[
					'slide_image' => ADSW_THEME_URL . '/assets/images/defaults/slider/slider_default_3.jpg',
					'slide_image_xs'  => ADSW_THEME_URL . '/assets/images/defaults/slider/slider_default_3_xs.jpg',
					'slide_view_type' => 'default',
					'slide_url' => '',
					'slide_title' => __( "Bright ideas for your kitchen", 'davinciwoo' ),
					'slide_title_color' => '#FFFFFF',
                    'slide_title_font_size' => '22',
					'slide_text' => 'Introducing an exclusive collection of iconic dinnerware',
					'slide_text_color' => '#FFFFFF',
                    'slide_text_font_size' => '14',
					'main_button_text' => esc_html__( 'Shop Now', 'davinciwoo' ),
					'main_button_url' => '/shop/',
					'additional_button_type' => 'none',
					'additional_button_text' => '',
					'additional_button_url'  => '',
					'slide_overlay_color' => 'rgba(0, 0, 0, 0.6)',
				],
			],
			'main_banner_autoplay' => 1,
			'main_banner_autoplay_slide_delay' => 10,

			'additional_banner_1_image' => ADSW_THEME_URL . '/assets/images/defaults/slider/slider_default_3.jpg',
			'additional_banner_1_text' => esc_attr__( 'Choose from 100+ Harry Potter related items - high quality and best prices ever!', 'davinciwoo' ),
			'additional_banner_1_text_color' => '#FFFFFF',
			'additional_banner_1_link' => home_url( '/shop' ),
			'additional_banner_1_overlay_color' => 'rgba(0, 0, 0, 0.6)',
			'additional_banner_2_image' => ADSW_THEME_URL . '/assets/images/defaults/slider/slider_default_3.jpg',
			'additional_banner_2_text' => esc_attr__( 'Choose from 100+ Harry Potter related items - high quality and best prices ever!', 'davinciwoo' ),
			'additional_banner_2_text_color' => '#FFFFFF',
			'additional_banner_2_link' => home_url( '/shop' ),
			'additional_banner_2_overlay_color' => 'rgba(0, 0, 0, 0.6)',

			//Front Page Countdown Block
			'countdown_block_show' => 1,
			'countdown_text' => __( 'Super Sale up to', 'davinciwoo' ) . ' <span>' . esc_attr__( '80&#37;', 'davinciwoo') . '</span> ' . __( 'off all items!' , 'davinciwoo' ) .
			                    ' <br class="d-none d-lg-block d-xl-none"><span>' .__( 'limited time offer', 'davinciwoo' ) . '</span>',
			'countdown_text_discount_color' => '#48cccd',
			'countdown_background_color' => '#FFFFFF',
			'countdown_show' => 1,
			'countdown_type' => 0,

			//Front Page Features
			'features_block_show' => 1,
			'features_list' => [
				[
					'feature_image' => ADSW_THEME_URL . '/assets/images/features/feature_cash.svg',
					'feature_title' => '<strong>' . __( '700+', 'davinciwoo' ) . '</strong> ' . __( 'Clients love us!', 'davinciwoo' ),
					'feature_text'  => esc_attr__( 'We offer best service and great prices on high quality products', 'davinciwoo' ),
				],
				[
					'feature_image' => ADSW_THEME_URL . '/assets/images/features/feature_delivery.svg',
					'feature_title' => __( 'Shipping to', 'davinciwoo' ) . ' <strong>' . __( '185', 'davinciwoo' ) . '</strong> ' . __( 'countries', 'davinciwoo' ),
					'feature_text'  => esc_attr__( 'Our store operates worldwide and you can enjoy free delivery of all orders', 'davinciwoo' ),
				],
				[
					'feature_image' => ADSW_THEME_URL . '/assets/images/features/feature_credit_card.svg',
					'feature_title' => '<strong>' . __( '100%', 'davinciwoo' ) . '</strong> ' . __( 'Safe payment', 'davinciwoo' ),
					'feature_text'  => esc_attr__( 'Buy with confidence using the world’s most popular and secure payment methods', 'davinciwoo' ),
				],
				[
					'feature_image' => ADSW_THEME_URL . '/assets/images/features/feature_shield.svg',
					'feature_title' => '<strong>' . __( '2000+', 'davinciwoo' ) . '</strong> ' . __( 'Successful deliveries', 'davinciwoo' ),
					'feature_text'  => esc_attr__( 'Our Buyer Protection covers your purchase from click to delivery', 'davinciwoo' ),
				],
			],
			'feature_title_color' => '#444444',
			'feature_title_bold_color' => '#444444',
			'feature_text_color' => '#444444',

			//Front Page Products
			'page_front_products_block_show' => 1,
			'page_front_products_sorting'     => [
				'top_selling',
				'onsale',
				'new_arrivals',
				'recommended'
			],

			//Front Page Products (Top selling)
			'products_top_selling_title' => __( 'Top Selling Products', 'davinciwoo' ),
			'products_top_selling_scheme' => 'masonry',
			'products_top_selling_count' => 4,
			'products_top_selling_volume' => 4,
			//Front Page Products (On Sale)
			'products_onsale_title' => __( 'On Sale', 'davinciwoo' ),
			'products_onsale_scheme' => 'masonry',
			'products_onsale_count' => 4,
			'products_onsale_volume' => 4,
			//Front Page Products (New Arrivals)
			'products_new_arrivals_title' => __( 'New Arrivals', 'davinciwoo' ),
			'products_new_arrivals_scheme' => 'masonry',
			'products_new_arrivals_count' => 4,
			'products_new_arrivals_volume' => 4,
			//Front Page Products (We Recommend)
			'products_recommended_title' => __( 'We Recommend', 'davinciwoo' ),
			'products_recommended_scheme' => 'masonry',
			'products_recommended_count' => 4,
			'products_recommended_volume' => 4,

			//Front Page Promotion
			'front_page_sidebar_title' => __( 'JOIN US ON SOCIAL MEDIA', 'davinciwoo' ),

			//Front Page Subscribe
			'subscribe_block_show' => 0,
			'subscribe_code' => adswth_get_template_field( 'subscribe-form-default' ),
			'subscribe_background_color' => '#F1F1F1',

			//Product Settings
			'product_average_rating_use' => 1,
			'product_average_rating' => 4.5,
			'stars_primary_color' => '#FFC131',
			'stars_secondary_color' => '#D0D0D0',
			'discount_show' => 1,
			'discount_color' => '#FFFFFF',
			'price_color' => '#565656',

			//Product Page
			'product_layout' => '', //TODO добавить в настройки кастомизации
			'product_gallery_woocommerce' => false,
			'product_image_style' => 'vertical',
			'product_image_thumbnails_columns' => 5,
			'product_image_thumbnails_position' => 'left',

			'product_page_rating_show' => 1,
			'product_page_rating_details_show' => 1,
			'product_page_orders_count_show' => 1,
			'product_page_share_show' => 1,
            'add_to_cart_button_sticky' => 1,

			'product_page_meta_sku_show' => 1,
			'product_page_meta_category_show' => 1,
			'product_page_meta_tag_show' => 1,

			'product_page_buyer_protection_show' => 1,

			'product_page_product_details_show' => 1,
			'product_page_item_specifics_show' => 1,
			'product_page_shipping_show' => 1,
			'product_page_shipping_content' => adswth_get_template_field( 'product-page-default-shipping-content' ),

			'product_page_reviews_author_error' => __('Field "Name" is required', 'davinciwoo' ),
			'product_page_reviews_email_error' => __('Field "Email" is required', 'davinciwoo' ),
			'product_page_reviews_text_error' => __('Field "Your review" is required', 'davinciwoo' ),
			'product_page_reviews_terms_conditions_show' => 0,
			'product_page_reviews_terms_conditions_text' => __( 'I have read the', 'davinciwoo' ) . ' <a target="_blank" href="' . home_url() . '/terms-and-conditions/">' . __( 'Terms & Conditions', 'davinciwoo' ) . '</a>',
			'product_page_reviews_terms_conditions_error' => __( 'Please accept Terms & Conditions by checking the box', 'davinciwoo' ),
            'product_page_recommendation_show' => 1,
            'product_page_related_show' => 1,
            'product_page_recently_show' => 1,

            'woo_product_cat_mob' => '1',

			//Woocommerce cart
			'use_minicart' => 1,
			'use_shoppingcart' => 1,
			'show_side_shoppingcart_after_product_add' => 1,

			//Footer
			'footer_1_show' => 1,
			'footer_1_columns' => '5',
			'footer_2_show' => 1,
			'footer_2_columns' => '2',
			'footer_background_color' => '#444444',
			'footer_divider_color' => '#F8F8F8',
			'footer_widget_title_color' => '#FFFFFF',
			'footer_widget_text_color' => '#999999',
			'footer_widget_link_color' => '#999999',
			'footer_widget_link_hover_color' => '#FFFFFF',
			'footer_absolute_show' => 1,
			'footer_absolute_text_primary' => __( 'Copyright', 'davinciwoo' ) . ' ' . date('Y') . '. ' . __( 'All Rights Reserved', 'davinciwoo' ),
			'footer_absolute_text_primary_color' => '#999999',
			'footer_absolute_text_secondary' => adswth_get_site_domain(),
			'footer_absolute_text_secondary_color' => '#FFFFFF',
			'footer_absolute_background_color' => '#242424',

			//Back to top button
			'back_to_top_show' => 1,
			'back_to_top_position' => 'right',
			'back_to_top_icon_hover_color' => '#FFFFFF',
			'back_to_top_background_color' => '#FFFFFF',

			'back_to_top_border_radius' => 3,
			'back_to_top_mobile' => 0,
			'back_to_top_icon_color' => '#9B9B9B',
			'back_to_top_background_hover_color' => '#9B9B9B',
			'back_to_top_border_color' => '#9B9B9B',
			'back_to_top_border_hover_color' => '#9B9B9B',


			//404
			'404_background_image' => ADSW_THEME_URL . '/assets/images/defaults/404/404.jpg',
			'404_text' => __( "We can't seem to find the page you're looking for.<br />Here are some helpful links instead:", 'davinciwoo' ),
			'404_btn_text_1'       => __( 'Go Back Home', 'davinciwoo'),
			'404_btn_link_1'       => home_url('/') . 'shop',
			'404_btn_text_2'       => __( 'Contact Us', 'davinciwoo'),
			'404_btn_link_2'       => home_url('/') . 'contact-us',

            'additional_header_scripts' => '',
            'additional_footer_scripts' => '',


            //Blog
            'blog_header_view' => 0,
            'blog_logo_width' => 251,
            'blog_back_text' => __( 'Go Back to Shop', 'davinciwoo' ),
            'blog_back_link' => home_url( '/' ),
            'blog_banner_main' => ADSW_THEME_URL . '/blog/assets/images/blog_banner_main.jpg',
            'blog_banner_main_link' => home_url( '/' ),
            'blog_banner_single' => ADSW_THEME_URL . '/blog/assets/images/blog_banner_single.jpg',
            'blog_banner_single_link' => home_url( '/' ),
            'blog_subscribe_block_show' => 0,
            'blog_subscribe_code' => adswth_blog_get_template_field( 'subscribe-form-default' ),
            'blog_subscribe_background_color' => '#F1F1F1',

            'blog_footer_view' => 0,
            'blog_footer_absolute_text_primary' => __( 'Copyright', 'davinciwoo' ) . ' ' . date('Y') . '. ' . __( 'All Rights Reserved', 'davinciwoo' ),
            'blog_footer_absolute_text_primary_color' => '#999999',
            'blog_footer_absolute_text_secondary' => adswth_get_site_domain(),
            'blog_footer_absolute_text_secondary_color' => '#FFFFFF',
            'blog_footer_absolute_background_color' => '#242424',

            'blog_shop_this_story_heading' => __('Shop this story', 'davinciwoo'),
            'blog_further_reading_heading' => __('Further reading', 'davinciwoo'),


		];
		// Return default option if not empty
		return ( ! empty( $foo[ $option ] ) ) ? $foo[ $option ] : null;
	}
}
