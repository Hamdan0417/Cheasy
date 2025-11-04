<?php

function adswst_updparam() {
    
    return [
        'api_url'     => 'https://sr01.alidropship.com/addons/update?addon_key=alids-social-tools',
        'update_url'  => 'https://sr01.alidropship.com/addons/update?addon_key=alids-social-tools',
        'plugin_slug' => 'alids-social-tools'
    ];
}

/**
 * adswst_init_update_option
 */
function adswst_init_update_option() {
    
    if( ! current_user_can('level_9') || ! isset( $_POST['WPLANG'] ) )
        return null;

    if(
        isset( $_POST['option_page'] ) &&
        isset( $_POST['action'] ) &&
        $_POST['option_page'] == 'general' &&
        $_POST['action'] == 'update'
    ) {
        adswst_download_language_pack( $_POST['WPLANG'] );
    }
}
add_action('admin_init', 'adswst_init_update_option', 10);

function adswst_get_available_translations( $wplang = false ) {
    
    $foo         = adswst_updparam();
    $plugin_slug = $foo['plugin_slug'];

    $get_locale = $wplang ? $wplang : get_locale();

    $request = [
        'plugin_key' => $plugin_slug
    ];

    $raw_response = wp_remote_post( $foo['update_url'], [
        'method'    => 'POST',
        'timeout'   => 45,
        'sslverify' => false,
        'body' => [
            'action' => 'translation_check',
            'locale' => $get_locale,
            'request' => maybe_serialize($request)
        ]
    ] );

    $response = [];
    if ( ! is_wp_error( $raw_response ) && ( $raw_response[ 'response' ][ 'code' ] == 200 ) ) {
        $response = maybe_unserialize( $raw_response[ 'body' ] );
        $response = $response->translations;
    }

    return $response;
}

function adswst_download_language_pack( $wplang = false ) {
    
    // Confirm the translation is one we can download.
    $translation = adswst_get_available_translations( $wplang );
    if( ! $translation )
        return false;

    $translation = (object) $translation;
    
    $translation->type = 'plugin';

    require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

    $upgrade = new Language_Pack_Upgrader( new Automatic_Upgrader_Skin );

    $result = $upgrade->upgrade( $translation, [ 'clear_update_cache' => false ] );
    
    return ! $result || is_wp_error( $result ) ? false : $translation->language;
}

/**
 * Take over the update check
 *
 * @param $checked_data
 * @param bool $upd
 * @param bool $wplang
 * @return mixed
 */
function adswst_check_plugin_update( $checked_data, $upd = false, $wplang = false ) {
    
    global $wp_version;

    $foo         = adswst_updparam();
    $api_url     = $foo['update_url'];
    $plugin_slug = $foo['plugin_slug'];

    //Comment out these two lines during testing.
    if( empty( $checked_data->checked ) )
        return $checked_data;

    $args = [
        'slug'    => $plugin_slug,
        'version' => ADSWST_VERSION,
        'site'    => get_bloginfo('url'),
    ];

    $slug = $plugin_slug . '/' . $plugin_slug . '.php';
    
    $get_locale = $wplang ? $wplang : get_locale();
    $api_url .= '&locale=' . $get_locale;
    
    $request_string = [
        'body'        => [
            'action'  => 'basic_check',
            'request' => serialize($args)
        ],
        'user-agent'  => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url'),
        'sslverify'   => false,
    ];

    // Start checking for an update
    $raw_response = wp_remote_post( $api_url, $request_string );

    if( ! is_wp_error( $raw_response ) && $raw_response['response']['code'] == 200 ) {
        $response = unserialize( $raw_response['body'] );
    }

    if( isset( $response ) && is_object( $response ) && ! empty( $response ) ) {
        
        $checked_data->response[ $slug ] = $response;
        $checked_data->translations[]    = $response->translations;
        
    } elseif( $upd && isset( $response ) && is_array( $response ) && ! empty( $response ) ) {
        
        $checked_data->response[ $slug ] = $response;
        $checked_data->translations[]    = isset( $response['translations'] ) ? $response['translations'] : [];
        
    }

    return $checked_data;
}
add_filter( 'pre_set_site_transient_update_plugins', 'adswst_check_plugin_update' );

/**
 * Take over the Plugin info screen
 *
 * @param $def
 * @param $action
 * @param $args
 *
 * @return bool|mixed|WP_Error
 */
function adswst_plugin_api_call( $def, $action, $args ) {
    
    global $wp_version;

    $foo         = adswst_updparam();
    $api_url     = $foo['update_url'];
    $plugin_slug = $foo['plugin_slug'];

    if( ! isset( $args->slug ) || $args->slug != $plugin_slug )
        return $def;

    $args->version   = ADSWST_VERSION;
    $args->site      = get_bloginfo('url');

    $request_string = [
        'body'        => [
            'action'  => $action,
            'request' => serialize( $args )
        ],
        'user-agent'  => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url'),
        'sslverify'   => false,
    ];

    $request = wp_remote_post( $api_url, $request_string );
    if( is_wp_error( $request ) ) {
        $res = new WP_Error(
            'plugins_api_failed',
            __('<p>An Unexpected HTTP Error occurred during the API request.</p>' .
                '<a href="?" onclick="document.location.reload(); return false;">Try again</a>',
                'ppu'
            ),
            $request->get_error_message()
        );
    } else {
        $res = unserialize( $request['body'] );
        if( $res === false ) {
            $res = new WP_Error(
                'plugins_api_failed',
                __('An unknown error occurred', 'ppu'),
                $request['body']
            );
        } else {
            adswst_download_language_pack();
        }
    }

    return $res;
}
add_filter('plugins_api', 'adswst_plugin_api_call', 10, 3);
