<?php if( is_woocommerce_activated() && adswth_option('header_account_show') ){ ?>
<div class="header-account-wrap">
    <div class="header-account">
        <?php if ( is_user_logged_in() ) { ?>
            <a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php _e( 'My account', 'woocommerce' ); ?>">
                <i class="icon-user"></i>
                <span class="header-account-title"><?php _e( 'My account', 'woocommerce' ); ?></span>
            </a>
        <?php } else { ?>
            <a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php _e( 'Log in', 'woocommerce' ); ?><?php if( adswth_option( 'header_account_register' ) ){ echo ' / '.__( 'Register', 'woocommerce' ); } ?>" >
                <i class="icon-user"></i>
                <span><?php _e( 'Log in', 'woocommerce' ); ?><?php if( adswth_option( 'header_account_register' ) ){ echo ' / '.__( 'Register', 'woocommerce' ); } ?></span>
            </a>
        <?php } //endif; ?>
    </div>
</div>
<?php } //endif; ?>