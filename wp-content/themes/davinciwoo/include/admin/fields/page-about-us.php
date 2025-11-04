<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$tmpl = new \adswth\adsTemplate();

$tmpl->addItem( 'hidden', [ 'name' => 'post_id', 'value' =>get_the_ID() ] );

$tmpl->addItem( 'uploadImgCrop', [ 'label' => __( 'Background image (recommended size: 1920x400px)', 'davinciwoo' ), 'name' => '_top_bg_about', 'width' => 1920, 'height' => 400, 'crop_name' => 'bgabout' ] );

$R1 = $tmpl->renderItems();

//Our Core Values

$tmpl->addItem( 'switcher', [ 'label' => __( 'Enable this block', 'davinciwoo' ), 'name' => '_our_core_values_show' ] );
$tmpl->addItem( 'text', [ 'label' => __( 'Block title', 'davinciwoo' ), 'name' => '_our_core_values_title' ] );
$tmpl->addItem( 'uploadImg', [ 'label' => __( 'Image', 'davinciwoo' ) .' 1 '. __('(recommended size: 120x120px)', 'davinciwoo' ), 'name' => '_our_core_values_img_1', 'width' => 120, 'height' => 120 ] );
$tmpl->addItem( 'text', [ 'label' => __( 'Text', 'davinciwoo' ) . ' 1', 'name' => '_our_core_values_text_1' ] );
$tmpl->addItem( 'uploadImg', [ 'label' => __( 'Image', 'davinciwoo' ) .' 2 '. __('(recommended size: 120x120px)', 'davinciwoo' ), 'name' => '_our_core_values_img_2', 'width' => 120, 'height' => 120 ] );
$tmpl->addItem( 'text', [ 'label' => __( 'Text', 'davinciwoo' ) . ' 2', 'name' => '_our_core_values_text_2' ] );
$tmpl->addItem( 'uploadImg', [ 'label' => __( 'Image', 'davinciwoo' ) .' 3 '. __('(recommended size: 120x120px)', 'davinciwoo' ), 'name' => '_our_core_values_img_3', 'width' => 120, 'height' => 120 ] );
$tmpl->addItem( 'text', [ 'label' => __( 'Text', 'davinciwoo' ) . ' 3', 'name' => '_our_core_values_text_3' ] );
$tmpl->addItem( 'uploadImg', [ 'label' => __( 'Image', 'davinciwoo' ) .' 4 '. __('(recommended size: 120x120px)', 'davinciwoo' ), 'name' => '_our_core_values_img_4', 'width' => 120, 'height' => 120 ] );
$tmpl->addItem( 'text', [ 'label' => __( 'Text', 'davinciwoo' ) . ' 4', 'name' => '_our_core_values_text_4' ] );
$tmpl->addItem( 'uploadImg', [ 'label' => __( 'Image', 'davinciwoo' ) .' 5 '. __('(recommended size: 120x120px)', 'davinciwoo' ), 'name' => '_our_core_values_img_5', 'width' => 120, 'height' => 120 ] );
$tmpl->addItem( 'text', [ 'label' => __( 'Text', 'davinciwoo' ) . ' 5', 'name' => '_our_core_values_text_5' ] );

$R2 = $tmpl->renderItems();

$tmpl->addItem( 'switcher', [ 'label' => __( 'Enable this block', 'davinciwoo' ), 'name' => '_keep_in_contact_show' ] );
$tmpl->addItem( 'text', [ 'label' => __( 'Block title', 'davinciwoo' ), 'name' => '_keep_in_contact_title' ] );
$tmpl->addItem( 'textarea', [ 'label' => __( 'Description', 'davinciwoo' ), 'name' => '_keep_in_contact_description' ] );
$tmpl->addItem( 'text', [ 'label' => __( 'Button 1 label', 'davinciwoo' ), 'name' => '_keep_in_contact_btn_1_label' ]);
$tmpl->addItem( 'text', [ 'label' => __( 'Button 1 url', 'davinciwoo' ), 'name' => '_keep_in_contact_btn_1_url' ]);
$tmpl->addItem( 'text', [ 'label' => __( 'Button 2 label', 'davinciwoo' ), 'name' => '_keep_in_contact_btn_2_label' ]);
$tmpl->addItem( 'text', [ 'label' => __( 'Button 2 url', 'davinciwoo' ), 'name' => '_keep_in_contact_btn_2_url' ]);

$R3 = $tmpl->renderItems();

$tmpl->addItem( 'switcher', [ 'label' => __( 'Enable this block', 'davinciwoo' ), 'name' => '_our_partners_show' ] );
$tmpl->addItem( 'text', [ 'label' => __( 'Block title', 'davinciwoo' ), 'name' => '_our_partners_title' ] );
$tmpl->addItem( 'textarea', [ 'label' => __( 'Description', 'davinciwoo' ), 'name' => '_our_partners_description' ] );
$tmpl->addItem( 'uploadImg', [ 'label' => __( 'Image', 'davinciwoo' ) . ' 1 ' . __( '(recommended size: 33px)', 'davinciwoo' ), 'name' => '_about_delivery_1', 'width' => 'auto', 'height' => 33 ] );
$tmpl->addItem( 'uploadImg', [ 'label' => __( 'Image', 'davinciwoo' ) . ' 2 ' . __( '(recommended size: 33px)', 'davinciwoo' ), 'name' => '_about_delivery_2', 'width' => 'auto', 'height' => 33 ] );
$tmpl->addItem( 'uploadImg', [ 'label' => __( 'Image', 'davinciwoo' ) . ' 3 ' . __( '(recommended size: 33px)', 'davinciwoo' ), 'name' => '_about_delivery_3', 'width' => 'auto', 'height' => 33 ] );
$tmpl->addItem( 'uploadImg', [ 'label' => __( 'Image', 'davinciwoo' ) . ' 4 ' . __( '(recommended size: 33px)', 'davinciwoo' ), 'name' => '_about_delivery_4', 'width' => 'auto', 'height' => 33 ] );
$tmpl->addItem( 'uploadImg', [ 'label' => __( 'Image', 'davinciwoo' ) . ' 5 ' . __( '(recommended size: 33px)', 'davinciwoo' ), 'name' => '_about_delivery_5', 'width' => 'auto', 'height' => 33 ] );

$R4 = $tmpl->renderItems();

$tmpl->addItem( 'buttons', [ 'class' =>'btn btn-green ads-no js-adstm-save', 'name' =>'save', 'value' => __( 'Save', 'dav2' ) ] );

$R5 = $tmpl->renderItems();

$tmpl->template( 'adswth-adswth_page_fields_about_us',
    '<h1>' . __('Title area', 'davinciwoo') . '</h1>' .
    $R1 .
    '<hr>' .
    '<h1>' . __('Our Core Values', 'davinciwoo') . '</h1>' .
    $R2 .
    '<hr>' .
    '<h1>' . __('Keep In Contact With Us', 'davinciwoo') . '</h1>' .
    $R3 .
    '<hr>' .
    '<h1>' . __('Our Partners', 'davinciwoo') . '</h1>' .
    $R4.
    $R5
);

?>
<div class="container-fluid" id="adswth-container">
	<div class="row">
		<div class="col-12">
			<div id="adswth_page_fields_about_us-form"
				 data-adswth_action="page_fields"
                 data-adswth_controller="adsFields"
                 data-adswth_fields_set="about_us"
	             data-adswth_target="#adswth_page_fields_about_us-form"
	             data-adswth_template="#adswth-adswth_page_fields_about_us"
            ></div>

		</div>
	</div>
</div>
