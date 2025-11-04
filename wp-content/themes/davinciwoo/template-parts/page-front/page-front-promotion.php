<?php
    $has_content = ! empty( get_the_content() );
    $has_sidebar = is_active_sidebar( 'front-page-sidebar' );

    if( $has_content && $has_sidebar ){
	    $content_class = 'col-xl-9 col-12';
	    $sidebar_class = 'col-xl-3 col-12';
    } elseif ( $has_content && !$has_sidebar ){
	    $content_class = 'col-12';
	    $sidebar_class = '';
    } elseif ( !$has_content && $has_sidebar ){
	    $content_class = '';
	    $sidebar_class = 'col-12 no-content';
    } else {
	    $content_class = '';
	    $sidebar_class = '';
    }
?>
<?php if( $has_content || $has_sidebar ) { ?>
	<div class="divider"></div>
	<div class="row">
		<?php if ( $has_content ) { ?>
		<div class="<?php echo $content_class; ?> home-article-wrap">
			<div class="home-article content"><?php the_content(); ?></div>
            <div class="home-article-more"><a href="#"><?php _e( 'Read more', 'davinciwoo' ); ?></a></div>
		</div>
		<?php } //endif; ?>
		<?php if ( $has_sidebar ) { ?>
		<div class="<?php echo $sidebar_class; ?> front-page-sidebar-wrap">
				<div id="front-page-sidebar" class="front-page-sidebar">
                    <?php if( ! empty( adswth_option( 'front_page_sidebar_title' ) ) ){ ?>
                    <h2 class="sidebar-title"><?php echo adswth_option( 'front_page_sidebar_title' ); ?></h2>
                    <?php } //endif; ?>
                    <div class="widget-area row justify-content-center">
					<?php dynamic_sidebar( 'front-page-sidebar' ); ?>
                    </div>
				</div><!-- #primary-sidebar -->
		</div>
		<?php } //endif; ?>
	</div>
<?php } //endif; ?>
