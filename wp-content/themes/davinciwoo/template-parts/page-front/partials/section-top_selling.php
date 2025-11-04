<?php
    $scheme = adswth_option( 'products_top_selling_scheme' );
    $count = $scheme == 'line' ? adswth_option( 'products_top_selling_count' ) : 8;
    $volume = $scheme == 'line' ? adswth_option( 'products_top_selling_volume' ) : false;
    adswth_page_front_products_section( 'top_selling', $scheme, $count, $volume );
?>






