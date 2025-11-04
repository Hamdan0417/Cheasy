<div class="col main-slider-wrap" >
    <div class="row no-gutters h-100">

        <div class="col">
            <?php adswth_main_slider( adswth_option( 'main_banner' ), adswth_option( 'main_banner_autoplay' ), adswth_option( 'main_banner_autoplay_slide_delay' ) ); ?>
        </div>

        <?php $additional_banner_count = adswth_integer( adswth_option( 'slider_layout' ) ); ?>
        <?php if( $additional_banner_count >= 2 ){ ?>

            <div class="d-none d-lg-block col-3">
                <div class="d-flex flex-column no-gutters h-100">
                    <div id="additional-banner-1" class="col">
                        <?php if( adswth_option( 'additional_banner_1_link' ) ){ ?><a class="main-banner-link" href="<?php echo esc_url( adswth_option( 'additional_banner_1_link' ) )?>" ><?php } ?>
                        <div class="additional-banner-img d-flex h-100 align-items-end" style="background-image: url( <?php echo adswth_option('additional_banner_1_image');?> )">
                            <?php if( adswth_option( 'additional_banner_1_text' ) ){ ?>
                                <div class="main-banner-text w-100">
                                    <?php echo adswth_option( 'additional_banner_1_text' ); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if( adswth_option( 'additional_banner_1_link' ) ){ ?></a><?php } ?>
                    </div>
                    <?php if( $additional_banner_count >= 3 ){ ?>
                    <div id="additional-banner-2" class="col">
                        <?php if( adswth_option( 'additional_banner_2_link' ) ){ ?><a class="main-banner-link" href="<?php echo esc_url( adswth_option( 'additional_banner_2_link' ) )?>" ><?php } ?>
                        <div class="additional-banner-img d-flex h-100 align-items-end" style="background-image: url( <?php echo adswth_option('additional_banner_2_image');?> )">
                            <?php if( adswth_option( 'additional_banner_2_text' ) ){ ?>
                                <div class="main-banner-text w-100">
                                    <?php echo adswth_option( 'additional_banner_2_text' ); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if( adswth_option( 'additional_banner_2_link' ) ){ ?></a><?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>

        <?php } ?>

    </div>
</div>