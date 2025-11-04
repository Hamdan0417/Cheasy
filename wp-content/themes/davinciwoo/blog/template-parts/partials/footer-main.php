<div class="container">
    <div class="row justify-content-between">
        <div class="col-auto mx-auto mx-md-0 order-md-1 order-2 footer_copyright text-center text-md-left">
            <?php if( !empty ( adswth_option( 'blog_footer_absolute_text_primary' ) ) ) { ?>
                <div class="blog-footer-absolute-primary">
                    <?php echo adswth_option( 'blog_footer_absolute_text_primary' ); ?>
                </div>
            <?php } //endif; ?>
            <?php if( !empty ( adswth_option( 'blog_footer_absolute_text_secondary' ) ) ) { ?>
                <div class="blog-footer-absolute-secondary">
                    <?php echo adswth_option( 'blog_footer_absolute_text_secondary' ); ?>
                </div>
            <?php } //endif; ?>
        </div>
        <?php if ( is_active_sidebar( 'blog-footer-sidebar' ) ) { ?>
        <div class="col-auto mx-auto mx-md-0 order-md-2 order-1 blog-footer-widgets">
            <?php dynamic_sidebar( 'blog-footer-sidebar' ); ?>
        </div>
        <?php } ?>
    </div>
</div>