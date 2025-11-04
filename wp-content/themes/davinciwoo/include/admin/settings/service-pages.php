<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$tmpl = new \adswth\adsTemplate();

$tmpl->addItem( 'nonce', [
	'name'  => 'adswth_404_page',
	'value' => 'adswth_setting_action'
] );

$tmpl->addItem( 'uploadImgCrop', [
	'label' => __( 'Background image (recommended size: 1920x550px)', 'davinciwoo' ),
	'name' => '404_background_image',
	'width' => 1920,
	'height' => 550,
	'crop_name' => 'bg404'
] );
$tmpl->addItem( 'textarea', [
	'label'       => __( 'Text', 'davinciwoo' ),
	'name'        => '404_text',
] );

$tmpl->addItem( 'text', [
	'label'       => __( 'Button 1 text', 'davinciwoo' ),
	'name'        => '404_btn_text_1',
] );
$tmpl->addItem( 'text', [
	'label'       => __( 'Button 1 link', 'davinciwoo' ),
	'name'        => '404_btn_link_1',
] );
$tmpl->addItem( 'text', [
	'label'       => __( 'Button 2 text', 'davinciwoo' ),
	'name'        => '404_btn_text_2',
] );
$tmpl->addItem( 'text', [
	'label'       => __( 'Button 1 link', 'davinciwoo' ),
	'name'        => '404_btn_link_2',
] );

$tmpl->addItem( 'buttons', [
	'class' => 'btn btn-green',
	'value' => __( 'Save Changes', 'davinciwoo' ),
	'name'  => 'save'
] );

$tmpl->template( 'adswth-adswth_404_page-form',  $tmpl->renderItems() );
?>

<div class="wrap">
	<div class="container-fluid" id="adswth-container">
		<div class="row">
			<div class="col-12 col-lg-6">
				<h1 class="wp-heading-inline">
					<?php _e( 'Service Pages', 'davinciwoo' ) ?>
				</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-10 col-xl-8">
				<?php
				$tmpl->renderPanel( [
					'panel_title'   => __( '404 page', 'davinciwoo' ),
					'panel_class'   => 'success w-100',
					//'panel_help'    => '',
					'panel_content' => '<div id="adswth_404_page-form"
											data-adswth_action="page_adswth_404_page" 
                        					data-adswth_target="#adswth_404_page-form" 
                        					data-adswth_template="#adswth-adswth_404_page-form"></div>'
				] );
				?>
			</div>
		</div>
	</div>
</div>
