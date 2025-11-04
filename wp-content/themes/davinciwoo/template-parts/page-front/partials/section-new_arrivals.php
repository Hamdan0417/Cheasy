<?php
    $scheme = adswth_option( 'products_new_arrivals_scheme' );
    $count =  $scheme == 'line' ? adswth_option( 'products_new_arrivals_count' ) : 8;
    $volume = $scheme == 'line' ? adswth_option( 'products_new_arrivals_volume' ) : false;
    adswth_page_front_products_section( 'new_arrivals', $scheme, $count, $volume );
?>
