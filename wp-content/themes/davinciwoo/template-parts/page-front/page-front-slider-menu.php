<?php if( adswth_option( 'slider_menu_show' ) && has_nav_menu('slider_menu' ) ){ ?>
<div class="col-auto slider-menu-wrap d-none d-xl-block">
	<ul class="slider-menu">
		<?php wp_nav_menu( [
			'menu'           => __( 'Slider Menu', 'davinciwoo' ),
			'theme_location' => 'slider_menu',
			'depth'          => 0,
			'container'      => false,
			'items_wrap'     => '%3$s',
			'walker'         => new \adswth\walker\adsMenuDropdown(),
            'show_count'     => adswth_option( 'menu_product_cat_show_count' )
		] ); ?>
	</ul>
</div>
<?php } //endif; ?>