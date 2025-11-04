<?php

/************ Included Plugins **********/

require ADSW_THEME_PATH . '/include/classes/TGM/class-tgm-plugin-activation.php';


if( class_exists( 'adswth\adsSetup' ) ) {

	class demo_setup extends adswth\adsSetup {

		/**
		 * Holds the current instance of the theme manager
		 *
		 * @since 1.1.3
		 * @var Envato_Theme_Setup_Wizard
		 */
		private static $instance = null;

		/**
		 * @since 1.1.3
		 *
		 * @return Envato_Theme_Setup_Wizard
		 */
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

	}

	demo_setup::get_instance();
}else{
	// log error?
}

function adswth_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = [

		[
			'name'     	=> 'WooCommerce',
			'slug'     	=> 'woocommerce',
			'version' 	=> '3.9.1',
			'required'  => true,
		],
		[
			'name'      => 'Classic Editor',
			'slug'      => 'classic-editor',
			'version'   => '1.5',
			'required'  => true,
		],
		[
			'name'     	=> 'YITH WooCommerce Wishlist',
			'slug'     	=> 'yith-woocommerce-wishlist',
			'version' 	=> '3.0.6',
			'required'  => false,
		],
		[
			'name'     	=> 'Contact Form 7',
			'slug'     	=> 'contact-form-7',
			'version' 	=> '5.1.6',
			'required'  => false,
		],
		[
			'name'    => 'AliDropship Social Tools',
			'slug'    => 'alids-social-tools',
            'source'  => 'https://sr01.alidropship.com/addons/getaddon?key=alids-social-tools&code='.ADSW_IONPREF,
            'version' => '1.1.1',
			'required'  => false,
		],
        [
            'name'    => 'AliDropship Woo Product Video',
            'slug'    => 'alids-woo-product-video',
            'source'  => 'https://sr01.alidropship.com/addons/getaddon?key=alids-woo-product-video&code='.ADSW_IONPREF,
            'version' => '0.8.1',
            'required'  => true,
        ],
		[
			'name'      => 'Nextend Social Login',
			'slug'     	=> 'nextend-facebook-connect',
			'version' 	=> '3.0.20',
			'required'  => false,
		],
        [
            'name'      => 'Site Kit by Google',
            'slug'      => 'google-site-kit',
            'version'   => '1.20.0',
            'required'  => false,
        ],
		[
			'name'      => 'Regenerate Thumbnails',
			'slug'      => 'regenerate-thumbnails',
			'required'  => false,
		],
		[
			'name'      => 'Yoast SEO',
			'slug'      => 'wordpress-seo',
			'version'   => '11.0',
			'required'  => false,
		],
		[
			'name'      => 'Pepipost',
			'slug'      => 'pepipost',
            'source'    => 'https://alidropship.com/detonator/plugins/pepipost.zip',
			'version'   => '3.0.1',
			'required'  => false,
		],
		[
			'name'      => 'Easy WP SMTP',
			'slug'      => 'easy-wp-smtp',
			'version'   => '1.3.9.1',
			'required'  => false,
		],
        [
            'name'      => 'Metric Converter',
            'slug'      => 'metric-converter',
            'version'   => '1.5.4',
            'required'  => false,
        ],
        [
            'name'      => 'TinyMCE Advanced',
            'slug'      => 'tinymce-advanced',
            'version'   => '5.2.1',
            'required'  => false,
        ],
	];

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = [
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'admin.php',
		'has_notices'  => false,                    // Show admin notices or not.
		'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => [
			'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
			'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
			'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
			'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		]
	];

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'adswth_register_required_plugins', 1000 );