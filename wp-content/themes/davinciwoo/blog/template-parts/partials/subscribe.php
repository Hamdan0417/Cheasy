<?php
if( is_blog() && adswth_option('blog_subscribe_block_show') ){ ?>
    <div class="subscribe_cont">
        <?php echo adswth_option( 'blog_subscribe_code' ); ?>
    </div>
<?php } //endif;
