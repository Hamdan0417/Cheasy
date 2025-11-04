<?php if( adswth_option( 'spp_show_badges_above_cart' ) ) {
    $free_shipping_text = adswth_option('spp_above_cart_free_shipping_text');
    $free_shipping_img = adswth_option('spp_above_cart_free_shipping_image');
    $refunds_text = adswth_option('spp_above_cart_returns_text');
    $refunds_img = adswth_option('spp_above_cart_returns_image');

    if($free_shipping_text || $refunds_text){ ?>
        <div class="product-shipping-content d-flex align-items-md-center">
            <?php if($free_shipping_text || $free_shipping_img){ ?>
                <div class="item">
                    <?php if($free_shipping_img)?><img src="<?php echo $free_shipping_img; ?>" alt="<?php echo $free_shipping_text; ?>" />
                    <?php echo $free_shipping_text; ?>
                </div>
            <?php } //endif ?>
            <?php if($refunds_text || $refunds_img){ ?>
                <div class="item">
                    <?php if($refunds_img)?><img src="<?php echo $refunds_img; ?>" alt="<?php echo $refunds_text; ?>" />
                    <?php echo $refunds_text; ?>
                </div>
            <?php } //endif ?>
        </div>
    <?php } //endif ?>
<?php } //endif ?>
