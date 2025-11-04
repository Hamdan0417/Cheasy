<?php if( adswth_option( 'instagram_block_show' ) &&  shortcode_exists( 'adswst_instagram' )) { ?>
    <?php
        $instagram_name = adswth_option( 'instagram_block_username' );
        $instagram_token = "";
        if (adswth_option("instagram_block_access_token_show") && adswth_option("instagram_block_access_token")) {
            $instagram_token = adswth_option(  "instagram_block_access_token" );
        }
    ?>
    <?php if( isset( $instagram_name ) && !empty( $instagram_name ) || (isset( $instagram_token ) && !empty( $instagram_token ) ) ) { ?>
    <div class="instagram-block mt-px-50">
        <div class="block-title-wrap text-center">
            <div class="block-title">
                <a href="https://www.instagram.com/<?php echo $instagram_name; ?>/" target="_blank"><?php echo adswth_option( 'instagram_block_title' ); ?></a>
            </div>
            <div class="block-subtitle mt-px-10">
                <a href="https://www.instagram.com/<?php echo $instagram_name; ?>/" target="_blank">@<?php echo $instagram_name; ?></a>
            </div>
        </div>
        <div class="instagram-block-content mt-px-30">
            <?php
            if( isset( $instagram_token ) && !empty( $instagram_token ) ) {
                echo(do_shortcode('[adswst_instagram number=6, token="' . $instagram_token . '"]'));
            }
            else {
                echo(do_shortcode('[adswst_instagram username="'. $instagram_name. '"]'));
            }
            ?>
        </div>
    </div>
    <?php } //endif; ?>
<?php } //endif; ?>