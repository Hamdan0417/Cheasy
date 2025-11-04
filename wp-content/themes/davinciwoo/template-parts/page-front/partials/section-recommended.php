<?php
    $scheme = adswth_option( 'products_recommended_scheme' );
    $count = $scheme == 'line' ? adswth_option( 'products_recommended_count' ) : 8;
    $volume = $scheme == 'line' ? adswth_option( 'products_recommended_volume' ) : false;
    adswth_page_front_products_section( 'recommended', $scheme, $count, $volume );
?>
