<?php
    $volume =  adswth_option( 'products_trending_now_volume' ) ? adswth_option( 'products_trending_now_volume' ) : 4;
    adswth_page_front_products( 'trending_now', $volume );
?>






