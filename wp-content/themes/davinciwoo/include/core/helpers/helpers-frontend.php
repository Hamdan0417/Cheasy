<?php
/**
 * User: Denis Zharov
 * Date: 24.09.2018
 * Time: 12:10
 */

function adswth_minify_css($css){
	//$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
	$css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
	return $css;
}

function adswth_search_product_template()
{
	ob_start();
	?>
    <script id="wrap-search-product" type="text/html">
	<div class="wrap-search-product">
		{{#if categories}}
		<div class="categories">
			<div class="head"><?php _e('Categories', 'davinciwoo');?></div>
			<div class="list">
				{{#each categories}}
				<div class=""><a href="{{url}}"><div class="title">{{{title}}}</div></a></div>
				{{/each}}
			</div>
		</div>
		{{/if}}

		{{#if products}}
		<div class="products">
			<div class="head"><a href="<?php echo home_url();?>?post_type=product&s={{q}}"><?php _e('Top matching products', 'davinciwoo');?></a></div>
			<div class="list">
				{{#each products}}
				<a href="{{url}}">
					<div class="item">
						<div class="box-img"><img src="{{img}}" alt=""></div>
						<div class="box-title">
							<div class="title">{{{title}}}</div>
							<div class="price">{{{price}}}</div>
						</div>
					</div>
				</a>
				{{/each}}
			</div>
		</div>
		{{/if}}

		{{#if countShow}}
		<div class="view-all"><a href="<?php echo home_url();?>?post_type=product&s={{q}}"><?php _e('View all', 'davinciwoo');?><span>({{count}})</span></a></div>
		{{/if}}
	</div>
    </script>
	<?php
	$template = ob_get_clean();
	return $template;
}

//add_action('wp_ajax_adswth_search_product_template', 'adswth_search_product_template');
//add_action('wp_ajax_nopriv_adswth_search_product_template', 'adswth_search_product_template');

add_action('wp_footer', function(){
    echo adswth_search_product_template();
} );

function adswth_search_product()
{
	$search = trim( esc_attr( $_POST['q'] ) );

	$q = new WP_Query(
		array(
			'post_type'			=> 'product',
			'post_status'       => 'publish',
			'posts_per_page'	=> 6,
			's'					=> $search
		)
	);

	$products = [];
	$categories = [];
	$count = $q->found_posts;

	$posts = $q->get_posts();

	if( $posts ) {
		foreach ( $posts as $post ){

			$_product = wc_get_product( $post->ID );

			$products[] = array(
				'title' => adswth_selectSearchWord($search, $post->post_title),
				'url'   => get_permalink($post),
				'img'   => adswth_search_ImageUrl( $post ),
				'price' => $_product->get_price_html()
			);
		}

	}

	wp_reset_postdata();

	$args = [
		'taxonomy' => 'product_cat',
		'name__like' => $search,
		'number' => 5,
		'hide_empty' => false,
	];
	$terms = get_terms( $args );

	if( $terms ) {
		foreach ($terms as $term){
			$categories[] = [
				'title'=> adswth_selectSearchWord( $search, $term->name ),
				'url' => get_term_link( $term->term_id, 'product_cat' ),
			];
		}

	}

	echo json_encode( [
		'categories'=> $categories,
		'products'=> $products,
		'count'=> $count,
		'countShow'=> $count > 6,
	] );

	die;
}
add_action('wp_ajax_adswth_search_product', 'adswth_search_product');
add_action('wp_ajax_nopriv_adswth_search_product', 'adswth_search_product');

function adswth_selectSearchWord($search, $text){

	foreach (explode(' ', $search) as $v){
		$text = preg_replace('/('.$v.')/uUi', '<span class="search-query">$1</span>', $text);
	}

	return $text;
}

function adswth_search_ImageUrl( $post ) {

	$post_id = $post->ID;

	if ( has_post_thumbnail( $post_id ) ) {
		$thumb_id = get_post_thumbnail_id( $post_id );
		$url      = wp_get_attachment_image_src( $thumb_id, 'thumbnail' );

		return $url[ 0 ];
	}

	return $post->imageUrl;
}