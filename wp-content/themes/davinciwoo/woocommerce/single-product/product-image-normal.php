<?php
global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
'woocommerce-product-gallery',
'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
'woocommerce-product-gallery--columns-' . absint( $columns ),
'images',
) );

$slider_classes = [ 'product-gallery-slider', 'slider', 'slider-nav-small', 'mb-half' ];

// Image Zoom
if(get_theme_mod('product_zoom', 0)){
$slider_classes[] = 'has-image-zoom';
}

$rtl = 'false';
if(is_rtl()) $rtl = 'true';

if(get_theme_mod('product_lightbox','default') == 'disabled'){
$slider_classes[] = 'disable-lightbox';
}

?>
<?php do_action('adswth_before_product_images'); ?>

<div class="product-images relative mb-half has-hover <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
    <?php do_action( 'adswth_product_image_top' ) ?>
	<div class="image-tools absolute top right z-3">
		<?php do_action('adswth_product_image_tools_top'); ?>
	</div>

    <figure class="woocommerce-product-gallery__wrapper <?php echo implode(' ', $slider_classes); ?>">
        <div class="swiper-container product-main-slider">
            <div class="swiper-wrapper">
                <?php

                if ( has_post_thumbnail() ) {
                    $html  = adswth_wc_get_gallery_image_html( $post_thumbnail_id, true );
                } else {
                    $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
                    $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
                    $html .= '</div>';
                }

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

                do_action( 'woocommerce_product_thumbnails' );
                ?>
            </div>
            <div class="swiper-prev swiper-prev-neutral"></div>
            <div class="swiper-next swiper-next-neutral"></div>
        </div>
        <div class="swiper-pagination"></div>
    </figure>

	<div class="image-tools absolute bottom left z-3">
		<?php do_action('adswth_product_image_tools_bottom'); ?>
	</div>
</div>
<?php do_action('adswth_after_product_images'); ?>

<?php wc_get_template( 'woocommerce/single-product/product-gallery-thumbnails.php' ); ?>
