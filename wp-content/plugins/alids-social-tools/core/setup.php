<?php

/**
 * Setup the plugin
 */
function adswst_install() {

	update_site_option( 'adswst_version', ADSWST_VERSION  );
}

/**
 * Uninstall plugin
 */
function adswst_uninstall() {

	delete_option( 'adswst_settings' );
}

/**
 * Check installed plugin
 */
function adswst_installed() {

	if ( ! current_user_can( 'install_plugins' ) ) {
		return;
	}

	$version = get_site_option( 'adswst_version' );

	if ( $version < ADSWST_VERSION ) {
		adswst_install();
	}
}
add_action( 'admin_menu', 'adswst_installed' );

/**
 * When activate plugin
 */
function adswst_activate() {

	adswst_installed();

	do_action( 'adswst_activate' );
}

/**
 * When deactivate plugin
 */
function adswst_deactivate(){

	do_action( 'adswst_deactivate' );
}

add_action( 'admin_enqueue_scripts', function(){
    wp_enqueue_script('adswst_social_tools_admin', ADSWST_URL . '/assets/js/admin.min.js', array('jquery'));
}, 99 );

