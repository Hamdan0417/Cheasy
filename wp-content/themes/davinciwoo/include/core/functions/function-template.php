<?php

/**
 * Display placeholder with tooltip message on header elements when they miss a resource.
 */

function adswth_header_element_error( $resource ) {
	$title = '';
	switch ( $resource ) {
		case 'woocommerce':
			$title = __( 'WooCommerce needed', 'davinciwoo' );
	}
	echo '<a class="element-error" title="' . esc_attr( $title ) . '">' . esc_attr( $title ) . '</a>';
}

function adswth_main_slider( $slides, $autoplay = true, $delay = 10000 ){

    if( !empty( $slides ) && is_array( $slides ) ) { ?>

        <div class="main-slider">
            <div class="main-slider-wrap" data-flickity-options='{
                                                              "cellAlign": "left",
                                                              "wrapAround": false,
                                                              <?php echo $autoplay ? '"autoPlay": ' . $delay*1000 . ',' : ''; ?>
                                                              "prevNextButtons": false,
                                                              "percentPosition": true,
                                                              "imagesLoaded": true,
                                                              "pageDots": true,
                                                              "lazyLoad": 1
                                                          }'>
            <?php foreach ( $slides as $slide ) { ?>

                <?php if( isset( $slide[ 'slide_image' ] ) && !empty( $slide[ 'slide_image' ] ) ) { ?>
                    <?php $slide_image = is_numeric( $slide[ 'slide_image' ] ) ? wp_get_attachment_url( $slide[ 'slide_image' ] ) : $slide[ 'slide_image' ]; ?>
                    <div class="slide">

                        <?php if( isset( $slide[ 'slide_url' ] ) && !empty( $slide[ 'slide_url' ] ) ) { ?>

                        <a href="<?php echo esc_url( $slide[ 'slide_url' ] ); ?>">

                        <?php } //endif; ?>


                            <img class="<?php echo isset( $slide[ 'slide_image_xs' ] ) && !empty( $slide[ 'slide_image_xs' ] ) ? 'd-none d-sm-block' : ''; ?>"
                                 data-flickity-lazyload-src="<?php echo $slide_image ?>"
                                 src="<?php echo $slide_image ?>" />
                            <?php if( isset( $slide[ 'slide_image_xs' ] ) && !empty( $slide[ 'slide_image_xs' ] ) ) { ?>
                                <?php $slide_image_xs = is_numeric( $slide[ 'slide_image_xs' ] ) ? wp_get_attachment_url( $slide[ 'slide_image_xs' ] ) : $slide[ 'slide_image_xs' ]; ?>
                                <img class="<?php echo 'd-block d-sm-none'; ?>"
                                     data-flickity-lazyload-src="<?php echo $slide_image_xs ?>"
                                     src="<?php echo $slide_image_xs ?>" />
                            <?php } //endif; ?>

                        <?php if( isset( $slide[ 'slide_url' ] ) && !empty( $slide[ 'slide_url' ] ) ) { ?>

                        </a>

                        <?php } //endif; ?>

                            <?php if( ( isset( $slide[ 'slide_title' ] ) && !empty( $slide[ 'slide_title' ] ) ||
                                      isset( $slide[ 'slide_text' ] ) && !empty( $slide[ 'slide_text' ] ) )
                                      && isset( $slide[ 'slide_view_type' ] ) && !empty( $slide[ 'slide_view_type' ] ) &&  $slide[ 'slide_view_type' ] == 'default' ) { ?>
                                <div class="caption-wrap" style="background-color: <?php echo $slide[ 'slide_overlay_color' ] ?>;">
                                    <div class="caption">

                                        <?php if( isset( $slide[ 'slide_url' ] ) && !empty( $slide[ 'slide_url' ] ) ) { ?>

                                        <a class="caption-link" href="<?php echo esc_url( $slide[ 'slide_url' ] ); ?>"></a>

                                        <?php } //endif; ?>

                                        <?php if( isset( $slide[ 'slide_title' ] ) && !empty( $slide[ 'slide_title' ] ) ) { ?>
                                            <h2 class="slide-title"
                                                style="color:<?php echo $slide[ 'slide_title_color' ] ?>;<?php if( isset( $slide[ 'slide_title_font_size' ] ) ) { ?>font-size:<?php echo $slide[ 'slide_title_font_size' ] ?>px;<?php } ?>"><?php echo $slide[ 'slide_title' ] ?></h2>
                                        <?php } //endif; ?>

                                        <?php if( isset( $slide[ 'slide_text' ] ) && !empty( $slide[ 'slide_text' ] ) ) { ?>
                                            <div class="slide-text mb-px-15" style="color:<?php echo $slide[ 'slide_text_color' ] ?>;<?php if( isset( $slide[ 'slide_text_font_size' ] ) ) { ?>font-size:<?php echo $slide[ 'slide_text_font_size' ] ?>px;<?php } ?>"><?php echo  $slide[ 'slide_text' ] ?></div>
                                        <?php } //endif; ?>

                                        <div class="slide-buttons">
                                            <?php if( isset( $slide[ 'main_button_text' ] ) && !empty( $slide[ 'main_button_text' ] ) &&
                                                      isset( $slide[ 'main_button_url' ] ) && !empty( $slide[ 'main_button_url' ] )) { ?>
                                            <a href="<?php echo esc_url( $slide[ 'main_button_url' ] ) ?>" class="btn btn-primary">
                                                <?php echo $slide[ 'main_button_text' ] ?>
                                            </a>
                                            <?php } //endif; ?>

                                            <?php if( isset( $slide[ 'additional_button_type' ] ) && !empty( $slide[ 'additional_button_type' ] ) &&
                                                      isset( $slide[ 'additional_button_text' ] ) && !empty( $slide[ 'additional_button_text' ] ) &&
                                                      isset( $slide[ 'additional_button_url' ] ) && !empty( $slide[ 'additional_button_url' ] ) ) { ?>

                                                <?php if( $slide[ 'additional_button_type' ] === 'text' ) { ?>
                                                    <div class="d-block d-sm-none mt-xs-px-10"></div>
                                                    <a class="btn btn-transparent ml-xs-px-0 ml-px-10" href="<?php echo esc_url( $slide[ 'additional_button_url' ] ); ?>">
                                                        <?php echo $slide[ 'additional_button_text' ] ?>
                                                    </a>
                                                <?php } elseif( $slide[ 'additional_button_type' ] === 'video' ) { ?>
                                                    <a class="btn btn-transparent btn-video" data-lity="" href="<?php echo esc_url( $slide[ 'additional_button_url' ] ); ?>">
                                                        <i class="icon-play" aria-hidden="true"></i><span><?php echo $slide[ 'additional_button_text' ] ?></span>
                                                    </a>
                                                <?php } //endif; ?>
                                            <?php } //endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } //endif; ?>



                    </div>
                <?php } //endif; ?>
            <?php } //endforeach; ?>

            </div>
        </div>

    <?php }
}
function adswth_default_clock_time() {
	$now          = strtotime( "now +4 hours 2 minutes" );
	$next_tuesday = strtotime( "next Tuesday +4 hours 2 minutes" );

	$time_dif = $next_tuesday - $now;

	if ( $time_dif <= 0 ) {
		$next_tuesday = $next_tuesday + 604800;    // 1 week = 604800
	}

	$data_end_actions = date( 'Y-m-d', $next_tuesday );

	return $data_end_actions;
}
function adswth_clock_time( $date ){

	$now = strtotime( "now" );
	$custom_date  =  $date . ' 23:59:59';
	$custom_date = strtotime( $custom_date );

	$time_dif = $custom_date - $now;

	if ( $time_dif <= 0 ) {
		return adswth_default_clock_time();
	}

	return $date . ' 23:59:59';
}

function adswth_sanitize_clock_time( $date ){

	$now = strtotime( "now" );
	$custom_date  =  $date . ' 23:59:59';
	$custom_date = strtotime( $custom_date );

	$time_dif = $custom_date - $now;

	if ( $time_dif <= 0 ) {
		return date( 'Y-m-d', $now );
	}

	return $date;
}

function adswth_page_front_products_section( $section = '', $scheme = 'masonry', $count = 8, $volume = false ) {

    $volume = $volume ? $volume : $count;
	$args = [
		'title' => '',
		'ids' => '',
		'products' => $volume,
		'cat' => '',
		'excerpt' => 'visible',
		'offset' => '',
		'orderby' => '', // normal, sales, rand, date
		'order' => '',
		'tags' => '',
		'show' => '', //featured, onsale
		'out_of_stock' => '', // exclude.
	];

	switch ( $section ) {
		case 'top_selling':
			$args['orderby'] = 'sales';
			break;
		case 'onsale':
			$args['show'] = 'onsale';
			$args['orderby'] = 'rand';
			break;
		case 'new_arrivals':
			$args['orderby'] = 'date';
			$args[ 'order' ] = 'DESC';
			break;
		case 'recommended':
			$args['show'] = 'featured';
			break;
		default:

    }

	$products = adswth_list_products( $args );

	$i = 0;
	if ( $products->have_posts() ) { ?>

        <div id="products-front-<?php echo $section; ?>" class="products-front-wrap mt-px-30">
            <div class="block-title-wrap d-flex align-items-center">
                <h3 class="text-uppercase block-title"><?php echo adswth_option( 'products_' . $section . '_title' ); ?></h3>
                <div class="block-title-divider"></div>
            </div>

        <?php do_action( 'adswth_start_loop_top_selling_product' );

		$classes = [ 'product-box-row', 'row', 'no-gutters', 'mt-xs-px-15', 'mt-px-30' ];
		$classes[] = 'product-box-row-' . $scheme;
		$slider = '';
		$css = '';
		if( $scheme == 'line' ) {
		    $count_xl = $count;
		    $count_lg = $count < 4 ? $count : 4;
		    $count_md = $count < 3 ? $count : 3;
		    $count_sm = $count < 2 ? $count : 2;
		    $count_xs = 1;
			$classes[] = 'xl-columns-' . $count_xl;
			$classes[] = 'lg-columns-' . $count_lg;
			$classes[] = 'md-columns-' . $count_md;
			$classes[] = 'sm-columns-' . $count_sm;
			$classes[] = 'xs-columns-' . $count_xs;
			$slider = "data-flickity-options='{ ".
                      '"cellAlign": "left", ' .
                      '"wrapAround": false, ' .
                      '"autoPlay": false, ' .
                      '"prevNextButtons": false, ' .
                      '"percentPosition": true, ' .
                      '"imagesLoaded": true, ' .
                      '"lazyLoad": 1, ' .
                      '"pageDots": true, ' .
                      '"contain": true, ' .
                      '"watchCSS": true,' .
                      '"groupCells": "100%"' .
		              "}'";

			$css.= '<style>' .
                 '#product-box-row-'. $section . ':after{ '.
                    'content: "flickity";' .
				    'display: none;'.
                 '}';
			if( $count_xl >= $volume ){
				$css .= '@media (min-width: 1290px){'.
				        '#product-box-row-'. $section . ':after{ '.
				        'content: "";' .
				        '}'.
                    '}';
            }
            if( $count_lg >= $volume ){
				$css .= '@media (min-width: 992px){'.
				        '#product-box-row-'. $section . ':after{ '.
				        'content: "";' .
				        '}'.
                    '}';
            }
            if( $count_md >= $volume ){
				$css .= '@media (min-width: 768px){'.
				        '#product-box-row-'. $section . ':after{ '.
				        'content: "";' .
				        '}'.
                    '}';
            }
			if( $count_sm >= $volume ){
				$css .= '@media (min-width: 576px){'.
				        '#product-box-row-'. $section . ':after{ '.
				        'content: "";' .
				        '}'.
                    '}';
			}
			if( $count_xs >= $volume ){
				$css .= '#product-box-row-'. $section . ':after{ '.
				        'content: "";' .
                    '}';
			}
			$css .= '</style>';
        }

        echo $css;

        echo '<div id="product-box-row-'. $section .'" class="' . implode( ' ', $classes ) . '" ' . $slider . '>';

        if( $scheme == 'masonry' ) {

	        while ( $products->have_posts() ) {

	            $products->the_post();

		        $i++;

		        if( $i == 1 || $i == 5 ) {

			        echo '<div class="single-item col-xl-3 col-lg-4 col-sm-6">';

			            wc_get_template_part( 'content', 'product' );

			        echo '</div>';
		        } else {

			        if( $i == 2 || $i == 6 ) {

				        $class = ( $i == 6 ) ? 'three-item-last' : '';

				        echo '<div class="three-item ' . $class . ' col-xl-3 col-lg-4 col-sm-6">';
			        }

			        wc_get_template_part( 'content', 'product' );

			        if( $i == 4 || $i == 8 ) {
				        echo '</div>';
			        }
		        }
	        }

	        if( ! in_array( $i, [ 0, 1, 4, 5, 8 ] ) ) echo '</div>';

        } elseif( $scheme == 'line' ){

	        while( $products->have_posts() ) {

		        $products->the_post();

		        echo '<div class="single-item col">';

		        wc_get_template_part( 'content', 'product' );

		        echo '</div>';
	        }
        }
		echo '</div><!-- .row -->';

     echo '</div>';
		do_action( 'adswth_end_loop_top_selling_product' );
    } //endif;

	wp_reset_query();
}

/*
 *  Get Product Lists
 */
function adswth_list_products( $args = [] ){

    global $post, $woocommerce, $product;

	if ( isset( $args ) ) {
		$options = $args;

		$number = 8;
		if ( isset( $options['products'] ) ) {
			$number = $options['products'];
		}

		$show = ''; // featured, onsale.
		if ( isset( $options['show'] ) ) {
			$show = $options['show'];
		}

		$orderby = 'date';
		$order   = 'desc';
		if ( isset( $options['orderby'] ) ) {
			$orderby = $options['orderby'];
		}
		if ( isset( $options['order'] ) ) {
			$order = $options['order'];
		}
		if ( $orderby == 'menu_order' ) {
			$order = 'asc';
		}

		// Get Category.
		$cat = '';
		if ( isset( $options['cat'] ) ) {
			if ( is_numeric( $options['cat'] ) && get_term( $options['cat'] ) ) {
				$cat = get_term( $options['cat'] )->slug;
			} else {
				$cat = $options['cat'];
			}
		}

		$tags = '';
		if ( isset( $options['tags'] ) ) {
			if ( is_numeric( $options['tags'] ) ) {
				$options['tags'] = get_term( $options['tags'] )->slug;
			}
			$tags = $options['tags'];
		}

		$offset = '';
		if ( isset( $options['offset'] ) ) {
			$offset = $options['offset'];
		}
	} else {
		return false;
	}

	$query_args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'product',
		'no_found_rows'       => 1,
		'ignore_sticky_posts' => 1,
		'order'               => $order,
		'product_tag'         => $tags,
		'offset'              => $offset,
		'meta_query'          => WC()->query->get_meta_query(),
		'tax_query'           => WC()->query->get_tax_query(),
	);

	switch ( $show ) {
		case 'featured':
            $query_args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );
			break;
		case 'onsale':
			$query_args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
			break;
	}

	switch ( $orderby ) {
		case 'menu_order':
			$query_args['orderby'] = 'menu_order';
			break;
		case 'title':
			$query_args['orderby'] = 'name';
			break;
		case 'date':
			$query_args['orderby'] = 'date';
			break;
		case 'price':
			$query_args['meta_key'] = '_price'; // @codingStandardsIgnoreLine
			$query_args['orderby']  = 'meta_value_num';
			break;
		case 'rand':
			$query_args['orderby'] = 'rand'; // @codingStandardsIgnoreLine
			break;
		case 'sales':
			$query_args['meta_key'] = 'total_sales'; // @codingStandardsIgnoreLine
			$query_args['orderby']  = 'meta_value_num';
			break;
		default:
			$query_args['orderby'] = 'date';
	}

	if ( ! empty( $cat ) ) {
		$query_args = adswth_maybe_add_category_args( $query_args, $cat, 'IN' );
	}

	if ( isset( $options['out_of_stock'] ) && $options['out_of_stock'] === 'exclude' ) {
		$product_visibility_term_ids = wc_get_product_visibility_term_ids();
		$query_args['tax_query'][]   = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'term_taxonomy_id',
			'terms'    => $product_visibility_term_ids['outofstock'],
			'operator' => 'NOT IN',
		);
	}

	$results = new WP_Query( $query_args );

	return $results;
}

function adswth_maybe_add_category_args( $args, $category, $operator ) {

    if ( ! empty( $category ) ) {

		if ( empty( $args['tax_query'] ) ) {

			$args['tax_query'] = [];
		}

		$args['tax_query'][] = [
			'taxonomy' => 'product_cat',
			'terms'    => array_map( 'sanitize_title', explode( ',', $category ) ),
			'field'    => 'slug',
			'operator' => $operator,
		];
	}

	return $args;
}

function adswth_footer_row_class( $block_title = '' ) {

	$result = '';

	if ( ! empty( $block_title ) ) {
		$count = adswth_option( $block_title . '_columns' );
		$result .=  ( ! empty ( $count ) ) ? 'xl-columns-' . $count : '';
	}

	return $result;
}

function adswth_divider() {
	echo '<div class="divider"></div>';
}
add_action( 'adswth_footer_divider', 'adswth_divider', 10 );

function adswth_move_category_count( $links ) {
	$links_old = [ '</a> <span class="count">', '</span>' ];
	$links_new = [ ' <span class="count">', '</span></a>' ];

	$links = str_replace( $links_old, $links_new, $links );
	return $links;
}
add_filter( 'wp_list_categories', 'adswth_move_category_count' );

function adswth_add_bootstrap_table_class_start( $content ) {
	return str_replace( '<table', '<div class="table-responsive"><table class="table table-bordered"', $content );
}
add_filter( 'the_content', 'adswth_add_bootstrap_table_class_start' );

function adswth_add_bootstrap_table_class_end( $content ) {
	return str_replace( '</table>', '</table></div>', $content );
}
add_filter( 'the_content', 'adswth_add_bootstrap_table_class_end' );

function adswth_get_cart_item_attributes( $item_data ) {

	$result = '';

	if ( !empty( $item_data ) && $item_data->is_type( 'variation' ) ) {

		$attributes = $item_data->get_attributes();

		if( !empty( $attributes ) ) {

			$attr = [];

			foreach ( $attributes as $attribute => $attribute_name ) {

				$term = get_term_by( 'slug', $attribute_name, $attribute );

				if( isset($term->name) )
				    $attr[] = $term->name;

			}

			$result = implode( ' / ', $attr );
		}
	}

	return $result;
}

function adswth_mobile_menu() {
    if ( has_nav_menu('mobile_menu' ) ) {
	?>
	<div id="mobile-menu-sidebar" class="mobile-menu-sidebar">
		<div class="mobile-menu-header d-flex justify-content-between align-items-center">
			<?php get_template_part( 'template-parts/header/partials/element-top', 'currency-switcher' ); ?>
			<?php get_template_part( 'template-parts/header/partials/element-top', 'account' ); ?>
			<button id="mobile-menu-close" class="mobile-menu-close">
				<i class="icon-cancel"></i>
			</button>
		</div>
        <div class="mobile-menu-wrap">
            <ul class="mobile-menu">
		        <?php wp_nav_menu( [
			        'menu'           => __( 'Mobile Menu', 'davinciwoo' ),
			        'theme_location' => 'mobile_menu',
			        'depth'          => 0,
			        'container'      => false,
			        'items_wrap'     => '%3$s',
			        'walker'         => new \adswth\walker\adsMenuDropdown(),
			        'show_count'     => adswth_option( 'menu_product_cat_show_count' ),
		        ] ); ?>
		        <?php do_action( 'adswth_mobile_menu_li' ); ?>
            </ul>
        </div>
        <?php if( is_active_sidebar( 'mobile-menu-sidebar' ) ) { ?>
        <div id="mobile-menu-sidebar-widgets" class="mobile-menu-sidebar-widgets">
            <?php dynamic_sidebar( 'mobile-menu-sidebar' ); ?>
        </div>
        <?php } //endif; ?>
	</div>
    <div id="mobile-menu-overlay"></div>
	<?php
	}
}
add_action( 'wp_footer', 'adswth_mobile_menu' );

function adswth_wp_get_attachment_image_attributes_flickity_lazyload( $attr, $attachment, $size ) {

    if( !adswth_option( 'product_gallery_woocommerce' ) ) {

        if ( isset( $attr['data-flickity-lazyload-srcset'] ) && isset( $attr['srcset'] ) ) {
		    $attr['data-flickity-lazyload-srcset'] = $attr['srcset'];
		    unset( $attr['srcset'] );
	    }

	    if ( isset( $attr['data-flickity-lazyload-src'] ) && isset( $attr['src'] ) ) {
		    $attr['data-flickity-lazyload-src'] = $attr['src'];
		    unset( $attr['src'] );
	    }
    } else {
	    unset( $attr['data-flickity-lazyload-srcset'] );
	    unset( $attr['data-flickity-lazyload-src'] );
    }

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'adswth_wp_get_attachment_image_attributes_flickity_lazyload', 100, 3 );

function adswth_mobile_menu_arrows($item_output, $item, $depth, $args){

    if( $args->theme_location == 'mobile_menu' && $item->hasChildren){
        $item_output .= '<a class="arrow" href="#"><i class="icon-right-open-1"></i></a>';
    }
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'adswth_mobile_menu_arrows', 10, 4 );

function adswth_sticky_header(){
    if( adswth_option( 'header_sticky_show' ) === true ){
       if ( ! wp_script_is( 'jquery', 'done' ) ) {
           wp_enqueue_script( 'jquery' );
       }
       wp_add_inline_script( "jquery", "jQuery(document).ready(function($){
       var CurrentScroll = 180;
      
       $(window).scroll(function(event){

          var NextScroll = $(this).scrollTop();
    
          if (NextScroll > CurrentScroll){
              $('.header').addClass('fixed-header');
          }
          else {
              $('.header').removeClass('fixed-header');
          }

       });
       });" );
    } else{
        return false;
    }
}
add_action( 'wp_enqueue_scripts', 'adswth_sticky_header', 999 );


add_filter('adsw_rewiew_gallery_thumbsize', function( $size ){
    return 'medium';
}, 1);


function adswth_woocommerce_thumbnail_size( $size ) {

    return ( is_adsw_activated() && is_product() ) ? 'shop_thumbnail' : $size;
}
add_filter( 'woocommerce_thumbnail_size', 'adswth_woocommerce_thumbnail_size', 10, 1 );

function adsw_woocommerce_ajax_add_to_cart() {
    $product_id = apply_filters('adsw_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('adsw_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
        do_action('adsw_woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('adsw_woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX :: get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('adsw_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
        echo wp_send_json($data);
    }
    wp_die();
}
add_action('wp_ajax_adsw_woocommerce_ajax_add_to_cart', 'adsw_woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_adsw_woocommerce_ajax_add_to_cart', 'adsw_woocommerce_ajax_add_to_cart');