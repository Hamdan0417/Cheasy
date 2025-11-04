<?php if( adswth_option( 'product_page_guaranteed_safe_show' ) ) {
    $title = adswth_option( 'product_page_guaranteed_safe_title' );
    $icons = adswth_option( 'product_page_guaranteed_safe_icons' );
?>
    <div class="guaranteed-safe-wrap">
        <?php if(isset($title)){ ?>
        <div class="title">
            <span><?php echo $title; ?></span>
        </div>
        <?php } ?>
        <?php if(!empty($icons)){ ?>
            <ul>
                <?php foreach ($icons as $icon){ ?>
                    <?php if(!empty($icon['guaranteed_safe_icon'])){ ?>
                        <?php $icon_image = is_numeric( $icon[ 'guaranteed_safe_icon' ] ) ? wp_get_attachment_url( $icon[ 'guaranteed_safe_icon' ] ) : $icon[ 'guaranteed_safe_icon' ]; ?>
                        <li>
                            <img src="<?php echo $icon_image; ?>" alt="Icon" />
                        </li>
                    <?php } //endif; ?>
                <?php } //endforeach ?>
            </ul>
        <?php } ?>
    </div>
<?php } //endif; ?>
