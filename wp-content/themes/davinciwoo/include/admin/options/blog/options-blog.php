<?php
/**
 * Blog panel.
 */

\adswth\adsOptions::add_panel( 'blog', [
    'title' => __( 'Blog', 'davinciwoo' ),
    'priority' => 90,
] );

include_once( dirname( __FILE__ ) . '/options-blog-header.php' );
include_once( dirname( __FILE__ ) . '/options-blog-banner.php' );
include_once( dirname( __FILE__ ) . '/options-blog-subscribe.php' );
include_once( dirname( __FILE__ ) . '/options-blog-footer.php' );
include_once( dirname( __FILE__ ) . '/options-blog-style.php' );
include_once( dirname( __FILE__ ) . '/options-blog-heading.php' );