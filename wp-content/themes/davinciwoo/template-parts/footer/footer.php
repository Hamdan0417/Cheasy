<?php do_action( 'adswth_before_footer' ); ?>

<?php if ( is_active_sidebar( 'sidebar-footer-1' ) && adswth_option( 'footer_1_show' ) ) { ?>
	<div class="footer-widgets sidebar-footer-1 container py-3">
		<div class="row <?php echo adswth_footer_row_class( 'footer_1' ); ?> lg-columns-3 md-columns-3 sm-columns-2 xs-columns-1">
			<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
		</div><!-- end row -->
	</div><!-- /.sidebar-footer-1 -->
<?php } //endif; ?>

<?php if ( is_active_sidebar( 'sidebar-footer-1' ) && adswth_option( 'footer_1_show' )
           && is_active_sidebar( 'sidebar-footer-2' ) && adswth_option( 'footer_2_show' ) ) { ?>
    <div class="container">
        <?php do_action( 'adswth_footer_divider' );?>
    </div>
<?php } ?>

<?php if ( is_active_sidebar( 'sidebar-footer-2' ) && adswth_option( 'footer_2_show' ) ) { ?>
    <div class="footer-widgets sidebar-footer-2 container py-3">
        <div class="row <?php echo adswth_footer_row_class( 'footer_2' ); ?>">
			<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
        </div><!-- end row -->
    </div><!-- /.sidebar-footer-2 -->
<?php } //endif; ?>

<?php do_action( 'adswth_after_footer' ); ?>