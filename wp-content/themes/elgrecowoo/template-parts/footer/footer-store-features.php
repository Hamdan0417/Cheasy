<?php if( adswth_option( 'store_features_block_show' ) ) {
    $src = ADSW_THEME_LAZY_LOAD ? 'data-src' : 'src';
    ?>
    <?php $features_list = adswth_option( 'store_features_list' ); ?>
    <?php if( is_array( $features_list ) && count( $features_list ) > 0 ) { ?>
        <div class="features-wrap pt-px-30 pb-px-15">
            <div class="container">
                <div class="row justify-content-between">
                    <?php foreach ($features_list as $item ) { ?>
                        <div class="col-xl-3 col-lg-6 my-lg-px-10 col-md-6 my-md-px-10 my-xs-px-10 item">
                            <div class="feature d-flex">
                                <?php if( isset( $item[ 'store_feature_image' ] ) ) { ?>
                                    <?php $image_link = is_numeric( $item[ 'store_feature_image' ] ) ?
                                        wp_get_attachment_url( $item[ 'store_feature_image' ] ) : $item[ 'store_feature_image' ]; ?>
                                    <div class="feature-image">
                                        <img <?php echo $src; ?>="<?php echo esc_url( $image_link ); ?>" />
                                    </div>
                                <?php } //endif; ?>
                                <div class="feature-text">
                                    <div class="title"><?php echo $item[ 'store_feature_title' ] ?></div>
                                    <div class="text"><?php echo $item[ 'store_feature_text' ] ?></div>
                                </div>
                            </div>
                        </div>
                    <?php } //endforeach; ?>
                </div>
            </div>
        </div>
    <?php } //endif; ?>
<?php } //endif; ?>
