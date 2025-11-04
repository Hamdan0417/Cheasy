<?php
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'adswth_woocommerce_shop_loop_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10);


remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
add_action('adswth_before_shop_loop_item_image', 'woocommerce_template_loop_product_link_open', 10);
add_action('adswth_after_shop_loop_item_image', 'woocommerce_template_loop_product_link_close', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 30);


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'adswth_woocommerce_shop_loop_images', 'adswth_woocommerce_template_loop_product_thumbnail', 10);

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
