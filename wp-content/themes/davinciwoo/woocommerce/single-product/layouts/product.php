<?php
global $product;
$post_thumbnail_id = $product->get_image_id();
$full_size = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
$main_img = wp_get_attachment_image_src( $post_thumbnail_id, $full_size );
?>
<div class="product-container">
	<div class="product-main<?=adswth_option( 'add_to_cart_button_sticky' ) ? ' sticky-add-to-cart-button' : ''?>" data-main-img="<?php echo $main_img ? $main_img[0] : ''?>">
		<div class="row mb-0">
			<div class="product-gallery col-12 col-lg-6">
                <div class="product-gallery-inner direction-<?php echo adswth_option( 'product_image_style' ); ?> nav-position-<?php echo adswth_option( 'product_image_thumbnails_position' ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
				<?php
				/**
				 * woocommerce_before_single_product_summary hook
                 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
                </div>
			</div>
            <div class="product-summary col-12 col-lg-6">
	            <?php
	            /**
	             * Hook: woocommerce_single_product_summary.
	             *
	             * @hooked woocommerce_template_single_title - 5
	             * @hooked woocommerce_template_single_rating - 10
	             * @hooked woocommerce_template_single_price - 10
	             * @hooked woocommerce_template_single_excerpt - 20
	             * @hooked woocommerce_template_single_add_to_cart - 30
	             * @hooked woocommerce_template_single_meta - 40
	             * @hooked woocommerce_template_single_sharing - 50  removed in /include/woocommerce/structure-wc-product-page.php
	             * @hooked WC_Structured_Data::generate_product_data() - 60
	             */
	            do_action( 'woocommerce_single_product_summary' );
	            ?>
            </div>
		</div>
		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10 removed in /include/woocommerce/structure-wc-product-page.php
		 * @hooked woocommerce_upsell_display - 15           removed in /include/woocommerce/structure-wc-product-page.php
		 * @hooked woocommerce_output_related_products - 20  removed in /include/woocommerce/structure-wc-product-page.php
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>
        <div class="row mt-xs-px-15 mt-sm-px-15 mt-px-30">
            <div class="col-xl-9 product-description-area">
	            <?php
	            /**
	             * Hook: adswth_single_product_data.
	             *
	             * @hooked woocommerce_output_product_data_tabs - 10  added in /include/woocommerce/structure-wc-product-page.php
                 * @hooked woocommerce_upsell_display - 20            added in /include/woocommerce/structure-wc-product-page.php
                 * @hooked adswth_product_comments_template - 30      added in /include/woocommerce/structure-wc-product-page.php
	             */
	            do_action( 'adswth_single_product_data' );
	            ?>
            </div>
            <div class="col-xl-3 product-sidebar">
	            <?php
	            /**
	             * Hook: adswth_single_product_upsell
	             * @hooked woocommerce_upsell_display - 10            added in /include/woocommerce/structure-wc-product-page.php
                 * @hooked woocommerce_output_related_products - 20   added in /include/woocommerce/structure-wc-product-page.php
	             */
	            do_action( 'adswth_single_product_upsell' );
	            ?>
            </div>
        </div>
	</div><!-- .product-main -->

	<div class="product-footer">
        <?php
            /**
             * Hook: adswth_single_product_footer
             * @hooked adswth_recently_viewed_display - 10            added in /include/woocommerce/structure-wc-product-page.php
             */
            do_action( 'adswth_single_product_footer' );
        ?>
	</div><!-- .product-footer -->
</div><!-- .product-container -->