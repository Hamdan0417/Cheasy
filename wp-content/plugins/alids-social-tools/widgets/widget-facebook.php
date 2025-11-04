<?php
/**
 * Facebook Likebox_Widget.
 */

class ADSWST_Facebook_Likebox_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
	 
		parent::__construct( 'adswst_facebook_likebox_widget', __( 'ADS Facebook Likebox', 'adswst' ), [
            'description'                 => __( 'Drag and drop this widget for Facebook like box integration', 'adswst' ),
            'customize_selective_refresh' => true,
        ] );
	}

	public function widget( $args, $instance ) {

		$fb_link = ( isset( $instance[ 'fb_link' ] ) ) ?  $instance[ 'fb_link' ] :  '';

		if( ! $fb_link ) return;

		wp_enqueue_script( 'adswst-facebook',
            sprintf( '//connect.facebook.net/%1$s/sdk.js#xfbml=1&version=v2.5&appId=1049899748393568', get_user_locale() ),
            [], ADSWST_VERSION, true
        );

		$title = isset( $instance[ 'title' ] ) ? apply_filters( 'widget_title', $instance[ 'title' ] ) : '';

		if( isset( $args[ 'before_widget' ] ) )
		    echo $args[ 'before_widget' ];

		if ( ! empty( $title ) ) {
		 
			if( isset( $args[ 'before_title' ] ) )
				echo $args[ 'before_title' ];

			echo $title;

			if( isset( $args[ 'after_title' ] ) )
				echo $args[ 'after_title' ];
        }
        ?>
        
        <div class="fb-page"
             data-href="<?php echo esc_url( $fb_link ) ?>"
             data-small-header="false"
             data-adapt-container-width="true"
             data-hide-cover="false"
             data-show-facepile="true"
             data-show-posts="false">
            <div class="fb-xfbml-parse-ignore">
                <blockquote cite="<?php echo esc_url( $fb_link ) ?>">
                    <a href="<?php echo esc_url( $fb_link ) ?>" target="_blank"></a>
                </blockquote>
            </div>
        </div>
        <?php
        
		if( isset( $args[ 'after_widget' ] ) )
			echo $args[ 'after_widget' ];
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance[ 'title' ] = ( ! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
		$instance[ 'fb_link' ] = ( ! empty( $new_instance[ 'fb_link' ] ) ) ? strip_tags( $new_instance[ 'fb_link' ] ) : '';
		return $instance;
	}

	public function form( $instance ) {

		$title   = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] :  '';
		$fb_link = ( isset( $instance[ 'fb_link' ] ) ) ? $instance[ 'fb_link' ] :  '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ) ?>">
                <?php _e( 'Title:', 'adswst' ) ?>
            </label>
			<input class="widefat"
                   id="<?php echo $this->get_field_id( 'title' ) ?>"
                   name="<?php echo $this->get_field_name( 'title' ) ?>"
                   type="text"
                   value="<?php echo esc_attr( $title ) ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'fb_link' ) ?>">
                <?php _e( 'Fan page link:', 'adswst' ) ?>
            </label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id( 'fb_link' ) ?>"
                   name="<?php echo $this->get_field_name( 'fb_link' ) ?>"
                   type="text"
                   value="<?php echo esc_url( $fb_link ) ?>" />
            <i><?php _e( 'Example:', 'adswst' ) ?> https://www.facebook.com/alidropship/</i>
        </p>
		<?php
	}
}
