<?php
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action( 'woocommerce_before_main_content', 'adswth_breadcrumbs', 20 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action( 'adswth_after_shop_title', 'woocommerce_catalog_ordering', 30 );

function adswth_shop_sidebar_button() {

	if( is_active_sidebar( 'woocommece-shop-sidebar' ) ) {
		?>
        <div class="woocommece-shop-sidebar-switch-wrap d-xl-none col-auto">
            <button id="woocommece-shop-sidebar-switch" class="woocommece-shop-sidebar-switch">
                <div class="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
        </div>
        <?php
	}
}
add_action( 'adswth_after_shop_title', 'adswth_shop_sidebar_button', 20 );

function adsw_before_product_category_view() {
    ?>
    <div class="row">
    <?php
	    if( is_active_sidebar( 'woocommece-shop-sidebar' ) ) {  ?>

            <div class="col-xl-3">
                <div id="woocommece-shop-sidebar" class="woocommece-shop-sidebar">
                    <div class="sidebar-header d-xl-none">
                        <h2><?php _e( 'Filters', 'davinciwoo' ); ?></h2>
                        <a href="javascript:;" class="close-btn">&times;</a>
                    </div>
                    <div class="woocommece-shop-sidebar-content">
                        <?php dynamic_sidebar( 'woocommece-shop-sidebar' ); ?>
                    </div>
                </div>
                <div id="woocommece-shop-sidebar-overlay" class="d-xl-none"></div>
            </div>
            <div class="col-xl-9">
	    <?php } else { ?>
            <div class="col-xl-12">
	    <?php }
}
add_action( 'adswth_before_main_content', 'adsw_before_product_category_view' );

function adsw_after_product_category_view() {
	?>
        </div>
    </div>
	<?php
}
add_action( 'adswth_after_main_content', 'adsw_after_product_category_view' );

function adswth_before_before_shop_loop(){
    echo '<div class="row"><div class="col-12">';
}
add_action( 'woocommerce_before_shop_loop', 'adswth_before_before_shop_loop', 5 );
function adswth_after_before_shop_loop() {
    echo '</div></div>';
}
add_action( 'woocommerce_before_shop_loop', 'adswth_after_before_shop_loop', 100 );

function adswth_woocommerce_subcategory_box_before ( $category ){
    ?>
    <div class="box-image"><div class="box-image-wrap"><div class="box-image-inner">
    <?php
}
add_action( 'woocommerce_before_subcategory_title', 'adswth_woocommerce_subcategory_box_before', 5, 1 );

function adswth_woocommerce_subcategory_box_after ( $category ){
	?>
    </div></div></div>
	<?php
}
add_action( 'woocommerce_before_subcategory_title', 'adswth_woocommerce_subcategory_box_after', 30, 1 );






