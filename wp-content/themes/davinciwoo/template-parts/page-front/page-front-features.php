<?php if( adswth_option( 'features_block_show' ) ) { ?>
    <?php $features_list = adswth_option( 'features_list' ); ?>
    <?php if( is_array( $features_list ) && count( $features_list ) > 0 ) { ?>
    <div class="features-wrap mt-px-30 d-none d-md-block">
        <div class="row justify-content-around">
        <?php foreach ($features_list as $item ) { ?>
            <div class="col-xl-3 col-lg-4 mx-lg-px-15 my-lg-px-15 col-md-5 my-md-px-15">
                <div class="feature d-flex justify-content-center align-items-center">
		            <?php if( isset( $item[ 'feature_image' ] ) ) { ?>
                        <?php $image_link = is_numeric( $item[ 'feature_image' ] ) ?
                            wp_get_attachment_url( $item[ 'feature_image' ] ) : $item[ 'feature_image' ]; ?>
                    <div class="feature-image">
                        <img class="img-fluid" src="<?php echo esc_url( $image_link ); ?>" />
                    </div>
		            <?php } //endif; ?>
                    <div class="feature-text">
                        <div class="title mb-2"><?php echo $item[ 'feature_title' ] ?></div>
                        <div class="text"><?php echo $item[ 'feature_text' ] ?></div>
                    </div>
                </div>
            </div>
        <?php } //endforeach; ?>
        </div>
    </div>
	<?php } //endif; ?>
<?php } //endif; ?>
