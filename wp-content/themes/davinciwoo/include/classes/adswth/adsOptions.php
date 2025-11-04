<?php
/**
 * This is a wrapper class for Kirki.
 * If the Kirki plugin is installed, then all CSS & Google fonts
 * will be handled by the plugin.
 * In case the plugin is not installed, this acts as a fallback
 * ensuring that all CSS & fonts still work.
 * It does not handle the customizer options, simply the frontend CSS.
 *
 * @author     ADSW
 * @category   Class
 * @package    adswtheme/Classes
 * @since      0.1.0
 */

namespace adswth;

use Kirki;
class adsOptions {

	/**
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $config = [];

	/**
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $fields = [];

	/**
	 * The class constructor
	 */
	public function __construct() {
		if ( class_exists( 'Kirki' ) ) {
			return;
		}
	}

	/**
	 * Create a new panel
	 *
	 * @param   string      the ID for this panel
	 * @param   array       the panel arguments
	 */
	public static function add_panel( $id = '', $args = [] ) {

		if ( class_exists( 'Kirki' ) ) {
			Kirki::add_panel( $id, $args );
		}
	}

	/**
	 * Create a new section
	 *
	 * @param   string      the ID for this section
	 * @param   array       the section arguments
	 */
	public static function add_section( $id, $args = [] ) {

		if ( class_exists( 'Kirki' ) ) {

			Kirki::add_section( $id, $args );
		}
	}


	/**
	 * Sets the configuration options.
	 *
	 * @param    string    $config_id    The configuration ID
	 * @param    array     $args         The configuration arguments
	 */
	public static function add_config( $config_id = '', $args = [] ) {
		if ( class_exists( 'Kirki' ) ) {

			Kirki::add_config( $config_id, $args );
			return;
		}
	}

	/**
	 * Create a new field
	 *
	 * @param    string    $config_id    The configuration ID
	 * @param    array     $args         The field's arguments
	 */
	public static function add_field( $config_id = '', $args = [] ) {

		if( $config_id == '' ) $config_id = $args[ 'settings' ];

		if ( class_exists( 'Kirki' ) ) {

			Kirki::add_field( $config_id, $args );
			return;
		}
	}
}
