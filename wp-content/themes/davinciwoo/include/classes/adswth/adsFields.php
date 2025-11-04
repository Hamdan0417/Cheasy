<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 30.05.2016
 * Time: 14:05
 */

namespace adswth;


class adsFields extends Ads {

	public function __construct() {
		parent::__construct();
	}

	protected function action_page_fields( $data ){

		if ( ! isset( $data[ 'post_id' ] ) || ! is_numeric( $data[ 'post_id' ] ) ){
			return [
				'error' => 'post_ID not found',
			];
		}

		if ( ! isset( $data[ 'fields_set' ] ) ){
			return [
				'error' => 'fields_set param not found',
			];
		}

		return $this->get_fields_set( $data[ 'fields_set' ], $data[ 'post_id' ] );

	}

	private function get_fields_set( $field_set, $post_id ){

		$fields_set_action = 'fields_set_' . $field_set;

		if( ! method_exists( $this, $fields_set_action ) ) {
			return [
				'error' => 'fields_set "' . $field_set . '" undefined method',
			];
		}

		$result = [];
		$fields = $this->$fields_set_action();

		foreach ( $fields as $key => $val ){
			$result[ $key ] = $this->get_field( $key, $field_set , $post_id, 'post' ); //TODO сделать динамический тип для третьего параметра.
		}

		return $result;
	}

	public function get_field( $name, $field_set, $post_id, $type = 'post' ){

		$value = null;
		$meta = get_metadata( $type, $post_id, $name, false );

		if( isset( $meta[0] ) ){
			$value = $meta[0];
		} else {
			$value = $this->get_field_default( $name, $field_set );
		}

		return $value;
	}

	public function get_field_default( $name, $field_set ){

		$method = $this->get_field_set_metod( $field_set );

		if( ! method_exists( $this, $method ) ) {
			return null;
		}

		$values = $this->$method();

		return $values[ $name ]['default'];

	}

	private function get_field_set_metod( $field_set ){

		return 'fields_set_' . $field_set;
	}

	public function fields_set_about_us(){

		$fields = [
			'_top_bg_about' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/top_bg_about.jpg',
				'call'    => 'esc_url'
			],
			'_our_core_values_show' => [
				'default' => '1',
				'call'    => 'adswth_bool'
			],
			'_our_core_values_title' => [
				'default' => __( 'Our core values', 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_our_core_values_img_1' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/our_core_values_img_1.svg',
				'call'    => 'esc_url'
			],
			'_our_core_values_text_1' => [
				'default' => __( 'Be Adventurous, Creative, and Open-Minded', 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_our_core_values_img_2' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/our_core_values_img_2.svg',
				'call'    => 'esc_url'
			],
			'_our_core_values_text_2' => [
				'default' => __( 'Create Long-Term Relationships with Our Customers', 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_our_core_values_img_3' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/our_core_values_img_3.svg',
				'call'    => 'esc_url'
			],
			'_our_core_values_text_3' => [
				'default' => __( 'Pursue Growth and Learning', 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_our_core_values_img_4' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/our_core_values_img_4.svg',
				'call'    => 'esc_url'
			],
			'_our_core_values_text_4' => [
				'default' => __( 'Inspire Happiness and Positivity', 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_our_core_values_img_5' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/our_core_values_img_5.svg',
				'call'    => 'esc_url'
			],
			'_our_core_values_text_5' => [
				'default' => __( 'Make Sure Our Customers are Pleased', 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_keep_in_contact_show' => [
				'default' => '1',
				'call'    => 'adswth_bool'
			],
			'_keep_in_contact_title' => [
				'default' => __( 'Keep in contact with us', 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_keep_in_contact_description' => [
				'default' => __( "We're continually working on our online store and are open to any suggestions. If you have any questions or proposals, please do not hesitate to contact us.", 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_keep_in_contact_btn_1_label' => [
				'default' => __( 'Start Shopping', 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_keep_in_contact_btn_1_url' => [
				'default' => home_url('/') . 'shop',
				'call'    => 'esc_url'
			],
			'_keep_in_contact_btn_2_label' => [
				'default' => __( 'Contact Us', 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_keep_in_contact_btn_2_url' => [
				'default' => home_url('/') . 'contact-us',
				'call'    => 'esc_url'
			],
			'_our_partners_show' => [
				'default' => '1',
				'call'    => 'adswth_bool'
			],
			'_our_partners_title' => [
				'default' => __( 'Our partners', 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_our_partners_description' => [
				'default' => __( "We work with the world's most popular and trusted companies so that you can enjoy safe shopping and fast delivery.", 'davinciwoo' ),
				'call'    => 'wp_kses_post'
			],
			'_about_delivery_1' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/dhl.svg',
				'call'    => 'esc_url'
			],
			'_about_delivery_2' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/visa.svg',
				'call'    => 'esc_url'
			],
			'_about_delivery_3' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/mastercard.svg',
				'call'    => 'esc_url'
			],
			'_about_delivery_4' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/paypal.svg',
				'call'    => 'esc_url'
			],
			'_about_delivery_5' => [
				'default' => ADSW_THEME_URL . '/assets/images/defaults/about-us/ems.svg',
				'call'    => 'esc_url'
			]
		];

		return $fields;
	}

}