<?php
/**
 * Single product gallery video thumbnail template
 *
 * @author Bogdan Gorchakov
 * @package AliDropship Woo Product Video
 * @version 1.0.0
 */

/**
 * Template variables:
 *
 * @var $thumbnail   string Url to video thumbnail
 */
?>
<div class="alids-woo-product-video-thumbnail swiper-slide">
    <a class="image-wrap">
        <div class="image-inner">
            <img src="<?=$thumbnail?>" class="attachment-woocommerce_thumbnail" />
            <i class="icon-play" aria-hidden="true"></i>
        </div>
    </a>
</div>