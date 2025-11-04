<?php
    $volume =  adswth_option( 'featured_products_volume' ) ? adswth_option( 'featured_products_volume' ) : 4;
    adswth_page_front_products( 'featured', $volume );
?>
