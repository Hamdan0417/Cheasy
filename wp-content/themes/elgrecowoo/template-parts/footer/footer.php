<?php do_action( 'adswth_before_footer' ); ?>

<?php if ( is_active_sidebar( 'sidebar-footer-1' ) && adswth_option( 'footer_1_show' ) ) { ?>
	<div class="footer-widgets sidebar-footer-1 container py-3">
		<div class="row <?php echo adswth_footer_row_class( 'footer_1' ); ?> lg-columns-3 md-columns-3 sm-columns-2 xs-columns-1">
			<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
		</div><!-- end row -->
	</div><!-- /.sidebar-footer-1 -->
<?php } //endif; ?>

<?php
$payment_methods_icons = adswth_option( 'footer_payment_methods_icons' );
$trust_badges_icons = adswth_option( 'footer_trust_badges_icons' );
$src = ADSW_THEME_LAZY_LOAD ? 'data-src' : 'src';
?>
<?php if ((is_array( $payment_methods_icons ) && count( $payment_methods_icons ) > 0) || (is_array( $trust_badges_icons ) && count( $trust_badges_icons )  > 0)){ ?>
    <div class="footer-widgets sidebar-footer-2 container py-xs-px-15 py-sm-px-15 py-md-px-15 py-lg-px-15">
        <div class="row">
            <?php if(count( $payment_methods_icons ) > 0 && adswth_option( 'footer_payment_methods_show' )){ ?>
                <div class="col-12 py-xl-3 col-md">
                    <div class="payment-methods-wrap mb-xs-px-15 mb-sm-px-15">
                        <h5 class="widget-title mb-md-px-10"><?=adswth_option( 'footer_payment_methods_title' )?></h5>
                        <div class="icons-wrap">
                            <?php foreach($payment_methods_icons as $payment_icon): ?>
                                <?php $payment_icon_src = is_numeric($payment_icon['footer_payment_icon']) ? wp_get_attachment_url($payment_icon['footer_payment_icon']) : $payment_icon['footer_payment_icon']; ?>
                                <img <?php echo $src; ?>="<?=$payment_icon_src?>">
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(count( $trust_badges_icons ) > 0 && adswth_option( 'footer_trust_badges_show' )){ ?>
                <div class="col-12 py-xl-3 col-md">
                    <div class="security-methods-wrap">
                        <h5 class="widget-title mb-md-px-10"><?=adswth_option( 'footer_trust_badges_title' )?></h5>
                        <div class="icons-wrap">
                            <?php foreach($trust_badges_icons as $trust_icon): ?>
                                <?php $trust_icon_src = is_numeric($trust_icon['footer_trust_badges_icon']) ? wp_get_attachment_url($trust_icon['footer_trust_badges_icon']) : $trust_icon['footer_trust_badges_icon']; ?>
                                <span>
                                    <img <?php echo $src; ?>="<?=$trust_icon_src?>">
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div><!-- /.sidebar-footer-2 -->
<?php } //endif; ?>
<?php do_action( 'adswth_after_footer' ); ?>