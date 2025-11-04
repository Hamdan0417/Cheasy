<?php
/**
 * DavinciWoo Admin Engine Room.
 * This is where all Admin Functions run
 *
 * @package davinciwoo
 */

// Add Options
if( is_customize_preview() ){

	include_once( ADSW_THEME_PATH . '/include/admin/customizer/customizer-reset.php' );

	/**
	 * Add Custom CSS to Customizer
	 */
	function adswth_enqueue_customizer_stylesheet() {

		wp_enqueue_style( 'adswth-customizer-admin', ADSW_THEME_URL . '/include/admin/customizer/css/customizer-admin' . ADSW_THEME_MIN . '.css', [], ADSW_THEME_VERSION, 'all' );
	}
	add_action( 'customize_controls_print_styles', 'adswth_enqueue_customizer_stylesheet' );
	/**
	 * Add Custom JS to Customizer
	 */
	function adswth_enqueue_customizer_scripts() {

		wp_enqueue_script( 'adswth-customizer-admin',	ADSW_THEME_URL . '/include/admin/customizer/js/customizer-admin' . ADSW_THEME_MIN . '.js', [ 'jquery' ], '', true	);

		//Blog
        ?>
        <script type="text/javascript">
            wp.customize.panel( 'blog', function( panel ) {
                panel.expanded.bind( function( isExpanded ) {
                    if ( isExpanded ) {
                        wp.customize.previewer.previewUrl.set( '<?php echo esc_js( get_permalink( get_option( 'page_for_posts' ) ) ); ?>' );
                    }
                } );
            } );
            wp.customize.panel( 'page_front', function( panel ) {
                panel.expanded.bind( function( isExpanded ) {
                    if ( isExpanded ) {
                        wp.customize.previewer.previewUrl.set( '<?php echo esc_js( home_url('/') ); ?>' );
                    }
                } );
            } );
        </script>
        <?php
	}
	add_action( 'customize_controls_print_scripts', 'adswth_enqueue_customizer_scripts' );

	//wp.customize script for refresh
	function adswth_customizer_refresh() {

		wp_enqueue_style( 'adswth-customizer-refresh', ADSW_THEME_URL . '/include/admin/customizer/css/customizer-refresh' . ADSW_THEME_MIN . '.css', [], ADSW_THEME_VERSION, 'all' );
		wp_enqueue_script( 'adswth-customizer-refresh',	ADSW_THEME_URL . '/include/admin/customizer/js/customizer-refresh' . ADSW_THEME_MIN . '.js', [ 'jquery','customize-preview' ], '', true	);
	}
	add_action( 'customize_preview_init', 'adswth_customizer_refresh' );
}

/*
 * Setup plugins and demo
 */
require ADSW_THEME_PATH . '/include/core/functions/function-demo.php';