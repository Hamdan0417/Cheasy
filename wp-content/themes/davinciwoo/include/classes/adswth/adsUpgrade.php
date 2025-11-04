<?php
/**
 * Created by PhpStorm.
 * User: sunfun
 * Date: 26.01.18
 * Time: 9:42
 */

namespace adswth;

class adsUpgrade {

	private $db_version;

	private $running_version;

	private $is_upgrade_completed = false;

	private $updates = [
		'1.0.1' => [
			'update_101',
		],
		'1.0.3' => [
			'update_103',
		],
		'1.2.4' => [
			'update_124',
		],
		'1.3.1' => [
			'update_131',
		],
    ];

	public function __construct() {

		add_action( 'init', [ $this, 'check_version' ], 5, 0 );
	}

	public function check_version() {

		$theme = wp_get_theme( get_template() );
		$this->db_version = get_theme_mod( 'adswth_db_version', '1.0.0' );
		$this->running_version = $theme->version;

		// If current version is new and current version has any update run it.
		if ( !empty($this->updates) && version_compare( $this->db_version, $this->running_version, '<' ) && version_compare( $this->db_version, max( array_keys( $this->updates ) ), '<' ) ) {

		    $this->update();

			if ( $this->is_upgrade_completed ) {
				$this->update_db_version();
			}
		}
	}

	private function update() {

		foreach ( $this->updates as $version => $update_callbacks ) {
			if ( version_compare( $this->db_version, $version, '<' ) ) {

				// Run all callbacks.
				foreach ( $update_callbacks as $update_callback ) {
					if ( method_exists( $this, $update_callback ) ) {
						$this->$update_callback();
					} elseif ( function_exists( $update_callback ) ) {
						$update_callback();
					}
				}
			}
		}
		$this->is_upgrade_completed = true;
	}

	private function update_101() {

        $header_tip_icon = get_theme_mod( 'header_tip_icon' );
        $header_tip_icon_custom = get_theme_mod( 'header_tip_icon_custom' );

		if ( ! empty( $header_tip_icon ) && empty( $header_tip_icon_custom ) ) {

			set_theme_mod( 'header_tip_icon_custom', true );
		}
	}
	private function update_103() {

        $main_banner = get_theme_mod( 'main_banner' );

		if ( ! empty( $main_banner ) && is_array( $main_banner ) ) {

			foreach ( $main_banner as &$item ){

				if( !isset( $item[ 'slide_view_type' ] ) ){
					$item[ 'slide_view_type' ] = 'default';
				}
				if( !isset( $item[ 'slide_url' ] ) ) {
					$item['slide_url'] = '';
				}
			}

			set_theme_mod( 'main_banner', $main_banner );
		}
	}
	private function update_124() {

        update_option('yith_wcwl_ajax_enable', 'yes', 'yes');
	}
	private function update_131() {

        $add_to_cart_button_sticky = get_theme_mod( 'add_to_cart_button_sticky' );

        if(!$add_to_cart_button_sticky){
            set_theme_mod( 'add_to_cart_button_sticky', true );
        }
	}

	private function update_db_version() {

		set_theme_mod( 'adswth_db_version', $this->running_version );
	}
}
