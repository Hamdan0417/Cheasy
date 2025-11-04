<?php

// Options for resetting Customizer

if ( ! class_exists( 'adsCustomizerReset' ) ) {
	final class adsCustomizerReset {
		/**
		 * @var ADSWTH_Customizer_Reset
		 */
		private static $instance = null;

		/**
		 * @var WP_Customize_Manager
		 */
		private $wp_customize;

		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		private function __construct() {
			add_action( 'customize_controls_print_scripts', [ $this, 'customize_controls_print_scripts' ] );
			add_action( 'wp_ajax_customizer_reset', [ $this, 'ajax_customizer_reset' ] );
			add_action( 'customize_register', [ $this, 'customize_register' ] );
		}

		public function customize_controls_print_scripts() {
			wp_enqueue_script( 'adswth-customizer-reset',  get_template_directory_uri() . '/include/admin/customizer/js/customizer-reset' . ADSW_THEME_MIN . '.js');
			wp_localize_script( 'adswth-customizer-reset', '_adsCustomizerReset', [
				'reset'   => __( 'Reset', 'davinciwoo' ),
				'confirm' => __( "Attention! This will remove all customizations ever made via customizer to this theme!\n\nThis action is irreversible!", 'davinciwoo' ),
				'nonce'   => [
					'reset' => wp_create_nonce( 'customizer-reset' ),
				]
			] );
		}

		/**
		 * Store a reference to `WP_Customize_Manager` instance
		 *
		 * @param $wp_customize
		 */
		public function customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
		}

		public function ajax_customizer_reset() {
			if ( ! $this->wp_customize->is_preview() ) {
				wp_send_json_error( 'not_preview' );
			}

			if ( ! check_ajax_referer( 'customizer-reset', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce' );
			}

			$this->reset_customizer();

			wp_send_json_success();
		}

		public function reset_customizer() {
			$settings = $this->wp_customize->settings();

			// remove theme_mod settings registered in customizer
			foreach ( $settings as $setting ) {
				if ( 'theme_mod' == $setting->type ) {
					remove_theme_mod( $setting->id );
				}
			}
		}
	}
}

adsCustomizerReset::get_instance();