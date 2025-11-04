<?php
/**
 * Faq tab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$about_title_one =  adswth_option( 'product_page_tab_about_title_one' );
$about_description_one =  wp_unslash(adswth_option( 'product_page_tab_about_description_one' ));
$about_image_one =  adswth_option( 'product_page_tab_about_image_one' );
$about_title_two =  adswth_option( 'product_page_tab_about_title_two' );
$about_description_two =  wp_unslash(adswth_option( 'product_page_tab_about_description_two' ));
$about_image_two =  adswth_option( 'product_page_tab_about_image_two' );
$about_title_three =  adswth_option( 'product_page_tab_about_title_three' );
$about_description_three =  wp_unslash(adswth_option( 'product_page_tab_about_description_three' ));
$about_image_three =  adswth_option( 'product_page_tab_about_image_three' );

?>
<div class="about-us-tab-inner d-flex">
    <?php if(!empty($about_title_one) || !empty($about_description_one) || !empty($about_image_one)){ ?>
        <div class="about-us-tab">
            <div class="about-us-tab-head">
                <?php if(!empty($about_image_one)){ ?>
                    <div class="about-us-tab-img">
                        <img src="<?php echo $about_image_one; ?>" alt="<?php echo $about_title_one; ?>" />
                    </div>
                <?php } //endif; ?>
                <?php if(!empty($about_title_one)){ ?>
                    <div class="about-us-tab-title">
                        <?php echo $about_title_one; ?>
                    </div>
                <?php } //endif; ?>
            </div>
            <?php if(!empty($about_description_one)){ ?>
                <div class="about-us-tab-text">
                    <?php echo $about_description_one; ?>
                </div>
            <?php } //endif; ?>
        </div>
    <?php } //endif; ?>
    <?php if(!empty($about_title_two) || !empty($about_description_two) || !empty($about_image_two)){ ?>
        <div class="about-us-tab">
            <div class="about-us-tab-head">
                <?php if(!empty($about_image_two)){ ?>
                    <div class="about-us-tab-img">
                        <img src="<?php echo $about_image_two; ?>" alt="<?php echo $about_title_two; ?>" />
                    </div>
                <?php } //endif; ?>
                <?php if(!empty($about_title_two)){ ?>
                    <div class="about-us-tab-title">
                        <?php echo $about_title_two; ?>
                    </div>
                <?php } //endif; ?>
            </div>
            <?php if(!empty($about_description_two)){ ?>
                <div class="about-us-tab-text">
                    <?php echo $about_description_two; ?>
                </div>
            <?php } //endif; ?>
        </div>
    <?php } //endif; ?>
    <?php if(!empty($about_title_three) || !empty($about_description_three) || !empty($about_image_three)){ ?>
        <div class="about-us-tab">
            <div class="about-us-tab-head">
                <?php if(!empty($about_image_three)){ ?>
                    <div class="about-us-tab-img">
                        <img src="<?php echo $about_image_three; ?>" alt="<?php echo $about_title_three; ?>" />
                    </div>
                <?php } //endif; ?>
                <?php if(!empty($about_title_three)){ ?>
                    <div class="about-us-tab-title">
                        <?php echo $about_title_three; ?>
                    </div>
                <?php } //endif; ?>
            </div>
            <?php if(!empty($about_description_three)){ ?>
                <div class="about-us-tab-text">
                    <?php echo $about_description_three; ?>
                </div>
            <?php } //endif; ?>
        </div>
    <?php } //endif; ?>
</div>
