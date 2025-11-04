<?php
	$volume =  adswth_option( 'products_best_deals_volume' ) ? adswth_option( 'products_best_deals_volume' ) : 4;
    adswth_page_front_products( 'best_deals', $volume );
?>
