<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$tmpl = new \adswth\adsTemplate();

//Menus Settings
$tmpl->addItem( 'nonce', [
	'name'  => 'adswth_menus',
	'value' => 'adswth_setting_action'
] );

$tmpl->addItem( 'checkbox', [
	'help'       => __( 'Show number of products in product categories in Slider menu', 'davinciwoo' ),
	'name'       => 'menu_product_cat_show_count',
] );

$M1 = $tmpl->renderItems();

$tmpl->addItem( 'buttons', [
	'class' => 'btn btn-green',
	'value' => __( 'Save Changes', 'davinciwoo' ),
	'name'  => 'save'
] );

$M2 = $tmpl->renderItems();

$tmpl->template( 'adswth-adswth_menus-form', $M1 . $M2 );

//Woocommerce settings
$tmpl->addItem( 'nonce', [
	'name'  => 'adswth_woocommerce',
	'value' => 'adswth_settings_action'
] );

$tmpl->addItem( 'switcher', [
    'label' => __( 'Use side Shopping cart', 'davinciwoo' ),
    'help'  => __( 'Your website will use both side Shopping cart and Cart page', 'davinciwoo' ),
	'name'  => 'use_minicart',
] );

$tmpl->addItem( 'switcher', [
    'label' => __( 'Use Shopping cart page', 'davinciwoo' ),
    'help'  => __( 'Your website will use Shopping cart page', 'davinciwoo' ),
	'name'  => 'use_shoppingcart',
] );

$tmpl->addItem( 'switcher', [
    'label' => __( 'Show side Shopping cart when a product is added to cart', 'davinciwoo' ),
	'name'  => 'show_side_shoppingcart_after_product_add',
] );

$tmpl->addItem( 'buttons', [
	'class' => 'btn btn-green',
	'value' => __( 'Save Changes', 'davinciwoo' ),
	'name'  => 'save'
] );

$W1 = $tmpl->renderItems();

$tmpl->template( 'adswth-adswth_woocommerce-form', $W1 );

//Single product settings
$tmpl->addItem( 'nonce', [
	'name'  => 'adswth_single_product',
	'value' => 'adswth_setting_action'
] );

$tmpl->addItem( 'checkbox', [
	'help'       => __( 'Use WooCommerce default gallery', 'davinciwoo' ),
	'name'        => 'product_gallery_woocommerce',
] );

$SP1 = $tmpl->renderItems();

$tmpl->addItem( 'textarea', [
	'label'       => __( 'Shipping & Payment description', 'davinciwoo' ),
	'name'        => 'product_page_shipping_content',
] );

$tmpl->addItem( 'buttons', [
	'class' => 'btn btn-green',
	'value' => __( 'Save Changes', 'davinciwoo' ),
	'name'  => 'save'
] );

$SP2 = $tmpl->renderItems();

$tmpl->template( 'adswth-adswth_single_product-form', $SP1 . '<hr>' . $SP2 );

?>

<div class="wrap">
	<div class="container-fluid" id="adswth-container">
		<div class="row">
			<div class="col-12 col-lg-6">
				<h1 class="wp-heading-inline">
					<?php _e( 'WooCommerce', 'davinciwoo' ) ?>
				</h1>
			</div>
		</div>
        <div class="row">
            <div class="col-md-12 col-lg-10 col-xl-8">
				<?php
				$tmpl->renderPanel( [
					'panel_title'   => __( 'WooCommerce', 'davinciwoo' ),
					'panel_class'   => 'success w-100',
					//'panel_help'    => '',
					'panel_content' => '<div id="adswth_woocommerce-form"
											data-adswth_action="page_adswth_woocommerce" 
                        					data-adswth_target="#adswth_woocommerce-form" 
                        					data-adswth_template="#adswth-adswth_woocommerce-form"></div>'
				] );
				?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-10 col-xl-8">
				<?php
				$tmpl->renderPanel( [
					'panel_title'   => __( 'Menus', 'davinciwoo' ),
					'panel_class'   => 'success w-100',
					//'panel_help'    => '',
					'panel_content' => '<div id="adswth_menus-form"
											data-adswth_action="page_adswth_menus" 
                        					data-adswth_target="#adswth_menus-form" 
                        					data-adswth_template="#adswth-adswth_menus-form"></div>'
				] );
				?>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12 col-lg-10 col-xl-8">
				<?php
				$tmpl->renderPanel( [
					'panel_title'   => __( 'Single Product Page Settings', 'davinciwoo' ),
					'panel_class'   => 'success w-100',
					//'panel_help'    => '',
					'panel_content' => '<div id="adswth_single_product-form"
											data-adswth_action="page_adswth_single_product" 
                        					data-adswth_target="#adswth_single_product-form" 
                        					data-adswth_template="#adswth-adswth_single_product-form"></div>'
				] );
				?>
			</div>
		</div>
	</div>
</div>
