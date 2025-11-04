<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$data = [
	'theme_name' => get_option('stylesheet')
];

if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
	die( 'Failed to find TGM' );
}

$options = new \adswth\adsSetup( $data );

$tmpl = new \adswth\adsTemplate();

$options->render_plugins();

$tmpl->addItem( 'nonce', [
	'name'  => 'setup_child',
	'value' => 'setup'
] );

$tmpl->addItem( 'hidden', [
	'name'  => 'theme_name',
	'value' => $data[ 'theme_name' ]
] );

$tmpl->addItem( 'text', [
	'label'       => __( 'Child Name', 'davinciwoo' ),
	'name'        => 'child_theme_title',
] );

$tmpl->addItem( 'button', [
	'value'      => __( 'Install Child', 'davinciwoo' ),
	'name'       => 'setup-child',
	'id'         => 'setup-child',
	'class'      => 'ads-no btn btn-green'
] );

$tmpl->template( 'adswth-adswth_child-form', $tmpl->renderItems() );




$tmpl->addItem( 'nonce', [
	'name'  => 'setup_demo',
	'value' => 'setup'
] );

$tmpl->addItem( 'hidden', [
	'name'  => 'theme_name',
	'value' => $data[ 'theme_name' ]
] );

foreach ( $options->_content_default_get() as $slug => $default){
	$tmpl->addItem( 'switcher', [
		'name'    => 'demo_default_content[' . esc_attr( $slug ) . ']',
		'value'   => 1,
		'checked' => true,
		'label'   => $default['title'],
		'help'   => $default['description'],
		'class'  => 'demo_default_content',
	] );
}
$tmpl->addItem( 'custom', [
        'value' => __( 'Please note that demo data installation might affect your already existing pages and menus. To start from scratch, delete your pages and menus.', 'davinciwoo' )
] );
$tmpl->addItem( 'button', [
	'value'      => __( 'Install Demo', 'davinciwoo' ),
	'name'       => 'demo-import',
	'id'         => 'demo-import',
	'class'      => 'ads-no btn btn-green'
] );

$tmpl->template( 'adswth-adswth_demo-form', $tmpl->renderItems() );

?>

<div class="wrap">
	<div class="container-fluid" id="adswth-container">
		<div class="row">
			<div class="col-12 col-lg-6">
				<h1 class="wp-heading-inline">
					<?php _e( 'General settings', 'davinciwoo' ) ?>
				</h1>
			</div>
		</div>

        <div class="row align-items-start">
            <div class="col-md-12 col-lg-7 col-xl-7">
				<?php
				    tgmpa_load_bulk_installer();

				$tmpl->renderPanel( [
					'panel_title'   =>  __( 'Install plugins', 'davinciwoo' ),
					'panel_class'   => 'success',
					'panel_content' =>
						'<div id="adswth_plugins-form" 
                            data-adswth_action="page_adswth_plugins_form" 
                            data-adswth_target="#adswth_plugins-form" 
                            data-adswth_template="#adswth-adswth_plugins-form">'.
						$tmpl->hidden( [ 'name'  => 'theme_name', 'value' => $data[ 'theme_name' ] ] ).
						'</div>'
				] );
				?>
            </div>
            <div class="col-md-12 col-lg-4 col-xl-5">
	            <?php
	            $tmpl->renderPanel( [
		            'panel_title'   => __( 'Install Child Theme', 'davinciwoo' ),
		            'panel_class'   => 'success',
		            'panel_content' =>
			            '<div id="adswth_child-form" 
                            data-adswth_action="page_adswth_child_form" 
                            data-adswth_target="#adswth_child-form" 
                            data-adswth_template="#adswth-adswth_child-form">'.
			            $tmpl->hidden( [ 'name'  => 'theme_name', 'value' => $data[ 'theme_name' ] ] ) .
			            '</div>'
	            ] );
	            ?>

				<?php
				$tmpl->renderPanel( [
					'panel_title'   => __( 'Install demo', 'davinciwoo' ),
					'panel_class'   => 'success',
					'panel_content' =>
						'<div id="adswth_demo-form" 
                            data-adswth_action="page_adswth_demo_form" 
                            data-adswth_target="#adswth_demo-form" 
                            data-adswth_template="#adswth-adswth_demo-form">'.
						$tmpl->hidden( [ 'name'  => 'theme_name', 'value' => $data[ 'theme_name' ] ] ) .
						'</div>'
				] );
				?>
            </div>
        </div>

	</div>
</div>