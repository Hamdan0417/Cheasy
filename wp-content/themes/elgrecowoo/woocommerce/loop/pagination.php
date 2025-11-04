<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';
$additional_class = "";
if(adswth_option( 'woo_product_cat_navigation_button_show' )) {
    $additional_class .= " show-navigation";
}
if(adswth_option( 'woo_catalog_plus_paging_show' )) {
    $additional_class .= " show-numbers";
}

if ( $total <= 1 ) {
	return;
}

$pagination = paginate_links( apply_filters( 'woocommerce_pagination_args', array( // WPCS: XSS ok.
    'base'         => $base,
    'format'       => $format,
    'add_args'     => false,
    'current'      => max( 1, $current ),
    'total'        => $total,
    'prev_text'    => '<i class="icon-left-open"></i> ' . __('Previous', 'elgrecowoo'),
    'next_text'    => __('Next', 'elgrecowoo') . ' <i class="icon-right-open"></i>',
    'type'         => 'list',
    'end_size'     => 1,
    'mid_size'     => 2,
    'before_page_number' => '<span class="pagination-element-wrap">',
    'after_page_number'  => '</span>'
) ) ); ?>
<nav class="pagination categories-pagination <?php echo $additional_class; ?>">
    <?php
    echo $pagination;
    ?>
</nav>
<nav class="pagination mobile-categories-pagination categories-pagination d-block d-sm-none <?php echo $additional_class; ?>">
    <?php
    echo $pagination;
    ?>
</nav>