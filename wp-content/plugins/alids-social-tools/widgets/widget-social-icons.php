<?php
/**
 * Social Icons Widget.
 */

class ADSWST_Social_Icons_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
	 
		parent::__construct( 'adswst_social_icons_widget', __( 'ADS Social Icons', 'adswst' ), [
            'description' => __( 'Drag and drop this widget for Social Icons box integration', 'davinciwoo' ),
        ] );

		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'admin_footer-widgets.php', [ $this, 'print_scripts' ], 9999 );
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance[ 'title' ]            = ( ! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
		$instance[ 'facebook_link' ]    = ( ! empty( $new_instance[ 'facebook_link' ] ) ) ? esc_url( strip_tags( $new_instance[ 'facebook_link' ] ) ) : '';
		$instance[ 'instagram_link' ]   = ( ! empty( $new_instance[ 'instagram_link' ] ) ) ? esc_url( strip_tags( $new_instance[ 'instagram_link' ] ) ) : '';
		$instance[ 'twitter_link' ]     = ( ! empty( $new_instance[ 'twitter_link' ] ) ) ? esc_url( strip_tags( $new_instance[ 'twitter_link' ] ) ) : '';
		$instance[ 'pinterest_link' ]   = ( ! empty( $new_instance[ 'pinterest_link' ] ) ) ? esc_url( strip_tags( $new_instance[ 'pinterest_link' ] ) ) : '';
		$instance[ 'youtube_link' ]     = ( ! empty( $new_instance[ 'youtube_link' ] ) ) ? esc_url( strip_tags( $new_instance[ 'youtube_link' ] ) ) : '';
		$instance[ 'tiktok_link' ]      = ( ! empty( $new_instance[ 'tiktok_link' ] ) ) ? esc_url( strip_tags( $new_instance[ 'tiktok_link' ] ) ) : '';
		$instance[ 'linkedin_link' ]    = ( ! empty( $new_instance[ 'linkedin_link' ] ) ) ? esc_url( strip_tags( $new_instance[ 'linkedin_link' ] ) ) : '';
		$instance[ 'snapchat_link' ]    = ( ! empty( $new_instance[ 'snapchat_link' ] ) ) ? esc_url( strip_tags( $new_instance[ 'snapchat_link' ] ) ) : '';
		$instance[ 'icon_color' ]       = ( ! empty( $new_instance[ 'icon_color' ] ) ) ? strip_tags( $new_instance[ 'icon_color' ]  ) : '';
		$instance[ 'icon_color_hover' ] = ( ! empty( $new_instance[ 'icon_color_hover' ] ) ) ? strip_tags( $new_instance[ 'icon_color_hover' ]  ) : '';
		$instance[ 'icon_color_background' ] = ( ! empty( $new_instance[ 'icon_color_background' ] ) ) ? strip_tags( $new_instance[ 'icon_color_background' ]  ) : '';
		$instance[ 'icon_color_background_hover' ] = ( ! empty( $new_instance[ 'icon_color_background_hover' ] ) ) ? strip_tags( $new_instance[ 'icon_color_background_hover' ]  ) : '';
		$instance[ 'icon_font_size' ]   = ( ! empty( $new_instance[ 'icon_font_size' ] ) ) ? strip_tags( $new_instance[ 'icon_font_size' ]  ) : '';
		$instance[ 'padding' ]          = ( ! empty( $new_instance[ 'padding' ] ) ) ? strip_tags( $new_instance[ 'padding' ]  ) : '';
		$instance[ 'border_radius' ]    = ( ! empty( $new_instance[ 'border_radius' ] ) ) ? strip_tags( $new_instance[ 'border_radius' ]  ) : '';

		return $instance;
	}

	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, [
			'title'          => __( 'FOLLOW US', 'adswst' ),
			'facebook_link'  => '',
			'instagram_link' => '',
			'twitter_link'   => '',
			'pinterest_link' => '',
			'youtube_link'   => '',
			'tiktok_link'    => '',
			'linkedin_link' => '',
			'snapchat_link'  => '',
			'icon_color'                  => '#FFFFFF',
			'icon_color_hover'            => '#FFFFFF',
			'icon_color_background'       => '#333333',
			'icon_color_background_hover' => '#626262',
            'icon_font_size'              => '14',
            'padding'                     => '5',
			'border_radius'               => '2'
		] );

		$title            = $instance[ 'title' ];
		$facebook_link    = $instance[ 'facebook_link' ];
		$instagram_link   = $instance[ 'instagram_link' ];
		$twitter_link     = $instance[ 'twitter_link' ];
		$pinterest_link   = $instance[ 'pinterest_link' ];
		$youtube_link     = $instance[ 'youtube_link' ];
		$tiktok_link      = $instance[ 'tiktok_link' ];
		$linkedin_link    = $instance[ 'linkedin_link' ];
		$snapchat_link    = $instance[ 'snapchat_link' ];
		$icon_color       = $instance[ 'icon_color' ];
		$icon_color_hover = $instance[ 'icon_color_hover' ];
		$icon_color_background = $instance[ 'icon_color_background' ];
		$icon_color_background_hover = $instance[ 'icon_color_background_hover' ];
		$icon_font_size   = $instance[ 'icon_font_size' ];
        $padding          = $instance[ 'padding' ];
		$border_radius    = $instance[ 'border_radius' ];

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ) ?>">
				<?php esc_html_e( 'Title', 'adswst' ) ?>:
				<input class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ) ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ) ?>"
				       type="text"
                       value="<?php echo esc_attr( $title ) ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_link' ) ) ?>">
				<?php esc_html_e( 'Facebook link', 'adswst' ) ?>:
				<input class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'facebook_link' ) ) ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'facebook_link' ) ) ?>"
				       type="text"
				       value="<?php echo esc_attr( $facebook_link ) ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram_link' ) ) ?>">
				<?php esc_html_e( 'Instagram link', 'adswst' ) ?>:
				<input class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'instagram_link' ) ) ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'instagram_link' ) ) ?>"
				       type="text"
				       value="<?php echo esc_attr( $instagram_link ) ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter_link' ) ) ?>">
				<?php esc_html_e( 'Twitter link', 'adswst' ) ?>:
				<input class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'twitter_link' ) ) ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'twitter_link' ) ) ?>"
				       type="text"
				       value="<?php echo esc_attr( $twitter_link ) ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest_link' ) ) ?>">
				<?php esc_html_e( 'Pinterest link', 'adswst' ) ?>:
				<input class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'pinterest_link' ) ) ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'pinterest_link' ) ) ?>"
				       type="text"
				       value="<?php echo esc_attr( $pinterest_link ) ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube_link' ) ) ?>">
				<?php esc_html_e( 'YouTube link', 'adswst' ) ?>:
				<input class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'youtube_link' ) ) ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'youtube_link' ) ) ?>"
				       type="text"
				       value="<?php echo esc_attr( $youtube_link ) ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tiktok_link' ) ) ?>">
				<?php esc_html_e( 'TikTok link', 'adswst' ) ?>:
				<input class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'tiktok_link' ) ) ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'tiktok_link' ) ) ?>"
				       type="text"
				       value="<?php echo esc_attr( $tiktok_link ) ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin_link' ) ) ?>">
				<?php esc_html_e( 'LinkedIn link', 'adswst' ) ?>:
				<input class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'linkedin_link' ) ) ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'linkedin_link' ) ) ?>"
				       type="text"
				       value="<?php echo esc_attr( $linkedin_link ) ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'snapchat_link' ) ) ?>">
				<?php esc_html_e( 'Snapchat link', 'adswst' ) ?>:
				<input class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'snapchat_link' ) ) ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'snapchat_link' ) ) ?>"
				       type="text"
				       value="<?php echo esc_attr( $snapchat_link ) ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_color' ) ?>">
                <?php _e( 'Color:', 'adswst' ) ?>
            </label><br>
			<input type="text"
                   name="<?php echo $this->get_field_name( 'icon_color' ) ?>"
                   class="color-picker"
                   id="<?php echo $this->get_field_id( 'icon_color' ) ?>"
                   value="<?php echo $icon_color ?>"
                   data-default-color="#333333" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_color_hover' ) ?>">
                <?php _e( 'Color on hover:', 'adswst' ) ?>
            </label><br>
			<input type="text"
                   name="<?php echo $this->get_field_name( 'icon_color_hover' ) ?>"
                   class="color-picker"
                   id="<?php echo $this->get_field_id( 'icon_color_hover' ) ?>"
                   value="<?php echo $icon_color_hover ?>"
                   data-default-color="#626262" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_color_background' ) ?>">
                <?php _e( 'Background Color:', 'adswst' ) ?>
            </label><br>
			<input type="text"
                   name="<?php echo $this->get_field_name( 'icon_color_background' ) ?>"
                   class="color-picker"
                   id="<?php echo $this->get_field_id( 'icon_color_background' ) ?>"
                   value="<?php echo $icon_color_background ?>"
                   data-default-color="#333333" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_color_background_hover' ) ?>">
                <?php _e( 'Background Color on hover:', 'adswst' ) ?>
            </label><br>
			<input type="text"
                   name="<?php echo $this->get_field_name( 'icon_color_background_hover' ) ?>"
                   class="color-picker"
                   id="<?php echo $this->get_field_id( 'icon_color_background_hover' ) ?>"
                   value="<?php echo $icon_color_background_hover ?>"
                   data-default-color="#626262" />
		</p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_font_size' ) ) ?>">
				<?php esc_html_e( 'Icon size', 'adswst' ) ?>:
                <input class="widefat"
                       id="<?php echo esc_attr( $this->get_field_id( 'icon_font_size' ) ) ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'icon_font_size' ) ) ?>"
                       type="number"
                       min="10"
                       step="1"
                       value="<?php echo esc_attr( $icon_font_size ) ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'padding' ) ) ?>">
				<?php esc_html_e( 'Padding', 'adswst' ) ?>:
                <input class="widefat"
                       id="<?php echo esc_attr( $this->get_field_id( 'padding' ) ) ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'padding' ) ) ?>"
                       type="number"
                       min="0"
                       step="1"
                       value="<?php echo esc_attr( $padding ) ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'border_radius' ) ) ?>">
				<?php esc_html_e( 'Border Radius', 'adswst' ) ?>:
                <input class="widefat"
                       id="<?php echo esc_attr( $this->get_field_id( 'border_radius' ) ) ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'border_radius' ) ) ?>"
                       type="number"
                       min="0"
                       step="1"
                       value="<?php echo esc_attr( $border_radius ) ?>" />
            </label>
        </p>
		<?php
	}

	public function widget( $args, $instance ) {

		wp_enqueue_style( 'adswst-css-social-icons',
            ADSWST_URL .'/assets/css/social-icons' . ADSWST_MIN .'.css', [], ADSWST_VERSION, 'all' );

		wp_enqueue_style( 'adswth-widget-social-icons',
            ADSWST_URL .'/assets/css/widget-social-icons' . ADSWST_MIN .'.css', [], ADSWST_VERSION, 'all' );

		$title = empty( $instance[ 'title' ] ) ? '' : apply_filters( 'widget_title', $instance[ 'title' ] );

		$icon_color                  = empty( $instance[ 'icon_color' ] ) ? '' : 'color:' . $instance[ 'icon_color' ] . ';';
		$icon_color_hover            = empty( $instance[ 'icon_color_hover' ] ) ? '' : 'color:' . $instance[ 'icon_color_hover' ] . ';';
		$icon_color_background       = empty( $instance[ 'icon_color_background' ] ) ? '' : 'background-color:' . $instance[ 'icon_color_background' ] . ';';
		$icon_color_background_hover = empty( $instance[ 'icon_color_background_hover' ] ) ? '' : 'background-color:' .  $instance[ 'icon_color_background_hover' ] . ';';
		$icon_font_size              = empty( $instance[ 'icon_font_size' ] ) ? '' : 'font-size:' .  $instance[ 'icon_font_size' ] . 'px;';
		$padding                     = empty( $instance[ 'padding' ] ) ? 'padding: 0;' : 'padding:' .  $instance[ 'padding' ] . 'px;';
		$border_radius               = empty( $instance[ 'border_radius' ] ) ? '' : 'border-radius:' .  $instance[ 'border_radius' ] . 'px;';

		$widget_id = isset( $args[ 'widget_id' ] ) ? '#' . $args[ 'widget_id' ] : '';
		$widget_id = isset( $instance[ 'id' ] ) && $instance[ 'id' ] != '' ? '#social-icons-shortcode-widget-'.  $instance[ 'id' ] : $widget_id;

		echo '<style>' .
			 $widget_id . ' .social-icons-wrap a i{' . $icon_color . $icon_color_background . '}' .
			 $widget_id . ' .social-icons-wrap a:hover i{' . $icon_color_hover . $icon_color_background_hover . '}' .
		     $widget_id . ' [class^="social-icon-"], ' . $widget_id . ' [class*=" social-icon-"]{' . $icon_font_size . $padding . $border_radius . '}' .
		    '</style>';

		$soc_icons = [
			'facebook'  => empty( $instance[ 'facebook_link' ] )  ? '' : $instance[ 'facebook_link' ],
			'instagram' => empty( $instance[ 'instagram_link' ] ) ? '' : $instance[ 'instagram_link' ],
			'twitter'   => empty( $instance[ 'twitter_link' ] )   ? '' : $instance[ 'twitter_link' ],
			'pinterest' => empty( $instance[ 'pinterest_link' ] ) ? '' : $instance[ 'pinterest_link' ],
			'youtube'   => empty( $instance[ 'youtube_link' ] )   ? '' : $instance[ 'youtube_link' ],
			'tiktok'    => empty( $instance[ 'tiktok_link' ] )    ? '' : $instance[ 'tiktok_link' ],
			'linkedin'  => empty( $instance[ 'linkedin_link' ] )  ? '' : $instance[ 'linkedin_link' ],
			'snapchat'  => empty( $instance[ 'snapchat_link' ] )  ? '' : $instance[ 'snapchat_link' ],
		];

		echo isset( $instance[ 'id' ] ) && $instance[ 'id' ] != '' ?
            '<div id="social-icons-shortcode-widget-' . $instance[ 'id' ] . '" class="social-icons-shortcode-widget">' : '';

		echo $args[ 'before_widget' ];

		if ( ! empty( $title ) ) {
		 
			if( isset( $args[ 'before_title' ] ) )
				echo $args[ 'before_title' ];

			echo $title;

			if( isset( $args[ 'after_title' ] ) )
				echo $args[ 'after_title' ];
		}

		do_action( 'adswth_social_icons_before_widget', $instance );

        $instance = apply_filters( 'adswth_social_icons_add_params_before_widget', $instance );
        ?>
		<div class="social-icons-wrap <?php echo isset( $instance['add_class'] ) ? $instance['add_class'] : "" ?>">
        <?php
		if( ! empty( $soc_icons ) ){
			foreach ( $soc_icons as $key => $val ){
			    if( $val != '') { ?>
				    <a href="<?php echo esc_url( $val ); ?>" target="_blank" rel="nofollow"><i class="social-icon-<?php echo $key; ?>"></i><?php echo isset( $instance['show_soc_name'] ) ? '<span>' . $key . '</span>' : ""; ?></a>
			    <?php }
			}
		}
		echo '</div>';

		do_action( 'adswth_social_icons_after_widget', $instance );

		echo $args[ 'after_widget' ];
		echo isset( $instance[ 'id' ] ) && $instance[ 'id' ] != '' ? '</div>' : '';
	}

	/**
	 * Enqueue scripts.
	 *
	 * @param string $hook_suffix
	 */
	public function enqueue_scripts( $hook_suffix ) {

		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'underscore' );
	}

	/**
	 * Print scripts.
	 */
	public function print_scripts() {
		?>
		<script>
            ( function( $ ){
                function initColorPicker( widget ) {
                    widget.find( '.color-picker' ).wpColorPicker( {
                        change: _.throttle( function() { // For Customizer
                            $(this).trigger( 'change' );
                        }, 3000 )
                    });
                }

                function onFormUpdate( event, widget ) {
                    initColorPicker( widget );
                }

                $( document ).on( 'widget-added widget-updated', onFormUpdate );

                $( document ).ready( function() {
                    $( '#widgets-right .widget:has(.color-picker)' ).each( function () {
                        initColorPicker( $( this ) );
                    } );
                } );
            }( jQuery ) );
		</script>
		<?php
	}
}
