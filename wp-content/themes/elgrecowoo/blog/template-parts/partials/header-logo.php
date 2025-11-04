<div class="blog-logo-wrap">
    <?php
    $logo = get_theme_mod('blog_logo' );
    $logo = empty( $logo ) ? adswth_option( 'site_logo' ) : $logo;
    ?>
    <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><img class="blog-logo img-fluid" src="<?php echo $logo; ?>" /></a>
</div>