<?php
/**
 * Author: Vitaly Kukin
 * Date: 24.05.2017
 * Time: 13:35
 */

namespace adswth;

use \adswth\adsSetup;

class adsHandlers {

	/**
	 * @uses action_page_license()
	 */


	/**
	 * @param array $post
	 *
	 * @return array
	 */
	public function actions( $post ) {

		if ( isset( $post[ 'adswth_action' ] ) && current_user_can( 'activate_plugins' ) ) {

			$adswth_actions = 'action_' . $post[ 'adswth_action' ];

			$args        = $post[ 'args' ];
			$data        = [];

            if( is_array( $args ) ){
                $data = $args;
            }else{
                parse_str( $args, $data );
            }

			if( method_exists( $this, $adswth_actions ) ) {
				return $this->$adswth_actions( $data );
			}
		}

		return [ 'error' => __( 'Undefined action', 'davinciwoo' ) ];
	}

	private function action_tinymce( $data ) {

		$textarea_name = isset( $data[ 'name' ] ) ? $data[ 'name' ] : 'template';

		ob_start();
		\wp_editor(
			stripcslashes( $data[ 'template' ] ),
			$data[ 'id' ],
			[ 'textarea_name' => $textarea_name, 'teeny' => false ]
		);
		$editor = ob_get_clean();

		return [ 'editor' => $editor ];
	}

	/**
	 * Get general page menus settings
	 */
	private function action_page_adswth_menus() {

		return [
			'menu_product_cat_show_count'   => adswth_option( 'menu_product_cat_show_count' ),
			'use_minicart' => adswth_option( 'use_minicart' ),
			'use_shoppingcart' => adswth_option( 'use_shoppingcart' ),
			'show_side_shoppingcart_after_product_add' => adswth_option( 'show_side_shoppingcart_after_product_add' )
		];
	}

	/**
	 * Save general page menus settings
	 */
	private function action_save_page_adswth_menus( $data ) {

		if( ! wp_verify_nonce( $data[ 'adswth_menus' ], 'adswth_setting_action' ) )
			return [ 'error' => __( 'Undefined form data', 'davinciwoo' ) ];

		set_theme_mod( 'menu_product_cat_show_count', isset( $data[ 'menu_product_cat_show_count' ] ) );
		set_theme_mod( 'use_minicart', isset( $data[ 'use_minicart' ] ) );
		set_theme_mod( 'use_shoppingcart', isset( $data[ 'use_shoppingcart' ] ) );
		set_theme_mod( 'show_side_shoppingcart_after_product_add', isset( $data[ 'show_side_shoppingcart_after_product_add' ] ) );

		return [
			'message' => __( 'Menus settings have been saved', 'davinciwoo')
		];
	}

	/**
	 * Get general woocommerce settings
	 */
	private function action_page_adswth_woocommerce() {

		return [
			'use_minicart' => adswth_option( 'use_minicart' ),
			'use_shoppingcart' => adswth_option( 'use_shoppingcart' ),
			'show_side_shoppingcart_after_product_add' => adswth_option( 'show_side_shoppingcart_after_product_add' )
		];
	}

	/**
	 * Save general woocommerce settings
	 */
	private function action_save_page_adswth_woocommerce( $data ) {

		if( ! wp_verify_nonce( $data[ 'adswth_woocommerce' ], 'adswth_settings_action' ) )
			return [ 'error' => __( 'Undefined form data', 'davinciwoo' ) ];

		set_theme_mod( 'use_minicart', isset( $data[ 'use_minicart' ] ) );
        set_theme_mod( 'use_shoppingcart', isset( $data[ 'use_shoppingcart' ] ) );
        set_theme_mod( 'show_side_shoppingcart_after_product_add', isset( $data[ 'show_side_shoppingcart_after_product_add' ] ) );

		return [
			'message' => __( 'Woocommerce settings have been saved', 'davinciwoo')
		];
	}

	/**
	 * Get single product page settings
	 */
	private function action_page_adswth_single_product() {

		return [
			'product_gallery_woocommerce'   => adswth_option( 'product_gallery_woocommerce' ),
			'product_page_shipping_content' => wp_unslash(adswth_option( 'product_page_shipping_content' )),
		];
	}

	/**
	 * Save single product page settings
	 */
	private function action_save_page_adswth_single_product( $data ) {
		if( ! isset( $data[ 'product_page_shipping_content' ] ) || ! wp_verify_nonce( $data[ 'adswth_single_product' ], 'adswth_setting_action' ) )
			return [ 'error' => __( 'Undefined form data', 'davinciwoo' ) ];

		set_theme_mod( 'product_gallery_woocommerce', isset( $data[ 'product_gallery_woocommerce' ] ) );
		set_theme_mod( 'product_page_shipping_content',  wp_kses_post( $data[ 'product_page_shipping_content' ] ) );

		return [
			'message' => __( 'Single product settings have been saved', 'davinciwoo')
		];
	}

	/**
 * Get 404 page settings
 */
    private function action_page_adswth_404_page() {

        return [
            '404_background_image' => adswth_option( '404_background_image' ),
            '404_text'             => adswth_option( '404_text' ),
            '404_btn_text_1'       => adswth_option( '404_btn_text_1' ),
            '404_btn_link_1'       => adswth_option( '404_btn_link_1' ),
            '404_btn_text_2'       => adswth_option( '404_btn_text_2' ),
            '404_btn_link_2'       => adswth_option( '404_btn_link_2' ),
        ];
    }

    /**
     * Save 404 page settings
     */
    private function action_save_page_adswth_404_page( $data ) {

        if( ! isset( $data[ '404_background_image' ] ) ||
            ! isset( $data[ '404_text' ] ) ||
            ! isset( $data[ '404_btn_text_1' ] ) ||
            ! isset( $data[ '404_btn_link_1' ] ) ||
            ! isset( $data[ '404_btn_text_2' ] ) ||
            ! isset( $data[ '404_btn_link_2' ] ) ||
            ! wp_verify_nonce( $data[ 'adswth_404_page' ], 'adswth_setting_action' ) ){

            return [ 'error' => __( 'Undefined form data', 'davinciwoo' ) ];
        }


        set_theme_mod( '404_background_image',  esc_url( $data[ '404_background_image' ] ) );
        set_theme_mod( '404_text',  wp_kses_post( stripcslashes( $data[ '404_text' ]  ) ) );
        set_theme_mod( '404_btn_text_1',  wp_kses_post( stripcslashes( $data[ '404_btn_text_1' ] ) ) );
        set_theme_mod( '404_btn_link_1',  esc_url( $data[ '404_btn_link_1' ] ) );
        set_theme_mod( '404_btn_text_2',  wp_kses_post( stripcslashes( $data[ '404_btn_text_2' ] ) ) );
        set_theme_mod( '404_btn_link_2',  esc_url( $data[ '404_btn_link_2' ] ) );



        return [
            'message' => __( '404 page settings have been saved', 'davinciwoo')
        ];
    }

    /**
     * Get additional settings
     */
    private function action_page_adswth_additional() {

        return [
            'additional_header_scripts' => stripslashes( html_entity_decode( adswth_option( 'additional_header_scripts' ) ) ),
            'additional_footer_scripts' => stripslashes( html_entity_decode( adswth_option( 'additional_footer_scripts' ) ) ),
        ];
    }

    /**
     * Save additional settings
     */
    private function action_save_page_adswth_additional( $data ) {

        if( ! isset( $data[ 'additional_header_scripts' ] ) ||
            ! isset( $data[ 'additional_footer_scripts' ] ) ||
            ! wp_verify_nonce( $data[ 'adswth_additional' ], 'adswth_setting_action' ) ){

            return [ 'error' => __( 'Undefined form data', 'davinciwoo' ) ];
        }


        set_theme_mod( 'additional_header_scripts',  stripslashes( $data[ 'additional_header_scripts' ] ) );
        set_theme_mod( 'additional_footer_scripts',  stripslashes( $data[ 'additional_footer_scripts' ] ) );

        return [
            'message' => __( 'Additional settings have been saved', 'davinciwoo')
        ];
    }

	// render Install plugins
	private function action_page_adswth_plugins_form($data) {
		$plugins = new adsSetup($data);
		return  $plugins->_get_plugins($data);
	}

	private function action_list_plugins( $data ){
		$content = new adsSetup($data);
		return $content->list_plugins($data);
	}

	private function action_setup_plugins( $data ){
		$content = new adsSetup($data);
		return $content->proceed_plugin($data);
	}

	//child theme
	private function action_page_adswth_child_form( $data ) {
		$child = new adsSetup($data);
		return $child->_check_child_theme();
	}
	private function action_demo_setup_child( $data ) {
		$child = new adsSetup($data);
		return $child->_make_child_theme($data);
	}

	//content
	private function action_page_adswth_demo_form() {
		return true;
	}
	private function action_demo_delete_default_content( $data ) {

		$content = new adsSetup($data);
		return $content->delete_default_content( $data );
	}
	private function action_demo_setup_content( $data ) {

		$content = new adsSetup($data);
		return $content->set_content($data);
	}
}
