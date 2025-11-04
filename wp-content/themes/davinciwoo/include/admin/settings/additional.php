<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$tmpl = new \adswth\adsTemplate();

$tmpl->addItem( 'nonce', [
    'name'  => 'adswth_additional',
    'value' => 'adswth_setting_action'
] );
$tmpl->addItem( 'textarea', [
    'label'       => __( 'Head custom code', 'davinciwoo' ),
    'description' => __( 'Use this section to add or edit scripts that will be placed between HEAD tags on your site.', 'davinciwoo'),
    'name'        => 'additional_header_scripts',
] );
$tmpl->addItem( 'textarea', [
    'label'       => __( 'Footer custom code', 'davinciwoo' ),
    'description' => __( 'Use this section to add or edit scripts that will be placed in footer on your site.', 'davinciwoo'),
    'name'        => 'additional_footer_scripts',
] );

$tmpl->addItem( 'buttons', [
    'class' => 'btn btn-green',
    'value' => __( 'Save Changes', 'davinciwoo' ),
    'name'  => 'save'
] );

$tmpl->template( 'adswth-adswth_additional-form',  $tmpl->renderItems() );
?>

<div class="wrap">
    <div class="container-fluid" id="adswth-container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h1 class="wp-heading-inline">
                    <?php _e( 'Additional', 'davinciwoo' ) ?>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <?php
                $tmpl->renderPanel( [
                    'panel_title'   => __( 'Additional code snippets', 'davinciwoo' ),
                    'panel_class'   => 'success w-100',
                    'panel_content' => '<div id="adswth_additional-form"
											data-adswth_action="page_adswth_additional" 
                        					data-adswth_target="#adswth_additional-form" 
                        					data-adswth_template="#adswth-adswth_additional-form"></div>'
                ] );
                ?>
            </div>
        </div>
    </div>
</div>