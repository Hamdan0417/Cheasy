<?php if( adswth_option( 'most_popular_categories_show' ) ) {
    $src = ADSW_THEME_LAZY_LOAD ? 'data-src' : 'src';
    ?>
    <div class="container">
        <div class="most-popular-categories mt-px-50">
            <?php if( adswth_option( 'most_popular_categories_show' ) ) { ?>
                <div class="block-title-wrap text-center">
                    <h3 class="block-title"><?php echo adswth_option( 'most_popular_categories_title' ); ?></h3>
                </div>
            <?php } //endif; ?>
            <?php $most_popular_categories = adswth_option( 'most_popular_categories' ); ?>
            <?php if( is_array( $most_popular_categories ) && count( $most_popular_categories ) > 0 ) { ?>
                <div class="most-popular-categories-slider mt-px-30 mb-px-30">
                        <?php foreach ($most_popular_categories as $item){ ?>
                            <?php if( isset( $item[ 'category_image' ] ) && !empty( $item[ 'category_image' ] ) ) { ?>
                                <?php $slide_image = is_numeric( $item[ 'category_image' ] ) ? wp_get_attachment_url( $item[ 'category_image' ] ) : $item[ 'category_image' ]; ?>
                                <?php
                                    if(is_numeric( $item[ 'category_image' ] )){
                                        $image = wp_get_attachment_image_src($item[ 'category_image' ], 'adswth-most-popular', false);
                                        $slide_image = $image[0];
                                    } else {
                                        $slide_image = $item[ 'category_image' ];
                                    }
                                ?>
                                <div class="slide">
                                    <div class="most-popular-image">
                                        <img <?php echo $src; ?>="<?php echo $slide_image ?>" alt="<?php echo $item['category_name'] ?>"/>
                                    </div>
                                    <?php if(isset( $item['category_link'] ) && !empty( $item['category_link'] )){ ?>
                                        <a href="<?php echo $item['category_link'] ?>">
                                    <?php } //endif ?>
                                    <div class="caption-wrap d-flex align-items-center justify-content-center" style="background-color: <?php echo $item['category_overlay_color'] ?>; color: <?php echo $item['category_name_color'] ?>;">
                                        <div class="caption">
                                            <h3 class="category-title"><?php echo $item['category_name'] ?></h3>
                                            <p class="category-description"><?php echo $item['category_text'] ?></p>
                                        </div>
                                    </div>
                                    <?php if(isset( $item['category_link'] ) && !empty( $item['category_link'] )){ ?>
                                        </a>
                                    <?php } //endif ?>
                                </div>
                            <?php } //endif ?>
                        <?php } //endforeach ?>
                </div>
            <?php } //endif; ?>
        </div>
    </div>
<?php } //endif; ?>
