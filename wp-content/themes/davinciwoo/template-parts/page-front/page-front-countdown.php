<?php if( adswth_option( 'countdown_block_show' ) ) {
    $date = ( adswth_option( 'countdown_type' ) ) ? adswth_clock_time( adswth_option( 'countdown_date' ) ) : adswth_default_clock_time();
?>
<div class="countdown-wrap mt-px-20 px-px-15 d-none d-md-block">
    <div class="row">
        <div class="col-12">
            <div class="countdown row justify-content-center align-items-center">
                <?php
                    $text_classes = adswth_option( 'countdown_show' ) ? 'col-xl-auto col-lg-9 col-md-8' : 'col-xl-auto col-12';
                ?>
                <div class="<?php echo $text_classes; ?> text-center text text-uppercase"><?php echo adswth_option( 'countdown_text' ) ; ?></div>

                <?php if( adswth_option( 'countdown_show' ) ) { ?>
                <div id="clock" data-time="<?php echo $date ?>" class="col-xl-auto col-lg-3 col-md-4" style="<?php if( ! adswth_option( 'countdown_block_show' ) ) { echo 'display:none;'; } ?>"></div>
                <div id="clock-template" style="display:none;">
                    <div class="clock text-center">
                        <div class="item">%D<span><?php _e( 'D', 'davinciwoo' ) ?></span></div>
                        <div class="item">%H<span><?php _e( 'H', 'davinciwoo' ) ?></span></div>
                        <div class="item">%M<span><?php _e( 'M', 'davinciwoo' ) ?></span></div>
                        <div class="item">%S<span><?php _e( 'S', 'davinciwoo' ) ?></span></div>
                    </div>
                </div>
                <?php } //endif; ?>
            </div>
        </div>
    </div>
</div>
<?php } //endif; ?>