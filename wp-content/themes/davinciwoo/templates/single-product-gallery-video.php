<?php
/**
 * Single product gallery video template
 *
 * @author Bogdan Gorchakov
 * @package AliDropship Woo Product Video
 * @version 1.0.0
 */

/**
 * Template variables:
 *
 * @var $thumbnail   string Url to video thumbnail
 * @var $video_type  string Type of video (youtube, video, mp4)
 * @var $video_embed string Video embed url
 * @var $url         string Video url
 */
?>
<div data-thumb="<?php echo $thumbnail ?>" class="woocommerce-product-gallery__image swiper-slide alids-woo-product-video <?=$video_type ? 'video-type-' . $video_type : ''?>">
    <?php if($video_type == 'youtube'){ ?>
        <iframe width="100%" height="330px" src="<?=$video_embed?>" data-src="<?=$video_embed?>" frameborder="0" allowfullscreen></iframe>
    <?php } else if($video_type == 'vimeo'){ ?>
        <iframe width="100%" height="330px" src="<?=$video_embed?>" data-src="<?=$video_embed?>" frameborder="0" allowfullscreen></iframe>
    <?php } else { ?>
        <video width="100%" height="100%" poster="<?=esc_url($thumbnail)?>" controls="controls" disablePictureInPicture controlslist="nodownload" src="<?=esc_url($url)?>"></video>
    <?php } ?>
    <div class="play-video-block">
        <div class="play-video-block-icon"></div>
        <img src="<?=esc_url($thumbnail)?>" />
    </div>
</div>