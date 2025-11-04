<?php

function adswst_register_widgets() {
	
	register_widget( 'ADSWST_Facebook_Likebox_Widget' );
	register_widget( 'ADSWST_Instagram_Widget' );
	register_widget( 'ADSWST_Social_Icons_Widget' );
}
add_action( 'widgets_init', 'adswst_register_widgets' );

function adswst_social_icons_widget_shortcode ( $atts ){

	global $wp_widget_factory;

	$args = shortcode_atts( [
		'title'          => '',
		'id'             => '',
		'facebook_link'  => '',
		'instagram_link' => '',
		'twitter_link'   => '',
		'pinterest_link' => '',
		'youtube_link'   => '',
		'tiktok_link'   => '',
		'linkedin_link'   => '',
		'snapchat_link'   => '',
		'icon_color'                  => '#FFFFFF',
		'icon_color_hover'            => '#FFFFFF',
		'icon_color_background'       => '#333333',
		'icon_color_background_hover' => '#626262',
		'icon_font_size'              => '14',
		'padding'                     => '5',
		'border_radius'               => '2'
	], $atts );

	ob_start();
	
	the_widget( 'ADSWST_Social_Icons_Widget', $args, []);
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return '<span>' . $output . '</span>';
}
add_shortcode( 'adswst_social_icons','adswst_social_icons_widget_shortcode' );

function adswst_instagram_widget_shortcode ( $atts ){

	global $wp_widget_factory;

	$args = shortcode_atts( [
		'username'  => '',
		'token'     => '',
		'size'      => 'small',
		'number'    => 6,
		'target'    => '_blank',
		'shortcode' => true,
	], $atts);

	ob_start();
	
	the_widget( 'ADSWST_Instagram_Widget', $args, [] );
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return '<div class="adswst-instagram-wide">' . $output . '</div>';
}
add_shortcode( 'adswst_instagram','adswst_instagram_widget_shortcode' );

function adswst_social_tools_register_menu (){
    if ( function_exists('add_menu_page') )
    {
        add_menu_page( 'AliDropship Social Tools settings', 'AliDropship Social Tools settings', 'manage_options', 'adswst_social_tools_settings', 'adswst_social_tools_settings', '', 6 );
    }
}
add_action('admin_menu',  'adswst_social_tools_register_menu' );

function adswst_social_tools_settings(){
    ?>
    <div class="wrap">
        <h2><?php echo get_admin_page_title() ?></h2>

        <p><?php  _e( 'Use this button to update your Instagram images in widget', 'adswst' ); ?></p>
        <p><button id="update-instagram-images" class="button button-primary"><?php esc_html_e( 'Update instagram images', 'adswst' ) ?></button></p>
        <div class="adswst-success-notice" style="display: none; color: green">
            <p><?php _e('Instagram images updated', 'adswst'); ?></p>
        </div>
    </div>
    <?php
}

function adswst_update_instagram_images(){
    global $wpdb;
    $results = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '_transient_insta-adswst%'" );
    $insta_transients = array();
    if(!empty($results)){
        foreach ($results as $result){
            $insta_transients[] = str_replace("_transient_", "", $result->option_name );
        }
    }
    if(!empty($insta_transients)){
        foreach ($insta_transients as $tratient){
            delete_transient( $tratient );
        }
    }

    wp_die();
}
add_action('wp_ajax_update-instagram', 'adswst_update_instagram_images');