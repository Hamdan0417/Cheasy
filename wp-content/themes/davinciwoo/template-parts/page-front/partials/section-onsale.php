<?php
    $scheme = adswth_option( 'products_onsale_scheme' );
    $count = $scheme == 'line' ? adswth_option( 'products_onsale_count' ) : 8;
	$volume = $scheme == 'line' ? adswth_option( 'products_onsale_volume' ) : false;
    adswth_page_front_products_section( 'onsale', $scheme, $count, $volume );
?>