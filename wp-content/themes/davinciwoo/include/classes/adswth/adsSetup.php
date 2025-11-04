<?php
/**
 * User: Denis Zharov
 * Date: 14.05.2018
 * Time: 11:38
 */

namespace adswth;

use adswth\adsTemplate;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class adsSetup {

    /** @var string Current theme name, used as namespace in actions. */
    protected $theme_name = '';

    protected $locale = 'en_US';

    protected $data = [];

    private $delay_posts = [];

    /**
     * TGMPA instance storage
     *
     * @var object
     */
    protected $tgmpa_instance;

    /**
     * TGMPA Menu slug
     *
     * @var string
     */
    protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

    /**
     * TGMPA Menu url
     *
     * @var string
     */
    protected $tgmpa_url = 'admin.php?page=tgmpa-install-plugins';

    public function __construct( $data = [] ) {
        $this->init_globals( $data );
        $this->init_actions();
    }

    public function init_globals( $data = [] ) {
        $this->data = $data;
        $this->theme_name = ( array_key_exists( 'theme_name', $data ) ) ? $this->data[ 'theme_name' ] : '';
        $this->locale = $this->_get_locale();
    }

    public function init_actions() {

        if( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
            add_action( 'init', [ $this, 'get_tgmpa_instanse' ], 30 );
            add_action( 'init', [ $this, 'set_tgmpa_url' ], 40 );
        }

        add_filter( 'tgmpa_load', [ $this, 'tgmpa_load' ], 10, 1 );
    }

    public function get_tgmpa_instanse(){
        $this->tgmpa_instance = call_user_func( [ get_class( $GLOBALS['tgmpa'] ), 'get_instance' ] );
    }

    public function set_tgmpa_url(){

        $this->tgmpa_menu_slug = ( property_exists($this->tgmpa_instance, 'menu') ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
        $this->tgmpa_menu_slug = apply_filters($this->theme_name . '_adswth_tgmpa_menu_slug', $this->tgmpa_menu_slug);

        $tgmpa_parent_slug = ( property_exists($this->tgmpa_instance, 'parent_slug') && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';

        $this->tgmpa_url = apply_filters($this->theme_name . '_adswth_tgmpa_url', $tgmpa_parent_slug.'?page='.$this->tgmpa_menu_slug);

    }
    public function tgmpa_load( $status ) {
        return is_admin() || current_user_can( 'install_themes' );
    }



    public function is_possible_upgrade(){
        return false;
    }

    public function _get_locale() {

        $locale = get_locale();

        if( in_array( $locale, [ 'es_AR', 'es_CL', 'es_CO', 'es_MX', 'es_PE', 'es_PR', 'es_ES', 'es_VE'] ) ){
            return 'es_ES';
        }

        return 'en_US';
    }

    public function _get_page_name_locale( $page_title ){

        $pages = [
            'es_ES' => [
                'Shop' => 'Tienda',
                'Cart' => 'Tu carrito de compras',
                'Checkout' => 'Realizar Pedido',
                'My Account' => 'Mi Cuenta',
                'Home' => 'Home',
                'Blog' => 'Blog',
                'Terms & Conditions' => 'Términos y Condiciones'
            ]
        ];

        if ( isset( $pages[ $this->locale] )
            && !empty( $pages[ $this->locale] )
            && isset( $pages[ $this->locale][ $page_title ] )
            && !empty( $pages[ $this->locale][ $page_title ] ) ){

            return $pages[ $this->locale][ $page_title ];
        }

        return $page_title;
    }

    public function _get_json( $file ) {

        if( is_file( ADSW_THEME_PATH . '/include/admin/demo/content/' . $this->locale . '/' . basename( $file ) ) ){
            $file_name = ADSW_THEME_PATH . '/include/admin/demo/content/' . $this->locale . '/' . basename( $file );
        }elseif( is_file( ADSW_THEME_PATH . '/include/admin/demo/content/' . 'en_US' . '/' . basename( $file ) ) ){
            $file_name = ADSW_THEME_PATH . '/include/admin/demo/content/' . 'en_US' . '/' . basename( $file );
        }else{
            return false;
        }

        WP_Filesystem();
        global $wp_filesystem;

        if ( file_exists( $file_name ) ) {

            $json = $wp_filesystem->get_contents( $file_name );
            $site_url = get_site_url();

            $find_h = '#^http(s)?://#';
            $find_w = '/^www\./';
            $domain = preg_replace( $find_h, '', $site_url );
            $domain = preg_replace( $find_w, '', $domain );

            $site_url = addslashes( $site_url );

            $json = str_replace( '##siteurl##', $site_url , $json );
            $json = str_replace( '##sitedomain##', $domain , $json );
            $json = str_replace( '##sitename##', get_bloginfo('name') , $json );

            return json_decode( $json , true );
        }

        return [];
    }

    private function _get_sql( $file ) {

        if( is_file( ADSW_THEME_PATH . '/include/admin/demo/content/' . $this->locale . '/' . basename( $file ) ) ){
            $file_name = ADSW_THEME_PATH . '/include/admin/demo/content/' . $this->locale . '/' . basename( $file );
        }elseif( is_file( ADSW_THEME_PATH . '/include/admin/demo/content/' . 'en_US' . '/' . basename( $file ) ) ){
            $file_name = ADSW_THEME_PATH . '/include/admin/demo/content/' . 'en_US' . '/' . basename( $file );
        }else{
            return false;
        }

        WP_Filesystem();
        global $wp_filesystem;
        if ( file_exists( $file_name ) ) {
            return $wp_filesystem->get_contents( $file_name );
        }

        return false;
    }

    private function _imported_term_id( $original_term_id , $new_term_id = false ){
        $terms = get_transient('importtermids');
        if(!is_array($terms))$terms = [];
        if($new_term_id){
            $terms[$original_term_id] = $new_term_id;
            set_transient('importtermids', $terms, 60 * 60 * 24 );
        }else if($original_term_id && isset($terms[$original_term_id])){
            return $terms[$original_term_id];
        }
        return false;
    }

    private function _imported_post_id( $original_id = false , $new_id = false ){
        if(is_array($original_id) || is_object($original_id))return false;
        $post_ids = get_transient('importpostids');
        if(!is_array($post_ids))$post_ids = array();
        if($new_id){
            $post_ids[$original_id] = $new_id;
            set_transient('importpostids', $post_ids, 60 * 60 * 24 );
        }else if($original_id && isset($post_ids[$original_id])){
            return $post_ids[$original_id];
        }else if($original_id === false){
            return $post_ids;
        }
        return false;
    }

    private function _wp_get_attachment_id_by_post_name( $post_name ) {
        global $wpdb;
        $str = $post_name;
        $posts = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_title = '$str' ", OBJECT );
        if($posts) return $posts[0]->ID;
    }

    private function _delay_post_process( $post_type, $post_data ){
        if(!isset($this->delay_posts[$post_type]))$this->delay_posts[$post_type]= array();
        $this->delay_posts[$post_type][] = $post_data;
    }

    public function cmpr_strlen( $a, $b ) {
        return strlen( $b ) - strlen( $a );
    }

    private function _post_orphans( $original_id = false, $missing_parent_id = false ){
        $post_ids = get_transient('postorphans');
        if(!is_array($post_ids))$post_ids = array();
        if($missing_parent_id){
            $post_ids[$original_id] = $missing_parent_id;
            set_transient('postorphans', $post_ids, 60 * 60 * 24 );
        }else if($original_id && isset($post_ids[$original_id])){
            return $post_ids[$original_id];
        }else if($original_id === false){
            return $post_ids;
        }
        return false;
    }

    private function _handle_post_orphans(){
        $orphans = $this->_post_orphans();
        foreach($orphans as $original_post_id => $original_post_parent_id){
            if($original_post_parent_id) {
                if ( $this->_imported_post_id( $original_post_id ) && $this->_imported_post_id( $original_post_parent_id ) ) {
                    $post_data = array();
                    $post_data['ID'] = $this->_imported_post_id( $original_post_id );
                    $post_data['post_parent'] = $this->_imported_post_id( $original_post_parent_id );
                    wp_update_post( $post_data );
                    $this->_post_orphans( $original_post_id, 0 ); // ignore future
                }
            }
        }
    }

    private function _fetch_remote_file( $url, $post ) {
        // extract the file name and extension from the url
        $file_name = basename( $url );
        $local_file = trailingslashit(get_template_directory()).'images/stock/'.$file_name;
        $upload = false;
        if( is_file( $local_file ) && filesize( $local_file ) > 0 ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            WP_Filesystem();
            global $wp_filesystem;
            $file_data = $wp_filesystem->get_contents( $local_file );
            $upload = wp_upload_bits( $file_name, 0, $file_data, $post['upload_date'] );
            if ( $upload['error'] ) {
                return new \WP_Error( 'upload_dir_error', $upload['error'] );
            }
        }

        if ( !$upload || $upload['error'] ) {
            // get placeholder file in the upload dir with a unique, sanitized filename
            $upload = wp_upload_bits( $file_name, 0, '', $post['upload_date'] );
            if ( $upload['error'] ) {
                return new \WP_Error( 'upload_dir_error', $upload['error'] );
            }

            // fetch the remote url and write it to the placeholder file
            //$headers = wp_get_http( $url, $upload['file'] );

            $max_size = (int) apply_filters( 'import_attachment_size_limit', 0 );

            // we check if this file is uploaded locally in the source folder.
            $response = wp_remote_get( $url );
            if ( is_array( $response ) && !empty($response['body']) && $response['response']['code'] == '200' ) {
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                $headers = $response['headers'];
                WP_Filesystem();
                global $wp_filesystem;
                $wp_filesystem->put_contents( $upload['file'], $response['body'] );
                //
            } else {
                // required to download file failed.
                @unlink( $upload['file'] );
                return new \WP_Error( 'import_file_error', __( 'Remote server did not respond', 'wordpress-importer' ) );
            }


            $filesize = filesize( $upload['file'] );

            if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
                @unlink( $upload['file'] );

                return new \WP_Error( 'import_file_error', __( 'Remote file is incorrect size', 'wordpress-importer' ) );
            }

            if ( 0 == $filesize ) {
                @unlink( $upload['file'] );

                return new \WP_Error( 'import_file_error', __( 'Zero size file downloaded', 'wordpress-importer' ) );
            }

            if ( ! empty( $max_size ) && $filesize > $max_size ) {
                @unlink( $upload['file'] );

                return new \WP_Error( 'import_file_error', sprintf( __( 'Remote file is too large, limit is %s', 'wordpress-importer' ), size_format( $max_size ) ) );
            }
        }

        // keep track of the old and new urls so we can substitute them later
        $this->_imported_post_id( $url, $upload['url']);
        $this->_imported_post_id( $post['guid'], $upload['url']);
        // keep track of the destination if the remote url is redirected somewhere else
        if ( isset( $headers['x-final-location'] ) && $headers['x-final-location'] != $url ) {
            $this->_imported_post_id( $headers['x-final-location'], $upload['url'] );
        }

        return $upload;
    }

    public function _content_default_get() {

        $content = [];

        // find out what content is in our default json file.
        $available_content = $this->_get_json( 'default.json' );

        foreach($available_content as $post_type => $post_data){

            if(count($post_data)){
                $first = current($post_data);
                $post_type_title = !empty($first['type_title']) ? $first['type_title'] : ucwords( $post_type ).'s';

                $content[$post_type] = array(
                    'title' => $post_type_title,
                    'description' => sprintf( __( 'Create default %s as seen in the demo.', 'davinciwoo' ), $post_type_title ),
                    'pending' => __( 'Pending.', 'davinciwoo' ),
                    'installing' => __( 'Installing.', 'davinciwoo' ),
                    'success' => __( 'Success.', 'davinciwoo' ),
                    'install_callback' => array( $this,'_content_install_type' ),
                    'checked' => $this->is_possible_upgrade() ? 0 : 1 // dont check if already have content installed.
                );
            }
        }


        $available_taxonomies = $this->_get_json( 'terms.json' );

        foreach($available_taxonomies as $taxomomy_type => $taxomomy_data){
            if(count($taxomomy_data)){
                $first = current($taxomomy_data);
                $taxomomy_type_title = !empty($first['type_title']) ? $first['type_title'] : ucwords( $taxomomy_data ).'s';

                $content[$taxomomy_type] = array(
                    'title' => $taxomomy_type_title,
                    'description' => sprintf( __( 'Create default %s as seen in the demo.', 'davinciwoo' ), $taxomomy_type_title ),
                    'pending' => __( 'Pending.', 'davinciwoo' ),
                    'installing' => __( 'Installing.', 'davinciwoo' ),
                    'success' => __( 'Success.', 'davinciwoo' ),
                    'install_callback' => array( $this,'_taxonomy_install_type' ),
                    'checked' => $this->is_possible_upgrade() ? 0 : 1 // dont check if already have content installed.
                );
            }
        }

        $available_content = $this->_get_json( 'menu_items.json' );

        foreach($available_content as $post_type => $post_data){
            if(count($post_data)){
                $first = current($post_data);
                $post_type_title = 'Navigation';
                $content[$post_type] = array(
                    'title' => $post_type_title,
                    'description' => sprintf( __( 'Create default %s as seen in the demo.', 'davinciwoo' ), $post_type_title ),
                    'pending' => __( 'Pending.', 'davinciwoo' ),
                    'installing' => __( 'Installing.', 'davinciwoo' ),
                    'success' => __( 'Success.', 'davinciwoo' ),
                    'install_callback' => array( $this,'_content_install_type' ),
                    'checked' => $this->is_possible_upgrade() ? 0 : 1 // dont check if already have content installed.
                );
            }
        }

        $content['widgets'] = array(
            'title' => __( 'Widgets', 'davinciwoo' ),
            'description' => __( 'Add default sidebar widgets as seen in the demo.', 'davinciwoo' ),
            'pending' => __( 'Pending.', 'davinciwoo' ),
            'installing' => __( 'Installing Default Widgets.', 'davinciwoo' ),
            'success' => __( 'Success.', 'davinciwoo' ),
            'install_callback' => array( $this,'_content_install_widgets' ),
            'checked' => $this->is_possible_upgrade() ? 0 : 1 // dont check if already have content installed.
        );

        $content['settings'] = array(
            'title' => __( 'Settings', 'davinciwoo' ),
            'description' => __( 'Apply default settings.', 'davinciwoo' ),
            'pending' => __( 'Pending.', 'davinciwoo' ),
            'installing' => __( 'Installing Default Settings.', 'davinciwoo' ),
            'success' => __( 'Success.', 'davinciwoo' ),
            'install_callback' => array( $this,'_content_install_settings' ),
            'checked' => $this->is_possible_upgrade() ? 0 : 1 // dont check if already have content installed.
        );

        $content = apply_filters( $this->theme_name . '_theme_setup_wizard_content', $content );

        return $content;
    }

    public function delete_default_content($data){
        wp_delete_post(1, true);
        wp_delete_post(2, true);
        wp_delete_post(3, true);

        return $data;
    }

    public function set_content( $data ) {

        $content = $this->_content_default_get();

        if ( ! wp_verify_nonce( $data[ 'setup_demo' ], 'setup' ) || empty( $data['demo_default_content'] ) ) {
            wp_send_json_error( [ 'error' => 1, 'message' => __( 'No content Found', 'davinciwoo' ) ] );
        }

        $current =  current( array_keys( $data[ 'demo_default_content' ] ) );
        $this->data = $content[$current];
        $this->data['content'] = $current;

        if ( ! empty( $this->data['install_callback'] ) ) {
            if ( $result = call_user_func( $this->data['install_callback'], $this->data['content'] ) ) {
                $data['current'] = $this->data['content'];
                unset( $data['demo_default_content'][$current] );
            }else{
                $data['message'] = $this->data['success'];
            }
            $data['result'] = $this->data['content'];
        }



        if( count ( $data['demo_default_content'] ) == 0 ){
            $data['message'] = __( 'Demo content was installed successfully', 'davinciwoo' );
        }
        return $data;
    }

    private function _content_install_type( $type = '' ){
        $post_type = !empty($this->data['content']) ? $this->data['content'] : false;

        if( $type == 'nav_menu_item' ){
            $all_data = $this->_get_json('menu_items.json');
        } else {
            $all_data = $this->_get_json('default.json');
        }

        if(!$post_type || !isset($all_data[$post_type])){
            return false;
        }
        $limit = 40 + (isset($_REQUEST['retry_count']) ? (int)$_REQUEST['retry_count'] : 0);
        $x = 0;
        foreach($all_data[$post_type] as $post_data){

            $this->_process_post_data($post_type, $post_data);

            if($x++ > $limit){
                return array('retry' => 1, 'retry_count' => $limit);
            }

        }

        foreach($this->delay_posts as $delayed_post_type => $delayed_post_datas){
            foreach($delayed_post_datas as $delayed_post_id => $delayed_post_data){
                unset($this->delay_posts[$delayed_post_type][$delayed_post_id]);
                //echo "Processing delayed post $delayed_post_type id ".$delayed_post_data['post_id']."\n\n";
                $this->_process_post_data($delayed_post_type, $delayed_post_data);
            }
        }
        foreach($this->delay_posts as $delayed_post_type => $delayed_post_datas){
            foreach($delayed_post_datas as $delayed_post_id => $delayed_post_data){
                unset($this->delay_posts[$delayed_post_type][$delayed_post_id]);
                //echo "Processing delayed post $delayed_post_type id ".$delayed_post_data['post_id']."\n\n";
                $this->_process_post_data($delayed_post_type, $delayed_post_data, true);
            }
        }

        $this->_handle_post_orphans();

        // now we have to handle any custom SQL queries. This is needed for the events manager to store location and event details.
        $sql = $this->_get_sql(basename($post_type).'.sql');
        if($sql){
            global $wpdb;
            // do a find-replace with certain keys.
            if(preg_match_all('#__POSTID_(\d+)__#',$sql,$matches)){
                foreach($matches[0] as $match_id => $match){
                    $new_id = $this->_imported_post_id($matches[1][$match_id]);
                    if(!$new_id)$new_id = 0;
                    $sql = str_replace($match,$new_id,$sql);
                }
            }
            $sql = str_replace("__DBPREFIX__",$wpdb->prefix,$sql);
            $bits = preg_split("/;(\s*\n|$)/", $sql);
            foreach($bits as $bit){
                $bit = trim($bit);
                if($bit){
                    $wpdb->query($bit);
                }
            }
        }

        return true;
    }

    private function _taxonomy_install_type(){
        $taxonomy_type = !empty($this->data['content']) ? $this->data['content'] : false;
        $all_data = $this->_get_json('terms.json');
        if(!$taxonomy_type || !isset($all_data[$taxonomy_type])){
            return false;
        }

        foreach($all_data[$taxonomy_type] as $term_data){

            $this->_process_term_data($taxonomy_type, $term_data);
        }
        return true;
    }

    private function _process_term_data($taxonomy_type, $term) {

        if(taxonomy_exists($taxonomy_type)) {
            $term_exists = term_exists( $term['slug'], $taxonomy_type );
            $term_id     = is_array( $term_exists ) ? $term_exists['term_id'] : $term_exists;
            if ( ! $term_id ) {
                if(!empty( $term['parent'] )){
                    // see if we have imported this yet?
                    $term['parent'] = $this->_imported_term_id($term['parent']);
                }

                $t = wp_insert_term( $term['name'], $taxonomy_type, $term );
                if ( ! is_wp_error( $t ) ) {
                    $term_id = $t['term_id'];
                    //do_action( 'wp_import_insert_term', $t, $term, $post_id, $post );
                } else {
                    // todo - error
                }
            }
            $this->_imported_term_id($term['term_id'], $term_id);
            $terms_to_set[ $taxonomy_type ][] = intval( $term_id );
        }


    }

    private function _content_install_widgets() {
        // todo: pump these out into the 'content/' folder along with the XML so it's a little nicer to play with
        $import_widget_positions = $this->_get_json( 'widget_positions.json' );
        $import_widget_options = $this->_get_json( 'widget_options.json' );

        // importing.
        $widget_positions = get_option( 'sidebars_widgets' );

        foreach ( $import_widget_options as $widget_name => $widget_options ) {
            // replace certain elements with updated imported entries.
            foreach($widget_options as $widget_option_id => $widget_option){
                if(!empty($widget_option['nav_menu'])){
                    // check if this one has been imported yet.
                    $new_id = $this->_imported_term_id($widget_option['nav_menu']);
                    if(!$new_id){
                        unset($widget_options[$widget_option_id]);
                    }else{
                        $widget_options[$widget_option_id]['nav_menu'] = $new_id;
                    }
                }
                if(!empty($widget_option['image_id'])){
                    // check if this one has been imported yet.
                    $new_id = $this->_imported_post_id($widget_option['image_id']);
                    if(!$new_id){
                        unset($widget_options[$widget_option_id]);
                    }else{
                        $widget_options[$widget_option_id]['image_id'] = $new_id;
                    }
                }
            }
            $existing_options = get_option( 'widget_'.$widget_name,array() );
            $new_options = $existing_options + $widget_options;

            update_option( 'widget_'.$widget_name,$new_options );
        }
        update_option( 'sidebars_widgets',array_merge( $widget_positions,$import_widget_positions ) );

        return true;

    }
    public function _content_install_settings() {

        $custom_options = $this->_get_json( 'options.json' );

        $options_page_id = [
            "gdpr_banner_privacy_policy_page_id",
            "gdpr_banner_terms_and_conditions_page_id",
            "yith_wcwl_wishlist_page_id"
        ];
        if( !empty( $custom_options ) && is_array( $custom_options ) && count( $custom_options ) > 0 ) {
            foreach ($custom_options as $option => $value) {

                if ( preg_match( '#(wam__position_)(\d+)_#', $option, $matches ) ||
                    preg_match( '#(wam__area_)(\d+)_#', $option, $matches ) ) {

                    $new_page_id = $this->_imported_post_id($matches[2]);
                    if ($new_page_id) {
                        // we have a new page id for this one. import the new setting value.
                        $option = str_replace($matches[1] . $matches[2] . '_', $matches[1] . $new_page_id . '_', $option);
                    }
                }
                if( in_array( $option, $options_page_id ) ){
                    $value = $this->_imported_post_id( $value );
                }
                update_option($option, $value);
            }
        }

	    $theme_options = $this->_get_json( 'theme_options.json' );
	    if( !empty( $theme_options ) && is_array( $theme_options ) && count( $theme_options ) > 0 ) {

		    update_option('theme_mods_' . $this->theme_name, $theme_options);
	    }

        // set the blog page and the home page.
        $shoppage = adswth_get_page_by_title( $this->_get_page_name_locale( 'Shop' ) );
        if ( $shoppage ) {
            update_option( 'woocommerce_shop_page_id',$shoppage->ID );
        }
        $shoppage = adswth_get_page_by_title( $this->_get_page_name_locale('Cart' ) );
        if ( $shoppage ) {
            update_option( 'woocommerce_cart_page_id',$shoppage->ID );
        }
        $shoppage = adswth_get_page_by_title( $this->_get_page_name_locale( 'Checkout' ) );
        if ( $shoppage ) {
            update_option( 'woocommerce_checkout_page_id',$shoppage->ID );
        }
        $shoppage = adswth_get_page_by_title( $this->_get_page_name_locale( 'My Account' ) );
        if ( $shoppage ) {
            update_option( 'woocommerce_myaccount_page_id',$shoppage->ID );
        }
        $shoppage = adswth_get_page_by_title( $this->_get_page_name_locale( 'Terms & Conditions' ) );
        if ( $shoppage ) {
            update_option( 'woocommerce_terms_page_id', $shoppage->ID );
        }
        $homepage = adswth_get_page_by_title( $this->_get_page_name_locale( 'Home' ) );
        if ( $homepage ) {
            update_option( 'page_on_front', $homepage->ID );
            update_option( 'show_on_front', 'page' );
        }
        $blogpage = adswth_get_page_by_title( $this->_get_page_name_locale('Blog' ) );
        if ( $blogpage ) {
            update_option( 'page_for_posts', $blogpage->ID );
            update_option( 'show_on_front', 'page' );
        }

        $menu_ids = $this->_get_json( 'menu.json' );
        $save = array();
        if( !empty( $menu_ids ) && is_array($menu_ids) && count( $menu_ids ) > 0 ) {
            foreach ($menu_ids as $menu_id => $term_id) {
                $new_term_id = $this->_imported_term_id($term_id);
                if ($new_term_id) {
                    $save[$menu_id] = $new_term_id;
                }
            }
        }
        if ( $save ) {
            set_theme_mod( 'nav_menu_locations', array_map( 'absint', $save ) );
        }

        // Fix wishlist button position
        update_option( 'yith_wcwl_button_position', 'shortcode' );
        // Enable ajax in wishlist
        update_option('yith_wcwl_ajax_enable', 'yes', 'yes');

        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        update_option( "rewrite_rules", FALSE );
        $wp_rewrite->flush_rules( true );
        flush_rewrite_rules();

        return true;
    }

    private function _process_post_data( $post_type, $post_data, $delayed = false ){

        if ( ! post_type_exists( $post_type ) ) {
            return false;
        }
        /*if ( 'nav_menu_item' == $post_type ) {
            $this->process_menu_item( $post );
            continue;
        }*/

        if(empty($post_data['post_title']) && empty($post_data['post_name'])){
            // this is menu items
            $post_data['post_name'] = $post_data['post_id'];
        }

        $post_data['post_type'] = $post_type;

        $post_parent = (int) $post_data['post_parent'];
        if ( $post_parent ) {
            // if we already know the parent, map it to the new local ID
            if ( $this->_imported_post_id( $post_parent ) ) {
                $post_data['post_parent'] = $this->_imported_post_id( $post_parent );
                // otherwise record the parent for later
            } else {
                $this->_post_orphans( intval( $post_data['post_id'] ) , $post_parent);
                $post_data['post_parent'] = 0;
            }
        }

        // check if already exists
        if( empty($post_data['post_title']) && !empty($post_data['post_name'])){
            global $wpdb;
            $sql = "
					SELECT ID, post_name, post_parent, post_type
					FROM $wpdb->posts
					WHERE post_name = %s
					AND post_type = %s
				";
            $pages = $wpdb->get_results( $wpdb->prepare($sql,array($post_data['post_name'], $post_type)), OBJECT_K );
            $foundid = 0;
            foreach ( (array) $pages as $page ) {
                if($page->post_name == $post_data['post_name'] && empty($page->post_title)){
                    $foundid = $page->ID;
                }
            }
            if($foundid){
                $this->_imported_post_id( $post_data['post_id'], $foundid );
                return true;
            }
        }
        $post_exists = post_exists( $post_data['post_title'] ); //, '', $post_data['post_date_gmt'] );
        if ( $post_exists && get_post_type( $post_exists ) == $post_type ) {
            $existing_post = get_post($post_exists);
            if(!empty($post_data['post_title']) || (empty($post_data['post_title']) && $existing_post->post_name == $post_data['post_name'])) {
                // this is the same.
                $this->_imported_post_id( $post_data['post_id'], $post_exists );
//					echo $post_data['post_id'] . " title " . $post_data['post_title'] . " already exists 1: $post_exists\n";
                return true;
            }
        }

        switch($post_type){
            case 'attachment':
                // import media via url
                if(!empty($post_data['guid'])){

                    // check if this has already been imported.
                    $old_guid = $post_data['guid'];
                    if($this->_imported_post_id( $old_guid)){
                        return true; // alrady done;
                    }
                    // ignore post parent, we haven't imported those yet.
//							$file_data = wp_remote_get($post_data['guid']);
                    $remote_url = $post_data['guid'];

                    $post_data['upload_date'] = date('Y/m',strtotime($post_data['post_date_gmt']));
                    if ( isset( $post_data['meta'] ) ) {
                        foreach ( $post_data['meta'] as $key => $meta ) {
                            if ( $key == '_wp_attached_file' ) {
                                foreach((array)$meta as $meta_val) {
                                    if ( preg_match( '%^[0-9]{4}/[0-9]{2}%', $meta_val, $matches ) ) {
                                        $post_data['upload_date'] = $matches[0];
                                    }
                                }
                            }
                        }
                    }

                    $upload = $this->_fetch_remote_file( $remote_url, $post_data );

                    if ( !is_array($upload) || is_wp_error( $upload ) ) {
                        // todo: error
                        return false;
                    }

                    if ( $info = wp_check_filetype( $upload['file'] ) ) {
                        $post['post_mime_type'] = $info['type'];
                    } else {
                        return false;
//								return new WP_Error( 'attachment_processing_error', __( 'Invalid file type', 'wordpress-importer' ) );
                    }

                    $post_data['guid'] = $upload['url'];

                    // as per wp-admin/includes/upload.php
                    $post_id = wp_insert_attachment( $post_data, $upload['file'] );
                    wp_update_attachment_metadata( $post_id, wp_generate_attachment_metadata( $post_id, $upload['file'] ) );

                    // remap resized image URLs, works by stripping the extension and remapping the URL stub.
                    if ( preg_match( '!^image/!', $info['type'] ) ) {
                        $parts = pathinfo( $remote_url );
                        $name = basename( $parts['basename'], ".{$parts['extension']}" ); // PATHINFO_FILENAME in PHP 5.2

                        $parts_new = pathinfo( $upload['url'] );
                        $name_new = basename( $parts_new['basename'], ".{$parts_new['extension']}" );

                        $this->_imported_post_id( $parts['dirname'] . '/' . $name , $parts_new['dirname'] . '/' . $name_new );
                    }
                    $this->_imported_post_id( $post_data['post_id'], $post_id );
                    $this->_imported_post_id( $old_guid, $post_id );

                }
                break;
            default:
                // work out if we have to delay this post insertion
                if ( ! empty( $post_data['meta'] ) ) {
                    foreach ( $post_data['meta'] as $meta_key => $meta_val ) {

                        // export gets meta straight from the DB so could have a serialized string
                        $meta_val = maybe_unserialize( $meta_val );
                        if ( is_array( $meta_val ) && count( $meta_val ) == 1 ) {
                            $meta_val = current( $meta_val );
                        }

                        if ( $meta_key == '_menu_item_object_id' && $meta_val ) {
                            $menu_item_type = $post_data['meta']['_menu_item_type'];

                            if( in_array( 'taxonomy', $menu_item_type ) ){
                                $meta_val = $this->_imported_term_id( $meta_val );
                            } else{
                                $meta_val = $this->_imported_post_id( $meta_val );
                            }

                            if ( ! $meta_val ) {
                                if ( $delayed ) {
                                    return false;
                                } else {
                                    $this->_delay_post_process( $post_type, $post_data );

                                    return true;
                                }
                            }
                        }

                        if ( $meta_key == '_menu_item_menu_item_parent' && $meta_val ) {

                            $meta_val = $this->_imported_post_id( $meta_val );

                            if ( ! $meta_val ) {
                                if ( $delayed ) {
                                    return false;
                                } else {
                                    $this->_delay_post_process( $post_type, $post_data );

                                    return true;
                                }
                            }
                        }
                    }
                }

                $imported_images = [
                    10001 => $this->_wp_get_attachment_id_by_post_name('shopper_banner_1'),
                ];

                // Fix Meta
                if( isset( $post_data[ 'meta' ][ '_thumbnail_id' ][0] ) ){
                    $th_id = $post_data[ 'meta' ][ '_thumbnail_id' ][0] ;
                    $post_data[ 'meta' ][ '_thumbnail_id' ] =
                        ( isset( $imported_images[ $th_id ] ) ) ?
                            $imported_images[ $th_id ] : '';
                }


                // Product Galleries
//                if(isset($post_data['meta']['_product_image_gallery'])
//                    && is_array($post_data['meta']['_product_image_gallery'])){
//                    $post_data['meta']['_product_image_gallery'] = $prod_image.','.$prod_image.','.$prod_image;
//                }


                // we have to format the post content. rewriting images and gallery stuff
                $replace = $this->_imported_post_id();
                $urls_replace = array();
                foreach($replace as $key=>$val){
                    if($key && $val && !is_numeric($key) && !is_numeric($val)){
                        $urls_replace[$key] = $val;
                    }
                }
                if( $urls_replace && count($urls_replace) > 0) {
                    uksort( $urls_replace, array( &$this, 'cmpr_strlen' ) );
                    foreach ( $urls_replace as $from_url => $to_url ) {
                        $post_data['post_content'] = str_replace($from_url, $to_url, $post_data['post_content']);
                    }
                }

                if(preg_match_all('#\[gallery[^\]]*\]#',$post_data['post_content'],$matches)){
                    foreach($matches[0] as $match_id => $string){
                        if(preg_match('#ids="([^"]+)"#',$string,$ids_matches)){
                            $ids = explode(",",$ids_matches[1]);
                            foreach($ids as $key=>$val){
                                $new_id = $val ? $this->_imported_post_id($val) : false;
                                if(!$new_id)unset($ids[$key]);
                                else $ids[$key] = $new_id;
                            }
                            $new_ids = implode(',',$ids);
                            $post_data['post_content'] = str_replace($ids_matches[0], 'ids="'.$new_ids.'"', $post_data['post_content']);
                        }
                    }
                }

                if(preg_match_all('#\[contact-form-7[^\]]*\]#',$post_data['post_content'],$matches)){
                    foreach($matches[0] as $match_id => $string){
                        if(preg_match('#id="(\d+)"#',$string,$id_match)){
                            $new_id = $this->_imported_post_id($id_match[1]);
                            if($new_id) {
                                $post_data['post_content'] = str_replace($id_match[0], 'id="'.$new_id.'"', $post_data['post_content']);
                            } else {
                                // no imported ID found. remove this entry.
                                $post_data['post_content'] = str_replace($matches[0], '(insert contact form here)', $post_data['post_content']);
                            }
                        }
                    }
                }

                if(preg_match_all('#\[metaslider[^\]]*\]#',$post_data['post_content'],$matches)){
                    foreach($matches[0] as $match_id => $string){
                        if(preg_match('#id="(\d+)"#',$string,$id_match)){
                            $new_id = $this->_imported_post_id($id_match[1]);
                            if($new_id) {
                                $post_data['post_content'] = str_replace($id_match[0], 'id="'.$new_id.'"', $post_data['post_content']);
                            } else {
                                // no imported ID found. remove this entry.
                                $post_data['post_content'] = str_replace($matches[0], '(insert MetaSlider here)', $post_data['post_content']);
                            }
                        }
                    }
                }

                $time = current_time('mysql');
                $post_data[ 'post_date' ] = $time;
                $post_data[ 'post_date_gmt' ] = get_gmt_from_date($time);

                $post_id = wp_insert_post( $post_data, true );
//					echo "Processing ".$post_data['post_id']." \n\n";
                if ( !is_wp_error( $post_id ) ) {
                    $this->_imported_post_id( $post_data['post_id'], $post_id );
                    // add/update post meta

                    if ( ! empty( $post_data['meta'] ) ) {
                        foreach ( $post_data['meta'] as $meta_key => $meta_val ) {

                            // export gets meta straight from the DB so could have a serialized string
                            $meta_val = maybe_unserialize( $meta_val );
                            if(is_array($meta_val) && count($meta_val) == 1){
                                $meta_val = current($meta_val);
                            }

                            if( $meta_key == '_menu_item_object_id'  && $meta_val ){
                                // we get the linked page id that we should have previously entered.
                                $menu_item_type = $post_data['meta']['_menu_item_type'];

                                if( in_array( 'taxonomy', $menu_item_type ) ){
                                    $meta_val = $this->_imported_term_id( $meta_val );
                                } else{
                                    $meta_val = $this->_imported_post_id( $meta_val );
                                }

                                if(!$meta_val){
                                    continue;
                                }
                            }

                            if( $meta_key == '_menu_item_menu_item_parent' && $meta_val ){

                                $meta_val = $this->_imported_post_id( $meta_val );

                                if( !$meta_val ){
                                    continue;
                                }
                            }

                            $meta_val = maybe_unserialize( $meta_val );

                            // if the post has a featured image, take note of this in case of remap
                            if ( '_thumbnail_id' == $meta_key ) {
                                /// find this inserted id and use that instead.
                                $inserted_id = $this->_imported_post_id( intval( $meta_val ) );
                                if($inserted_id){
                                    $meta_val = $inserted_id;
                                }
                            }
//									echo "Post meta $meta_key was $meta_val \n\n";

                            update_post_meta( $post_id, $meta_key, $meta_val );

                        }
                    }
                    if ( ! empty( $post_data['terms'] ) ) {
                        $terms_to_set = array();
                        foreach ( $post_data['terms'] as $term_slug => $terms ) {
                            foreach($terms as $term) {
                                //									echo "Adding category;";print_r($term);echo "\n\n";
                                /*"term_id": 21,
                                "name": "Tea",
                                "slug": "tea",
                                "term_group": 0,
                                "term_taxonomy_id": 21,
                                "taxonomy": "category",
                                "description": "",
                                "parent": 0,
                                "count": 1,
                                "filter": "raw"*/
                                $taxonomy    =  $term['taxonomy'];

                                //ml-slider
                                if( $taxonomy == 'ml-slider'){
                                    $term['name'] = strval($this->_imported_post_id( intval( $term['name'] ) ) );
                                    $term['slug'] = strval( $this->_imported_post_id( intval( $term['slug'] ) ) );
                                }

                                if(taxonomy_exists($taxonomy)) {
                                    $term_exists = term_exists( $term['slug'], $taxonomy );
                                    $term_id     = is_array( $term_exists ) ? $term_exists['term_id'] : $term_exists;
                                    if ( ! $term_id ) {
                                        if(!empty( $term['parent'] )){
                                            // see if we have imported this yet?
                                            $term['parent'] = $this->_imported_term_id($term['parent']);
                                        }

                                        $t = wp_insert_term( $term['name'], $taxonomy, $term );
                                        if ( ! is_wp_error( $t ) ) {
                                            $term_id = $t['term_id'];
                                            //do_action( 'wp_import_insert_term', $t, $term, $post_id, $post );
                                        } else {
                                            // todo - error
                                            continue;
                                        }
                                    }
                                    $this->_imported_term_id($term['term_id'], $term_id);
                                    $terms_to_set[ $taxonomy ][] = intval( $term_id );
                                }
                            }
                        }
                        foreach ( $terms_to_set as $tax => $ids ) {
                            wp_set_post_terms( $post_id, $ids, $tax );
                        }
                    }
                }

                break;
        }
        return true;
    }

    public function _get_plugins() {

        $instance = call_user_func( [ get_class( $GLOBALS['tgmpa'] ), 'get_instance' ] );

        $plugins = [
            'items'      => [], // Meaning: all plugins which still have open actions.
        ];

        $theme_plugins = $this->_get_json( 'plugins.json' );

        foreach ( $theme_plugins as $slug => $theme_plugin ) {

            $plugin = $instance->plugins[ $slug ];

            $plugin[ 'required' ] = \TGMPA_Utils::validate_bool( $theme_plugin[ 'required' ] == 'true' );
            $plugin[ 'type' ] = ( $plugin[ 'required' ] ) ? __( 'Required', 'davinciwoo' ) : __( 'Recommended', 'davinciwoo' );


            if ( ! $instance->is_plugin_installed( $slug ) ) {
                $plugin[ 'status' ] = 'install';
                $plugin[ 'status_slug' ] = 'Not installed';
            } else {

                if ( $instance->can_plugin_activate( $slug ) ) {
                    $plugin[ 'status' ] = 'activate';
                    $plugin[ 'status_slug' ] = 'Inactive';
                }

                if ( $instance->is_plugin_active($slug) ){
                    $plugin[ 'status' ] = 'active';
                    $plugin[ 'status_slug' ] = 'Active';
                }
            }

            $plugin[ 'checked' ] = \TGMPA_Utils::validate_bool( $theme_plugin[ 'checked' ] );
            $plugins['items'][ $slug ] = $plugin;

        }
        //pr($plugins);
        return $plugins;
    }

    public function render_plugins(){

        $tmpl = new adsTemplate();

        $template = '';

        $tmpl->addItem( 'nonce', [
            'name'  => 'setup_plugins',
            'value' => 'setup_plugins'
        ] );

        $tmpl->addItem( 'hidden', [
            'name'  => 'theme_name',
            'value' => $this->data[ 'theme_name' ]
        ] );

        $template .= $tmpl->renderItems();

        $template .= sprintf(
            '<div class="table-container container form-group">
                <div class="row table-head orders-head">
                    <div class="col-1">%s</div>
                    <div class="d-none d-sm-block col-sm-6 col-lg-6">%s</div>
                    <div class="d-none d-sm-block col-sm-3 col-lg-3">%s</div>
                    <div class="d-none d-sm-block col-sm-2 col-lg-2">%s</div>
                </div>',
            $tmpl->checkbox( [ 'value' => '1', 'id' => 'checkAll' ] ),
            __( 'Name', 'davinciwoo' ),
            __( 'Type', 'davinciwoo' ),
            __( 'Status', 'davinciwoo' )
        );

        $template .=
            '{{#each items}}
                <div class="row table-item item" data-id="{{slug}}">
                    <div class="col-1">
                        <div class="checkbox">
                            <label>
				                <input type="checkbox" id="check-item-{{slug}}" name="plugin_id[]" value="{{slug}}" class="uniform-checkbox" {{checkedIf checked}} >
			                </label>
			            </div>
			        </div>
                    <div class="col-sm-6 col-lg-6">
	                    <div>{{name}}</div>	                    
	                    <ul class="d-sm-none">
	                    	<li><strong>'.__( 'Type', 'davinciwoo' ).'</strong>: {{type}}</li>
	                    	<li><strong>'.__( 'Status', 'davinciwoo' ).'</strong>: {{status_slug}}</li>
						</ul> 
                    </div>
                    <div class="d-none d-sm-block col-sm-3 col-lg-3">{{type}}</div>
                    <div class="d-none d-sm-block col-sm-2 col-lg-2 status">{{status_slug}}</div>
                </div>
            {{/each}}';




        $template .= '</div>';

        $template .= '</div>';
        $tmpl->addItem( 'button', [
            'value'      => __( 'Install Plugins', 'davinciwoo' ),
            'name'       => 'setup-plugins',
            'id'         => 'setup-plugins',
            'class'      => 'ads-no btn btn-green'
        ] );


        $template .= $tmpl->renderItems();
        $template .= '</div>';
        $tmpl->template( 'adswth-adswth_plugins-form', $template );
    }

    public function list_plugins( $data = [] ){

        if( array_key_exists( 'plugin_id', $data ) ){
            $list = $data['plugin_id'];

            $plugins = $this->_get_plugins();
            $foo = [];
            foreach ($list as $item){
                $foo['items'][$item] = $plugins['items'][$item];
            }
            $foo[ 'setup_plugins' ] = $data[ 'setup_plugins' ];
            $foo[ 'current' ] = $this->get_next_plugin( $foo );
        }
        return $foo;
    }

    public function get_next_plugin( $data ){

        $current = '';
        if( array_key_exists( 'current', $data ) ){
            $keys = array_keys( $data['items'] );
            $i = array_search( $data[ 'current' ], $keys );
            $current = ( isset( $keys[$i+1] ) ) ? $keys[$i+1] : false;
        } else {
            $current = key( $data['items']  );
        }
        return $current;
    }

    public function proceed_plugin( $data ){
        if ( ! wp_verify_nonce( $data[ 'setup_plugins' ], 'setup_plugins' ) || empty( $data['current'] ) || empty( $data['items'] ) ) {
            return [ 'error' => 1, 'message' => __( 'No plugins Found', 'davinciwoo' ) ] ;
        }

        $current = $data['items'][$data['current']];
        $action = '';
        $message = '';

        while( $current[ 'status' ] == 'active' ) {
            $slug = $this->get_next_plugin( $data );

            if($slug) {
                $data['current'] = $slug;
                $current = $data['items'][$data['current']];
            }else{
                return [ 'done' => 1, 'message' => __( 'Plugins instalation complete','davinciwoo' ) ];
            }
        }

        if( $current[ 'status' ] == 'install' ) {
            $action = 'tgmpa-bulk-install';
            $message = __( 'Installing', 'davinciwoo' );
        }
        if( $current[ 'status' ] == 'activate' ) {
            $action = 'tgmpa-bulk-activate';
            $message = __( 'Activating', 'davinciwoo' );
        }


        if( $action != '' ){
            $json = [
                'url' => admin_url( $this->tgmpa_url ),
                'plugin' => array( $data['current'] ),
                'tgmpa-page' => $this->tgmpa_menu_slug,
                'plugin_status' => 'all',
                '_wpnonce' => wp_create_nonce( 'bulk-plugins' ),
                'action' => $action,
                'action2' => -1,
                'message' => $message,
            ];
            $json['hash'] = md5( serialize( $json ) );
            $data[ 'plugin_action' ] = $json;
            return $data;
        } else{
            return  [ 'done' => 1, 'message' => __( 'Success','davinciwoo' ) ];
        }
    }

    public function _check_child_theme (){

	    $theme = is_child_theme() ? wp_get_theme( get_option('stylesheet') )->Name : 'DavinciWoo Child';

	    return [
	    	'child_theme_title' => $theme
	    ];
    }

	public function _make_child_theme( $data ) {

    	if( ! isset( $data['child_theme_title'] ) || empty( $data['child_theme_title'] ) ) {
		    return [ 'error' => __( 'No name for Child Theme', 'davinciwoo' ) ];
	    }

		$new_theme_title = $data['child_theme_title'];

		$parent_theme_template = 'davinciwoo';

		// Turn a theme name into a directory name
		$new_theme_name = sanitize_title( $new_theme_title );
		$theme_root = get_theme_root();

		// Validate theme name
		$new_theme_path = $theme_root.'/'.$new_theme_name;
		if ( file_exists( $new_theme_path ) ) {
			return [ 'error' => __( 'Child Theme', 'davinciwoo' ) . ' <strong>'.$new_theme_title.'</strong> ' . __('already exists.', 'davinciwoo') , 'theme_name' => $new_theme_name ];
		} else{
			// Create Child theme
			mkdir( $new_theme_path );

			$plugin_folder = ADSW_THEME_PATH .'/include/admin/demo/child-theme/';

			// Make style.css
			ob_start();
			require $plugin_folder.'child-theme-css.php';
			$css = ob_get_clean();
			file_put_contents( $new_theme_path.'/style.css', $css );

			// Copy functions.php
			copy( $plugin_folder.'functions.php', $new_theme_path.'/functions.php' );

			// Copy screenshot
			copy( $plugin_folder.'screenshot.jpg', $new_theme_path.'/screenshot.jpg' );

            mkdir($new_theme_path.'/woocommerce');
			copy( $plugin_folder.'woocommerce/wishlist.js', $new_theme_path.'/woocommerce/wishlist.js' );

			// Make child theme an allowed theme (network enable theme)
			$allowed_themes = get_site_option( 'allowedthemes' );
			$allowed_themes[ $new_theme_name ] = true;
			update_site_option( 'allowedthemes', $allowed_themes );
		}

		// Switch to theme
		if($parent_theme_template !== $new_theme_name){
			switch_theme( $new_theme_name, $new_theme_name );
			return [
				'done' => 1,
				'message' => __( 'Child Theme', 'davinciwoo' ) . ' <strong>'.$new_theme_title.'</strong> ' . __('created and activated! Folder is located in', 'davinciwoo' ) . ' wp-content/themes/<strong>'.$new_theme_name.'</strong>',
				'theme_name' => $new_theme_name
			];
		}
	}
}