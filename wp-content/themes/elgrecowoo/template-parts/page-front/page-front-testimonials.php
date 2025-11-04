<?php if( adswth_option( 'testimonials_block_show' ) ) {
    $src = ADSW_THEME_LAZY_LOAD ? 'data-src' : 'src';
    ?>
    <?php $testimonials_list = adswth_option( 'testimonials_block' ); ?>
    <?php $testimonials_block_title = adswth_option( 'testimonials_block_title' ); ?>
    <?php if( is_array( $testimonials_list ) && count( $testimonials_list ) > 0 ) { ?>
        <?php
        $autoplayConfig = adswth_option( 'testimonials_block_autoplay' );
        $autoplay = isset($autoplayConfig) ? $autoplayConfig : true;
        $delay = adswth_option( 'testimonials_block_autoplay_delay' ) ? adswth_option( 'testimonials_block_autoplay_delay' )*1000 : 5000;
        $params = array(
            "autoplay" => $autoplay,
            "delay" => $delay,
        );
        function adswth_testimonials_slider_control($params){
            wp_localize_script( 'elgrecowoo-js-all', 'testimonialsSliderControl', array( 'params' => $params ) );
        }
        adswth_testimonials_slider_control($params);
        add_action( 'wp_enqueue_scripts', 'adswth_testimonials_slider_control',999 );

        ?>
        <div class="testimonials-block-wrap my-px-50">
            <div class="testimonials-slider">
                    <?php foreach ($testimonials_list as $item){ ?>
                        <div class="slide">
                            <div class="item d-flex">
                                <div class="item-left">
                                    <?php if(isset($item['review_photo']) && !empty($item['review_photo'])){ ?>
                                        <?php $review_photo = is_numeric($item['review_photo']) ? wp_get_attachment_url($item['review_photo']) : $item['review_photo']; ?>
                                        <img <?php echo $src; ?>="<?php echo $review_photo; ?>" alt="<?php echo $item['customer_name']; ?>" />
                                    <?php } //endif; ?>
                                </div>
                                <div class="item-right d-flex">
                                    <?php if(isset($testimonials_block_title) && !empty($testimonials_block_title)){ ?>
                                        <h4><?php echo $testimonials_block_title; ?></h4>
                                    <?php } //endif; ?>
                                    <div class="testimonial-author-wrap d-flex mt-px-40">
                                        <?php if(isset($item['customer_photo']) && !empty($item['customer_photo'])){ ?>
                                            <?php $customer_photo = is_numeric($item['customer_photo']) ? wp_get_attachment_url($item['customer_photo']) : $item['customer_photo']; ?>
                                            <div class="testimonial-photo">
                                                <img <?php echo $src; ?>="<?php echo $customer_photo; ?>" alt="<?php echo $item['customer_name']; ?>" />
                                            </div>
                                        <?php } //endif; ?>
                                        <div class="testimonial-author-right d-flex align-items-center justify-content-center ">
                                            <?php if(isset($item['testimonial_star']) && !empty($item['testimonial_star'])){ ?>
                                                <div class="testimonial-star">
                                                    <?php echo wc_get_rating_html( intval($item['testimonial_star']) );?>
                                                </div>
                                            <?php } //endif; ?>
                                            <?php if(isset($item['customer_name']) && !empty($item['customer_name'])){ ?>
                                                <div class="testimonial-author"><?php echo $item['customer_name']; ?></div>
                                            <?php } //endif; ?>
                                        </div>
                                    </div>
                                    <?php if(isset($item['testimonial_text']) && !empty($item['testimonial_text'])){ ?>
                                        <div class="text mt-px-20"><?php echo $item['testimonial_text']; ?></div>
                                    <?php } //endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php } //endforeach ?>
            </div>
        </div>
    <?php } //endif; ?>
<?php } //endif; ?>
