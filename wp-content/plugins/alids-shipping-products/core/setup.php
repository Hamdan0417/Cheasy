<?php

/**
 * Setup the plugin
 */

function sship_install() {

    require( sSHIP_PATH . 'core/sql.php' );

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    foreach( sship_sql_list() as $key ) {
        dbDelta($key);
    }
    
    sship_maybe_add_columns();

	update_site_option( 'sSHIP_VERSION', sSHIP_VERSION  );
}
    
    function sship_maybe_add_columns()
    {
        
        global $wpdb;
        
        $args = [
            'sship_shipping_list' => [
                'enabled' => "ALTER TABLE `{$wpdb->prefix}sship_shipping_list` ADD `enabled` INT(1) DEFAULT 1;",
            ],
        ];
        
        foreach( $args as $key => $val ) {
            
            $result = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT *
			 	 FROM `information_schema`.`COLUMNS`
			 	 WHERE `TABLE_SCHEMA` = '%s' AND `TABLE_NAME` = '{$wpdb->prefix}{$key}'",
                    DB_NAME
                )
            );
            
            $col = [];
            if( count( $result ) > 0 ) foreach( $result as $column ) {
                $col[] = $column->COLUMN_NAME;
            }
            
            if( count( $col ) > 0 ) foreach( $val as $k => $v ) {
                if( !in_array( $k, $col ) )
                    $wpdb->query( $v );
            }
        }
    }

/**
 * Uninstall plugin
 */
function sship_uninstall() {

	global $wpdb;
    
    $query = "DROP TABLE " . $wpdb->prefix . 'sship_shipping_order';
    $wpdb->query($query);
    $query = "DROP TABLE " . $wpdb->prefix . 'sship_shipping';
    $wpdb->query($query);

/*    $query = "DROP TABLE " . $wpdb->prefix . 'sship_shipping_list';
    $wpdb->query($query);
    $query = "DROP TABLE " . $wpdb->prefix . 'sship_shipping';
    $wpdb->query($query);

	delete_option( 'sship_settings' );*/
}

/**
 * Check installed plugin
 */
function sship_installed() {

	if ( ! current_user_can( 'install_plugins' ) ) {
        return;
    }

    $version = get_site_option('sSHIP_VERSION');

	if ( $version < sSHIP_VERSION ) {
		sship_install();
    }
}
add_action( 'admin_menu', 'sship_installed' );

/**
 * When activate plugin
 */
function sship_activate() {

	sship_installed();

	do_action( 'sship_activate' );
}

/**
 * When deactivate plugin
 */
function sship_deactivate(){

	do_action( 'sship_deactivate' );
}
