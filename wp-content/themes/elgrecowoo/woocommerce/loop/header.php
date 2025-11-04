<?php
/**
 * Product taxonomy archive header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<header class="woocommerce-products-header row no-gutters justify-content-between align-items-center">
    <?php
    /**
     * Hook: adswth_after_shop_title.
     *
     */
    do_action( 'adswth_before_shop_title' );
    ?>
	<?php
	/**
	 * Hook: woocommerce_show_page_title.
	 *
	 * Allow developers to remove the product taxonomy archive page title.
	 *
	 * @since 2.0.6.
	 */
    if ( apply_filters( 'woocommerce_show_page_title', true ) ) { ?>
        <div class="category-page-title-wrap col-12 mr-xl-auto">
            <h1 class="woocommerce-products-header__title page-title">
                <?php woocommerce_page_title(); ?>
            </h1>
            <span class="woocommerce-products-header__count">(<?php echo wc_get_loop_prop( 'total' )?>)</span>
        </div>
    <?php } //endif; ?>

    <?php
    /**
     * Hook: adswth_after_shop_title.
     *
     * @hooked adswth_shop_sidebar_button - 20 - added in /include/woocommerce/structure-wc-category-page.php
     * @hooked woocommerce_catalog_ordering - 30 - added in /include/woocommerce/structure-wc-category-page.php
     */
    do_action( 'adswth_after_shop_title' );
    ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @since 1.6.2.
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
