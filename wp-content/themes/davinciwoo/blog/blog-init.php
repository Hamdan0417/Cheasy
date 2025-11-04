<?php

require ADSW_THEME_PATH . '/blog/blog-functions.php';

function adswth_blog_scripts() {

    if( is_blog() || is_blog_search() ){

        wp_enqueue_style( 'adswth-css-blog', ADSW_THEME_URL . '/blog/assets/css/style' . ADSW_THEME_MIN . '.css', [ 'davinciwoo-style' ], ADSW_THEME_VERSION, 'all' );


        wp_enqueue_script( 'adswth-js-blog', ADSW_THEME_URL .'/blog/assets/js/blog' . ADSW_THEME_MIN . '.js', [ 'jquery' ], ADSW_THEME_VERSION, true );
        wp_enqueue_script( 'adswth-js-search-post', ADSW_THEME_URL .'/blog/assets/js/search-post' . ADSW_THEME_MIN . '.js', [ 'jquery', 'davinciwoo-js-handlebars', 'adswth-js-blog' ], ADSW_THEME_VERSION, true );
        wp_enqueue_script( 'adswth-js-match-height', ADSW_THEME_URL .'/blog/assets/js/jquery.matchHeight.js', [ 'jquery', 'adswth-js-blog' ], ADSW_THEME_VERSION, true );

        // Add variables to scripts
        wp_localize_script( 'adswth-js-blog', 'adswthBlogVars',
            [
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'user' => [
                    'can_edit_pages' => current_user_can( 'edit_pages' ),
                ]
            ]
        );

        if( ! is_single() ){

            global $wp_query;

            wp_register_script( 'adswth-js-blog-loadmore', ADSW_THEME_URL .'/blog/assets/js/loadmore' . ADSW_THEME_MIN . '.js', [ 'jquery', 'adswth-js-blog' ], ADSW_THEME_VERSION, true );

            wp_localize_script( 'adswth-js-blog-loadmore', 'adswthBlogVarsLoadmore', [
                'posts' => base64_encode( serialize( $wp_query->query_vars ) ),
                'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
                'max_page' => $wp_query->max_num_pages
            ]);

            wp_enqueue_script( 'adswth-js-blog-loadmore' );
        }

        if( is_single() ){
            if( is_woocommerce_activated() ){
                wp_enqueue_style( 'davinciwoo-css-shop' );
                wp_enqueue_style( 'woocommerce-general' );
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'adswth_blog_scripts', 100 );

function adswth_admin_blog_scripts(){

    $screen    = get_current_screen();
    $screen_id = $screen ? $screen->id : '';

    if( $screen_id == 'post' ){
        $suffix       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        wp_enqueue_script( 'selectWoo', WC()->plugin_url() . '/assets/js/selectWoo/selectWoo.full' . $suffix . '.js', [ 'jquery' ], '1.0.4' );
        wp_enqueue_script( 'wc-enhanced-select', WC()->plugin_url() . '/assets/js/admin/wc-enhanced-select' . $suffix . '.js', [ 'jquery', 'selectWoo' ], WC_VERSION );

        wp_enqueue_style( 'woocommerce_admin_styles', WC()->plugin_url() . '/assets/css/admin.css', [], WC_VERSION );
    }
}



function adswth_blog_widgets_init() {

    register_sidebar( [
        'name'          => __( 'Blog footer sidebar', 'davinciwoo' ),
        'id'            => 'blog-footer-sidebar',
        'description'   => __( 'Blog footer social media icons by ADS Social Tools', 'davinciwoo' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mt-2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ] );
}
add_action( 'widgets_init', 'adswth_blog_widgets_init' );

function adswth_blog_post_metaboxes( $post_type, $post ){

    add_meta_box( 'adswth-linked-products', __( 'Linked Products', 'davinciwoo' ), 'adswth_render_linked_products', 'post', 'normal', 'high' );
}



function adswth_render_linked_products(){

    global $post;

    $product_ids = get_post_meta( $post->ID, 'adswth_linked_products', true );
    ?>
    <div class="options_group show_if_grouped">
        <p class="form-field">
            <select class="wc-product-search" multiple="multiple" style="width: 50%;" id="adswth_linked_products" name="adswth_linked_products[]" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'woocommerce' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo intval( $post->ID ); ?>">
                <?php


                if( !empty( $product_ids ) && is_array( $product_ids ) ) {
                    foreach ($product_ids as $product_id) {
                        $product = wc_get_product($product_id);
                        if (is_object($product)) {
                            echo '<option value="' . esc_attr($product_id) . '"' . selected(true, true, false) . '>' . wp_kses_post($product->get_formatted_name()) . '</option>';
                        }
                    }
                }
                ?>
            </select>
        </p>
    </div>
    <?php
}

function adswth_linked_products_save( $post_id, $post, $update ) {

    if( $post->post_type == 'post' && isset( $_POST[ 'adswth_linked_products' ] ) && is_array( $_POST[ 'adswth_linked_products' ] ) ){
        update_post_meta( $post_id, 'adswth_linked_products', $_POST[ 'adswth_linked_products' ] );
    } else {
        update_post_meta( $post_id, 'adswth_linked_products', '' );
    }

}

if( is_woocommerce_activated() ) {
    add_action( 'admin_enqueue_scripts', 'adswth_admin_blog_scripts' );
    add_action( 'add_meta_boxes', 'adswth_blog_post_metaboxes', 10, 2 );
    add_action( 'save_post', 'adswth_linked_products_save', 10, 3 );
}

