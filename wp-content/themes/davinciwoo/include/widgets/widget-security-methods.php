<?php
/**
 * Payment Methods Widget.
 */

function adswth_register_security_methods_widget() {
	register_widget( 'ADSWTH_Security_Methods_Widget' );
}
add_action( 'widgets_init', 'adswth_register_security_methods_widget' );

class ADSWTH_Security_Methods_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'adswth_security_methods_widget', // Base ID
			__( 'DavinciWoo Security Methods', 'davinciwoo' ), // Name
			[
				'description'                 => __( 'Drag and drop this widget for Security Methods box integration', 'davinciwoo' ),
				'customize_selective_refresh' => true,
			]
		);

	}

	public function update( $new_instance, $old_instance ) {

		$instance            = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'icons' ] = array_map( 'sanitize_text_field', wp_unslash( $new_instance[ 'icons' ] ) ); ;

		return $instance;
	}

	public function form( $instance ) {

		$choices = [
			'norton'  => ADSW_THEME_URL . '/assets/images/security_methods/norton.svg',
			'namecheap' => ADSW_THEME_URL . '/assets/images/security_methods/namecheap.svg',
			'ssl'     => ADSW_THEME_URL . '/assets/images/security_methods/ssl.svg',
		];
		$title = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] :  '';
		$icons = ( isset( $instance[ 'icons' ] ) ) ? $instance[ 'icons' ] :  [];

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title', 'davinciwoo' ); ?>:
				<input class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				       type="text" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>
		<?php foreach ( $choices as $key => $val ) { ?>
			<span class="image-checkbox" style="display: block; margin-bottom: 5px;">
			<label for="<?php echo $this->get_field_id( 'icons' ) . '_'. $key; ?>" style="display: block;">
				<input class="checkbox"
				       id="<?php echo $this->get_field_id( 'icons' ) . '_'. $key; ?>"
				       name="<?php echo $this->get_field_name( 'icons' ); ?>[]"
				       type="checkbox"
				       value="<?php echo $key; ?>" <?php checked( '1', in_array( $key, $icons ) ); ?>
				       style="vertical-align: middle;"
				/>
				<img width="62" height="32" src="<?php echo $val; ?>" style="vertical-align: middle; display: inline-block; border: 1px solid #B5B5B5; border-radius: 2px" />
			</label>
		</span>
		<?php } ?>

		<?php
	}
	public function widget( $args, $instance ) {

		wp_enqueue_style( 'adswth-widget-security-methods',
			ADSW_THEME_URL .'/assets/css/widgets/widget-security-methods' . ADSW_THEME_MIN . '.css',
			[ 'davinciwoo-css-main', 'davinciwoo-css-color-scheme' ],
			ADSW_THEME_VERSION, 'all'
		);

		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$icons = empty( $instance['icons'] ) ? [] : $instance['icons'];

		$choices = [
			'norton'  => ADSW_THEME_URL . '/assets/images/security_methods/norton.svg',
			'namecheap' => ADSW_THEME_URL . '/assets/images/security_methods/namecheap.svg',
			'ssl'     => ADSW_THEME_URL . '/assets/images/security_methods/ssl.svg',
		];

		echo $args['before_widget'];

		do_action( 'adswth_security_methods_before_widget', $instance );

		echo '<div class="security-methods-wrap">';

		if ( ! empty( $title ) ){
			if( isset( $args[ 'before_title' ] ) ) {
				echo $args[ 'before_title' ];
			}

			echo $title;

			if( isset( $args[ 'after_title' ] ) ) {
				echo $args[ 'after_title' ];
			}
		}

		if( !empty( $icons ) && count( $icons ) > 0 ){
			echo '<div class="icons-wrap">';
			foreach ( $icons as $icon ){
				if( array_key_exists( $icon, $choices) ) {
					echo '<span><img width="62" height="32" src="' . esc_url( $choices[ $icon ] ) . '" /></span>';
				}
			}
			echo '</div>';
		}

		echo '</div>';

		do_action( 'adswth_security_methods_after_widget', $instance );

		echo $args['after_widget'];
	}


}