<?php
$has_content = ! empty( get_the_content() );
if ( $has_content ) { ?>
    <div class="container">
        <div class="home-article-wrap">
            <div class="home-article content"><?php the_content(); ?></div>
            <div class="home-article-more"><a href="#"><?php _e( 'Read more', 'elgrecowoo' ); ?></a></div>
            <?php edit_post_link( __( 'Edit', 'elgrecowoo'), '<div>', '</div>' ); ?>
        </div>
    </div>
<?php } //endif; ?>
