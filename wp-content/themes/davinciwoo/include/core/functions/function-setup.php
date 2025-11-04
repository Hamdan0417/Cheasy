<?php
/**
 * User: Denis Zharov
 * Date: 17.09.2018
 * Time: 14:20
 */

if ( ! isset( $content_width ) ) $content_width = 1020; /* pixels */

function adswth_setup() {

	/* add woocommerce support */
	add_theme_support( 'woocommerce', apply_filters( 'adswth_woocommerce_args', [
		'single_image_width'    => 640,
		'thumbnail_image_width' => 350,
	] ) );

	/* add title tag support */
	add_theme_support( 'title-tag' );

	/* Add default posts and comments RSS feed links to head */
	//add_theme_support( 'automatic-feed-links' );

	/* Add excerpt to pages */
	add_post_type_support( 'page', 'excerpt' );

	/* Add support for post thumbnails */
	add_theme_support( 'post-thumbnails' );

	/* Add support for Selective Widget refresh */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/** Add sensei support */
	add_theme_support( 'sensei' );

	/* Add support for HTML5 */
	add_theme_support( 'html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'widgets',
	] );

	/*  Registrer menus. */
	register_nav_menus( [
		'top_menu'    => __( 'Top Menu','davinciwoo' ),
		'slider_menu' => __( 'Slider Menu', 'davinciwoo' ),
		'mobile_menu'      => __( 'Mobile Menu', 'davinciwoo' ),
	] );

	/*  Enable support for Post Formats */
	add_theme_support( 'post-formats', array( 'video' ) );
}
add_action( 'after_setup_theme', 'adswth_setup' );

function adswth_setup_options( $old_name ) {
    update_option( 'woocommerce_thumbnail_cropping', '1:1' );
}
add_action('after_switch_theme', 'adswth_setup_options');

add_action( 'after_setup_theme', 'adswth_remove_theme_support', 100 );

function adswth_remove_theme_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}

function adswth_widgets_init() {

	register_sidebar( [
		'name'          => __( 'Front Page Sidebar', 'davinciwoo' ),
		'id'            => 'front-page-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s col-xl-12 col-md-auto">',
		'after_widget'  => '</div>',
		'before_title'  =>'<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	] );

	register_sidebar( [
		'name'          => __( 'Footer 1', 'davinciwoo' ),
		'id'            => 'sidebar-footer-1',
		'before_widget' => '<div class="col py-md-3 widget-wrap"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	] );

	register_sidebar( [
		'name'          => __( 'Footer 2', 'davinciwoo' ),
		'id'            => 'sidebar-footer-2',
		'before_widget' => '<div class="col-12 py-xl-3 col-md widget-wrap"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	] );

	register_sidebar( [
		'name'          => __( 'Shop', 'davinciwoo' ),
		'id'            => 'woocommece-shop-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s mb-3">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	] );
	register_sidebar( [
		'name'          => __( 'Mobile menu sidebar', 'davinciwoo' ),
		'id'            => 'mobile-menu-sidebar',
		'description'   => __( 'Mobile menu social media icons by ADS Social Tools', 'davinciwoo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s mt-2">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	] );
}
add_action( 'widgets_init', 'adswth_widgets_init' );

function adswth_scripts() {

	/*
	 * Enqueue styles
	 */
	wp_enqueue_style( 'davinciwoo-css-icons', ADSW_THEME_URL .'/assets/icons/css/davinciwoo-icons' . ADSW_THEME_MIN . '.css', [], ADSW_THEME_VERSION, 'all' );
	wp_enqueue_style( 'davinciwoo-css-bootstrap', ADSW_THEME_URL .'/assets/css/front/bootstrap' . ADSW_THEME_MIN . '.css', [], '4.1.3', 'all' );
	wp_enqueue_style( 'davinciwoo-css-bootstrap-select', ADSW_THEME_URL .'/assets/css/front/bootstrap-select' . ADSW_THEME_MIN . '.css', [ 'davinciwoo-css-bootstrap' ], '1.13.2', 'all' );
	wp_enqueue_style( 'davinciwoo-css-lity',  ADSW_THEME_URL .'/assets/css/front/lity.min.css', [], '2.3.1', 'all' );
    wp_enqueue_script( 'ttlazy-js', ADSW_THEME_URL . '/assets/js/front/ttlazy.min.js', [ 'jquery' ] , ADSW_THEME_VERSION, true );
    wp_enqueue_style( 'davinciwoo-css-swiper', ADSW_THEME_URL .'/assets/css/front/swiper-bundle.min.css', [], '6.3.2', 'all' );
	wp_enqueue_style( 'davinciwoo-css-flickity', ADSW_THEME_URL .'/assets/css/front/flickity.min.css', [], '2.1.2', 'all' );
	wp_enqueue_style( 'davinciwoo-css-search-product', ADSW_THEME_URL .'/assets/css/front/search-product' . ADSW_THEME_MIN . '.css', [], ADSW_THEME_VERSION, 'all' );

    wp_register_style( 'davinciwoo-css-shop', ADSW_THEME_URL .'/assets/css/davinciwoo-shop' . ADSW_THEME_MIN . '.css', ['davinciwoo-css-main'], ADSW_THEME_VERSION, 'all' );

	if( is_woocommerce_activated() ){
		if( is_product() && ! adswth_option( 'product_gallery_woocommerce') ){

			wp_dequeue_style( 'woocommerce-layout' );
		}
		wp_dequeue_style( 'woocommerce-smallscreen' );
		wp_enqueue_style( 'davinciwoo-css-shop' );
        wp_enqueue_script( 'davinciwoo-theme-zoom', ADSW_THEME_URL .'/assets/js/front/jquery.zoom.min.js', [ 'jquery' ], '1.7.21', true );

	}
	wp_enqueue_style( 'davinciwoo-css-font', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700', [], ADSW_THEME_VERSION, 'all' );
	wp_enqueue_style( 'davinciwoo-css-main', ADSW_THEME_URL .'/assets/css/davinciwoo' . ADSW_THEME_MIN . '.css', ['davinciwoo-css-icons','davinciwoo-css-bootstrap', 'davinciwoo-css-bootstrap-select', 'davinciwoo-css-lity', 'davinciwoo-css-flickity'], ADSW_THEME_VERSION, 'all' );
	wp_enqueue_style( 'davinciwoo-css-color-scheme', ADSW_THEME_URL .'/assets/css/front/color-scheme/default' . ADSW_THEME_MIN . '.css', [ 'davinciwoo-css-main' ], ADSW_THEME_VERSION, 'all' );

	if( is_singular() ) {
		wp_enqueue_style( 'adswth-css-social-icons', ADSW_THEME_URL . '/assets/icons/css/social-icons' . ADSW_THEME_MIN . '.css', [], ADSW_THEME_VERSION, 'all' );
	}

	wp_enqueue_style( 'davinciwoo-css-xl', ADSW_THEME_URL .'/assets/css/davinciwoo-xl' . ADSW_THEME_MIN . '.css', [ 'davinciwoo-css-main', 'davinciwoo-css-shop' ], ADSW_THEME_VERSION, '(min-width: 1290px)' );
	wp_enqueue_style( 'davinciwoo-css-lg', ADSW_THEME_URL .'/assets/css/davinciwoo-lg' . ADSW_THEME_MIN . '.css', [ 'davinciwoo-css-main', 'davinciwoo-css-shop' ], ADSW_THEME_VERSION, '(min-width: 992px) and (max-width: 1289px)' );
	wp_enqueue_style( 'davinciwoo-css-md', ADSW_THEME_URL .'/assets/css/davinciwoo-md' . ADSW_THEME_MIN . '.css', [ 'davinciwoo-css-main', 'davinciwoo-css-shop' ], ADSW_THEME_VERSION, '(min-width: 768px) and (max-width: 991px)' );
	wp_enqueue_style( 'davinciwoo-css-sm', ADSW_THEME_URL .'/assets/css/davinciwoo-sm' . ADSW_THEME_MIN . '.css', [ 'davinciwoo-css-main', 'davinciwoo-css-shop' ], ADSW_THEME_VERSION, '(min-width: 576px) and (max-width: 767px)' );
	wp_enqueue_style( 'davinciwoo-css-xs', ADSW_THEME_URL .'/assets/css/davinciwoo-xs' . ADSW_THEME_MIN . '.css', [ 'davinciwoo-css-main', 'davinciwoo-css-shop' ], ADSW_THEME_VERSION, '(max-width: 575px)' );

	wp_enqueue_style( 'davinciwoo-style', get_stylesheet_uri(), [], ADSW_THEME_VERSION, 'all');

	/*
	 * Enqueue scripts
	 */
	wp_register_script( 'davinciwoo-js-socials', ADSW_THEME_URL . '/assets/js/front/socials.min.js', [ 'jquery' ], ADSW_THEME_VERSION, true );
	wp_enqueue_script( 'davinciwoo-js-popper', ADSW_THEME_URL .'/assets/js/front/popper.min.js', [ 'jquery' ], ADSW_THEME_VERSION, true );
	wp_enqueue_script( 'davinciwoo-js-bootstrap', ADSW_THEME_URL .'/assets/js/front/bootstrap.min.js', [ 'jquery', 'davinciwoo-js-popper' ], '4.1.3', true );
	wp_enqueue_script( 'davinciwoo-js-bootstrap-select', ADSW_THEME_URL .'/assets/js/front/bootstrap-select.min.js', [ 'jquery', 'davinciwoo-js-bootstrap' ], '1.13.2', true );
	wp_enqueue_script( 'davinciwoo-js-lity', ADSW_THEME_URL . '/assets/js/front/lity.min.js', [ 'jquery' ] , '2.3.1', true );
    wp_enqueue_script( 'davinciwoo-theme-swiper-js', ADSW_THEME_URL .'/assets/js/front/swiper-bundle.min.js', [ 'jquery' ], '6.3.2', true );
    wp_enqueue_script( 'addtocart-js', ADSW_THEME_URL . '/assets/js/woocommerce/addtocart' . ADSW_THEME_MIN . '.js', [ 'jquery' ] , ADSW_THEME_VERSION, true );
	wp_enqueue_script( 'davinciwoo-js-countdown', ADSW_THEME_URL . '/assets/js/front/jquery.countdown.min.js', [ 'jquery' ] , ADSW_THEME_VERSION, true );
	wp_enqueue_script( 'davinciwoo-theme-flickity-js', ADSW_THEME_URL .'/assets/js/front/flickity.pkgd.min.js', [ 'jquery' ], '2.1.2', true );
	wp_enqueue_script( 'davinciwoo-js-handlebars', ADSW_THEME_URL .'/include/admin/kit/js/handlebars/handlebars.min.js', [ 'jquery' ], ADSW_THEME_VERSION, true );
	wp_enqueue_script( 'davinciwoo-js-search-product', ADSW_THEME_URL .'/assets/js/front/search-product' . ADSW_THEME_MIN . '.js', [ 'jquery', 'davinciwoo-js-handlebars','davinciwoo-js' ], ADSW_THEME_VERSION, true );
	wp_enqueue_script( 'davinciwoo-js-mobile-menu', ADSW_THEME_URL . '/assets/js/front/mobile-menu' . ADSW_THEME_MIN . '.js', [ 'davinciwoo-js' ], ADSW_THEME_VERSION, true );

	wp_enqueue_script( 'davinciwoo-js', ADSW_THEME_URL .'/assets/js/davinciwoo' . ADSW_THEME_MIN . '.js', [
		'jquery',
		'davinciwoo-js-bootstrap',
		'davinciwoo-js-lity',
		'ttlazy-js',
		'davinciwoo-js-countdown'
	], ADSW_THEME_VERSION, true );


	// Add variables to scripts
	wp_localize_script( 'davinciwoo-js', 'davinciwooVars',
		[
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'user' => [
				'can_edit_pages' => current_user_can( 'edit_pages' ),
			]
		]
	);

	if ( is_woocommerce_activated() ) {

		if( is_product() && ! adswth_option( 'product_gallery_woocommerce') ){

			wp_enqueue_script( 'davinciwoo-theme-flickity-fullscreen-js', ADSW_THEME_URL .'/assets/js/front/flickity.fullscreen.min.js', [ 'jquery', 'davinciwoo-theme-flickity-js' ], '1.1.1', true );
		}

		wp_enqueue_script( 'davinciwoo-theme-woocommerce-main-js', ADSW_THEME_URL .'/assets/js/woocommerce/main' . ADSW_THEME_MIN . '.js', [ 'davinciwoo-js' ], ADSW_THEME_VERSION, true );
		wp_enqueue_script( 'davinciwoo-theme-woocommerce-shopsidebar-js', ADSW_THEME_URL . '/assets/js/woocommerce/shopsidebar' . ADSW_THEME_MIN . '.js', [ 'davinciwoo-js' ], ADSW_THEME_VERSION, true );

		if( adswth_option( 'use_minicart' ) ) {
			wp_enqueue_script( 'davinciwoo-theme-woocommerce-minicart-js', ADSW_THEME_URL . '/assets/js/woocommerce/minicart' . ADSW_THEME_MIN . '.js', [ 'davinciwoo-js' ], ADSW_THEME_VERSION, true );
		}

		if ( is_cart() || is_checkout() || is_account_page() ) {

			if ( ( 'no' === get_option( 'woocommerce_registration_generate_password' ) && ! is_user_logged_in() ) || is_edit_account_page() || is_lost_password_page() ) {
				wp_enqueue_script( 'davinciwoo-password-strength-meter', ADSW_THEME_URL .'/assets/js/woocommerce/password-strength-meter.js', [ 'jquery', 'password-strength-meter', 'wc-password-strength-meter', 'davinciwoo-theme-woocommerce-main-js' ], ADSW_THEME_VERSION, true );
			}
		}
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if( is_singular() ){
		wp_enqueue_script( 'davinciwoo-js-socials' );
	}

	if( is_page() ) {

		if ( is_page_template( 'page-templates/page-track-your-order.php' ) ) {
			wp_enqueue_script( 'davinciwoo-js-17-track', 'https://www.17track.net/externalcall.js', [ 'jquery' ], ADSW_THEME_VERSION, true );
			wp_enqueue_script( 'davinciwoo-js-17-track-form', ADSW_THEME_URL . '/assets/js/17track' . ADSW_THEME_MIN . '.js', [ 'jquery', 'davinciwoo-js-bootstrap','davinciwoo-js-17-track' ] , ADSW_THEME_VERSION, true );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'adswth_scripts', 100 );

function adswth_myme_types( $mime_types ){

	$mime_types['svg'] = 'image/svg+xml';

	return $mime_types;
}
add_filter('upload_mimes', 'adswth_myme_types', 1, 1);

function adswth_remove_kirki_modules( $args ) {

    if( !empty( $args ) && is_array( $args ) && isset( $args[ 'telemetry' ] )){
        unset( $args[ 'telemetry' ] );
    }
    return $args;
}
add_filter( 'kirki_modules', 'adswth_remove_kirki_modules', 10, 1 );