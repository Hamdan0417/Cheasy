<?php
    $volume =  adswth_option( 'products_just_arrived_volume' ) ? adswth_option( 'products_just_arrived_volume' ) : 4;
    adswth_page_front_products( 'just_arrived', $volume );
?>
