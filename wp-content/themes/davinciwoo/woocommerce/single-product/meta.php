<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<?php if( adswth_option( 'product_page_meta_sku_show' ) || adswth_option( 'product_page_meta_category_show' ) || adswth_option( 'product_page_meta_tag_show' ) ) : ?>

<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) && adswth_option( 'product_page_meta_sku_show' ) ) : ?>

        <div class="sku_wrapper"><div><?php esc_html_e( 'SKU:', 'woocommerce' ); ?></div><div class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></div></div>

	<?php endif; ?>

    <?php if( adswth_option( 'product_page_meta_category_show' ) ) : ?>

        <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="posted_in"><div>' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . '</div><div>', '</div></div>' ); ?>

    <?php endif; ?>

	<?php if( adswth_option( 'product_page_meta_tag_show' ) ) : ?>

	    <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tagged_as"><div>' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . '</div><div>', '</div></div>' ); ?>

    <?php endif; ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>

<?php endif; ?>

