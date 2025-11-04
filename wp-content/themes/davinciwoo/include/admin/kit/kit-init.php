<?php

function adswth_do_show_notify() {

	echo '<div id="adswth-notify"></div>';
}
add_action( 'admin_footer', 'adswth_do_show_notify' );

function adswth_admin_menu() {

	$foo = adswth_config_menu();

	add_menu_page(
		$foo[ 'title' ],
		$foo[ 'title' ],
		$foo[ 'capability' ],
		$foo[ 'key' ],
		$foo[ 'action' ],
		$foo[ 'icon' ]
	);

	if( isset( $foo[ 'submenu' ] ) ) foreach( $foo[ 'submenu' ] as $k => $v ) {

		add_submenu_page(
			$foo[ 'key' ],
			$v[ 'title' ],
			$v[ 'title' ],
			$v[ 'capability' ],
			$k,
			$v[ 'action' ]
		);
	}
}
add_action( 'admin_menu', 'adswth_admin_menu' );

function adswth_config_menu() {

	return [
		'key'         => 'adswth_general',
		'title'       => 'Davinci Woo',
		'action'      => 'adswth_admin_settings_general',
		'icon'        => 'dashicons-art',
		'capability'  => 'activate_plugins',
		'submenu'     => [
			'adswth_general'      => [
				'title'       => __( 'General', 'davinciwoo' ),
				'capability'  => 'activate_plugins',
				'action'      => 'adswth_admin_settings_general',
			],
			'adswth_woocommerce' => [
				'title'       => __( 'Woocommerce', 'davinciwoo' ),
				'capability'  => 'activate_plugins',
				'action'      => 'adswth_admin_settings_woocommerce',
			],
			'adswth_service_pages' => [
				'title'       => __( 'Service Pages', 'davinciwoo' ),
				'capability'  => 'activate_plugins',
				'action'      => 'adswth_admin_settings_service_pages',
			],
            'adswth_additional' => [
				'title'       => __( 'Additional', 'davinciwoo' ),
				'capability'  => 'activate_plugins',
				'action'      => 'adswth_admin_settings_additional',
			]
		]
	];
}

function adswth_js_filter() {

	$args = [
		'adswth-ajaxQueue' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/global/jquery.ajaxQueue.min.js',
			'parent' => [ 'jquery' ],
			'ver'    => '0.1.2'
		],
		'adswth-handlebars' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/handlebars/handlebars.min.js',
			'parent' => [ 'jquery' ],
			'ver'    => '4.0.5'
		],
		'adswth-switchery' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/global/switchery.min.js',
			'parent' => [ 'jquery' ],
			'ver'    => '0.8.2'
		],
		'adswth-uniform' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/global/uniform.min.js',
			'parent' => [ 'jquery' ],
			'ver'    => '4.0'
		],
		'adswth-touchSwipe' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/global/jquery.touchSwipe.min.js',
			'parent' => [ 'jquery' ],
			'ver'    => '1.6.18'
		],
		'adswth-jqpagination' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/global/jquery.jqpagination.min.js',
			'parent' => [ 'jquery' ],
			'ver'    => '1.4.1'
		],
		'adswth-clipboard' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/global/clipboard.min.js',
			'parent' => [ 'jquery' ],
			'ver'    => '1.6.1'
		],
		'adswth-popper' => [
			'url'    => ADSW_THEME_URL . '/assets/js/front/popper.min.js',
			'parent' => false,
			'ver'    => '1.0.0'
		],
		'adswth-bootstrap' => [
			'url'    => ADSW_THEME_URL . '/assets/js/front/bootstrap.min.js',
			'parent' => [ 'jquery', 'adswth-popper' ],
			'ver'    => '3.3.7'
		],
		'adswth-bootstrap-select' => [
			'url'    => ADSW_THEME_URL . '/assets/js/front/bootstrap-select.min.js',
			'parent' => [ 'jquery', 'adswth-bootstrap' ],
			'ver'    => '1.13.2'
		],
		'adswth-main' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/admin/main' . ADSW_THEME_MIN . '.js',
			'parent' => [
				'adswth-handlebars',
				'adswth-ajaxQueue',
				'adswth-switchery',
				'adswth-uniform',
				'adswth-bootstrap-select',
				'adswth-jqpagination',
				'adswth-clipboard',
				'adswth-cropper',
			],
			'ver'    => ADSW_THEME_VERSION
		],
		'adswth-d3' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/chart/d3.js',
			'parent' => [ 'jquery' ],
			'ver'    => ADSW_THEME_VERSION
		],
		'adswth-d3_tooltip' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/chart/d3_tooltip.js',
			'parent' => [ 'jquery' ],
			'ver'    => ADSW_THEME_VERSION
		],
		'adswth-chart' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/chart/chart.js',
			'parent' => [ 'adswth-d3', 'adswth-d3_tooltip' ],
			'ver'    => ADSW_THEME_VERSION
		],
		'adswth-cropper' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/cropper/cropper.min.js',
			'parent' => [ 'jquery' ],
			'ver'    => ADSW_THEME_VERSION
		],
		'adswth-general' => [
			'url'    => ADSW_THEME_URL . '/include/admin/kit/js/admin/adswth-general' . ADSW_THEME_MIN . '.js',
			'parent' => [ 'adswth-main', 'adswth-touchSwipe', 'adswth-chart' ],
			'ver'    => ADSW_THEME_VERSION
		],
		'adswth-general-demo-plugins' => [
			'url'    => ADSW_THEME_URL . '/include/admin/demo/js/plugins' . ADSW_THEME_MIN . '.js',
			'parent' => [ 'adswth-main' ],
			'ver'    => ADSW_THEME_VERSION
		],
		'adswth-general-demo-child' => [
			'url'    => ADSW_THEME_URL . '/include/admin/demo/js/child-theme' . ADSW_THEME_MIN . '.js',
			'parent' => [ 'adswth-main' ],
			'ver'    => ADSW_THEME_VERSION
		],
		'adswth-general-demo-content' => [
			'url'    => ADSW_THEME_URL . '/include/admin/demo/js/content' . ADSW_THEME_MIN . '.js',
			'parent' => [ 'adswth-main' ],
			'ver'    => ADSW_THEME_VERSION
		],

	];

	foreach( $args as $key => $val ) {

		wp_register_script(
			$key,
			$val[ 'url' ],
			$val[ 'parent' ],
			$val[ 'ver' ],
			true
		);
	}
}
add_action( 'admin_print_scripts', 'adswth_js_filter' );

function adswth_kit_css_filter() {

	$foo = [
		'adswth-bootstrap'        => ADSW_THEME_URL . '/assets/css/front/bootstrap' . ADSW_THEME_MIN . '.css',
		'adswth-bootstrap-select' => ADSW_THEME_URL . '/assets/css/front/bootstrap-select.min.css',
		'adswth-kit'              => ADSW_THEME_URL . '/include/admin/kit/css/kit' . ADSW_THEME_MIN . '.css',
        'adswth-kit-custom'       => ADSW_THEME_URL . '/include/admin/kit/css/kit-custom' . ADSW_THEME_MIN . '.css',
		'adswth-d3'               => ADSW_THEME_URL . '/include/admin/kit/css/d3.css',
		'adswth-fontawesome'      => ADSW_THEME_URL . '/assets/icons/fontawesome/style.css',
		'adswth-cropper'          => ADSW_THEME_URL . '/include/admin/kit/css/cropper/cropper.css',
	];

	foreach( $foo as $key => $val ) {

		wp_register_style( $key, $val, ADSW_THEME_VERSION );
	}
}
add_action( 'admin_init', 'adswth_kit_css_filter' );

function adswth_admin_settings_general() {

	wp_enqueue_style( 'adswth-bootstrap' );
	wp_enqueue_style( 'adswth-bootstrap-select' );
	wp_enqueue_style( 'adswth-fontawesome' );
	wp_enqueue_style( 'adswth-kit' );

	wp_enqueue_script( 'adswth-general' );
	wp_enqueue_script( 'adswth-general-demo-plugins' );
	wp_enqueue_script( 'adswth-general-demo-child' );
	wp_enqueue_script( 'adswth-general-demo-content' );

	require( ADSW_THEME_PATH . '/include/admin/settings/general.php' );
}

function adswth_admin_settings_woocommerce() {

	wp_enqueue_style( 'adswth-bootstrap' );
	wp_enqueue_style( 'adswth-bootstrap-select' );
	wp_enqueue_style( 'adswth-fontawesome' );
	wp_enqueue_style( 'adswth-kit' );
	wp_enqueue_style( 'adswth-kit-custom' );

	wp_enqueue_script( 'adswth-general' );

	require( ADSW_THEME_PATH . '/include/admin/settings/woocommerce.php' );
}

function adswth_admin_settings_service_pages(){

	wp_enqueue_style( 'adswth-bootstrap' );
	wp_enqueue_style( 'adswth-bootstrap-select' );
	wp_enqueue_style( 'adswth-fontawesome' );
	wp_enqueue_style( 'adswth-kit' );
	wp_enqueue_style( 'adswth-kit-custom' );
	wp_enqueue_style( 'adswth-cropper' );

    if ( ! did_action( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }

	wp_enqueue_script( 'adswth-general' );



	require( ADSW_THEME_PATH . '/include/admin/settings/service-pages.php' );
}

function adswth_admin_settings_additional(){
    wp_enqueue_style( 'adswth-bootstrap' );
    wp_enqueue_style( 'adswth-bootstrap-select' );
    wp_enqueue_style( 'adswth-fontawesome' );
    wp_enqueue_style( 'adswth-kit' );
    wp_enqueue_style( 'adswth-kit-custom' );
    wp_enqueue_style( 'adswth-cropper' );

    wp_enqueue_script( 'adswth-general' );

    require( ADSW_THEME_PATH . '/include/admin/settings/additional.php' );
}