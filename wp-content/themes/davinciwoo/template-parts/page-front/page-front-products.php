<?php if( adswth_option( 'page_front_products_block_show' ) && is_woocommerce_activated() ) { ?>

	<?php $sections = adswth_option( 'page_front_products_sorting' ); ?>

    <?php if( count( $sections ) > 0 ) { ?>

    <div id="products-front" class="products-front">

        <?php foreach ( $sections as $section ) { ?>

	        <?php get_template_part('template-parts/page-front/partials/section', $section); ?>

        <?php } //endforeach; ?>

    </div>
	<?php } //endif; ?>
<?php } //endif; ?>
