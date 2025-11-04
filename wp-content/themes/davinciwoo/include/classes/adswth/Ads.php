<?php
/**
 * Created by PhpStorm.
 * User: sunfun
 * Date: 05.12.17
 * Time: 15:46
 */

namespace adswth;


abstract class Ads {

	protected $level_9 = false;

	public function __construct() {
		if( current_user_can( 'level_9' ) )
			$this->level_9 = true;

	}


	/**
	 * @param array $post
	 *
	 * @return array
	 */
	public function actions( $post ) {

		if ( isset( $post[ 'adswth_action' ] ) && current_user_can( 'activate_plugins' ) ) {

			$ads_actions = 'action_' . $post[ 'adswth_action' ];
			$args        = isset ($post[ 'args' ] ) ? $post[ 'args' ] : [];
			$data        = [];

			if( is_array( $args ) ) {
				$data = $args;
			} else {
				parse_str( $args, $data );
			}

			if( isset( $post[ 'post_id' ] ) ){
				$data[ 'post_id' ] = $post[ 'post_id' ];
			}

			if( isset( $post[ 'fields_set' ] ) ){
				$data[ 'fields_set' ] = $post[ 'fields_set' ];
			}

			if( method_exists( $this, $ads_actions ) ) {

				return $this->$ads_actions( $data );
			}
		}

		return [ 'error' => __( 'Undefined action', 'davinciwoo' ) ];
	}
}