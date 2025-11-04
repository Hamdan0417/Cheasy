<?php

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();
$thumb_count = count($attachment_ids)+1;

// Disable thumbnails if there is only one extra image.
if($thumb_count == 1) return;

$rtl = 'false';
$thumb_cell_align = 'left';

if(is_rtl()) {
    $rtl = 'true';
    $thumb_cell_align = 'right';
}

if ( $attachment_ids ) {
    $loop     = 0;
    $columns  = adswth_option( 'product_image_thumbnails_columns' );

    $direction = adswth_option( 'product_image_style' );

    $gallery_class = [ 'product-thumbnails','thumbnails' ];
    
    if(($direction == 'vertical' && $thumb_count <= 5) || ($direction == 'normal' && $thumb_count <= $columns )){
        $gallery_class[] = 'slider-no-arrows';
    }

    $gallery_class[] = 'slider  slider-nav-small';

    if( $direction == 'normal' ) {
	    $gallery_class[] = 'no-gutters row-small row-slider';
	    $gallery_class[] = 'xs-columns-' . $columns;
    }

    $gallery_class[] = 'direction-' . $direction;
    ?>
    <div class="<?php echo implode(' ', $gallery_class); ?>" data-count="<?php echo $thumb_count; ?>" data-columns="<?php echo $columns?>">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-container product-main-slider-thumbs">
            <div class="swiper-wrapper">
                <?php

                if ( has_post_thumbnail() ) : ?>
                    <?php
                    $image_size = 'thumbnail';

                    $image_check = wc_get_image_size( 'gallery_thumbnail' );

                    if($image_check['width'] !== 100) $image_size = 'gallery_thumbnail';

                    $gallery_thumbnail = wc_get_image_size( $image_size ); ?>
                    <div class="is-nav-selected first swiper-slide" data-index="0">

                        <a class="image-wrap">
                            <div class="image-inner">
                                <?php
                                $image_id = get_post_thumbnail_id($post->ID);
                                $image =  wp_get_attachment_image_src( $image_id, 'woocommerce_'.$image_size );
                                $image = '<img src="'.$image[0].'" width="'.$gallery_thumbnail['width'].'" height="'.$gallery_thumbnail['height'].'" class="attachment-woocommerce_thumbnail" />';
                                echo $image;
                                ?>
                            </div>
                        </a>
                    </div>
                    <?php do_action('adswth_product_main_slider_after_thumbnail'); ?>
                    <?php

                    foreach ( $attachment_ids as $key => $attachment_id ) {

                        $classes = array( '' );
                        $image_class = esc_attr( implode( ' ', $classes ) );
                        $image =  wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'woocommerce_'.$image_size ));
                        $image = '<img src="'.$image[0].'" width="'.$gallery_thumbnail['width'].'" height="'.$gallery_thumbnail['height'].'"  class="attachment-woocommerce_thumbnail" />';

                        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="swiper-slide" data-index="%s"><a class="image-wrap"><div class="image-inner">%s</div></a></div>', $key+1, $image ), $attachment_id, $post->ID, $image_class );

                        $loop++;
                    }
                endif; ?>
            </div>
        </div>
    </div><!-- .product-thumbnails -->
  <?php
} ?>
