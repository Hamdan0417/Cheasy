<?php

function adswth_option( $option ) {
	// Get options
	return get_theme_mod( $option, adswth_defaults( $option ) );
}

function adswth_get_template_field( $pagename ) {

	$file = ADSW_THEME_PATH . '/template-parts/defaults_template/' . $pagename . '.php';

	if ( file_exists( $file ) ) {

		ob_start();

		include( $file );
		$text = ob_get_contents();

		ob_end_clean();

		return $text;
	}

	return '';
}

function adswth_get_site_domain() {

	$site_url = get_site_url();

	$find_h = '#^http(s)?://#';
	$find_w = '/^www\./';

	$domain = preg_replace( $find_h, '', $site_url );
	$domain = preg_replace( $find_w, '', $domain );

	return $domain;
}

function adswth_get_icon( $name = '' ){

	if( $name != '' )
		return '<i class="icon-' . $name . '"></i>';
}

function adswth_get_template_color() {

	$accent_color = adswth_option( 'template_color' );

	if( ! $accent_color ) {
		$accent_color = '#3C5460';
	}

	return $accent_color;
}

add_shortcode( 'get-icon', function( $attr ) {

	$args = shortcode_atts( [
		'icon' => 0,
		'color' => adswth_get_template_color(),
	], $attr );

	return adswth_get_svg_icon( $args[ 'icon' ], $args[ 'color' ] );
} );

function adswth_get_svg_icon( $name, $color ) {

	$file = ADSW_THEME_PATH . '/assets/images/svg-icons/' . $name . '.svg';

	if ( file_exists( $file ) ) {

		ob_start();

		include( $file );
		$text = ob_get_contents();

		ob_end_clean();

		return $text;
	}

	return '';
}

function adswth_favicon(){
    if (has_site_icon() == false)
        echo '<link rel="icon" href="' . ADSW_THEME_URL . '/assets/images/favicon.png" />';
}
add_action('wp_head', 'adswth_favicon');

//common structure data
function adswth_common_structure_data(){
    $logo_option = adswth_option('site_logo');
    $logo = is_array($logo_option) ? $logo_option['url'] : $logo_option;
    $home_url = home_url();
    $admin_email = get_bloginfo( 'admin_email' );
    $str_data = [
        '@context' => "https://schema.org/",
        "@type" => "Organization",
        "name"=> $_SERVER['SERVER_NAME'],
        "url"=> $home_url,
        "logo"=> $logo,
        "contactPoint"=> [
            "@type"=> "ContactPoint",
            "contactType"=> "customer support",
            "email"=> $admin_email,
            "url"=> $home_url,
        ],
        "sameAs"=> [],
    ];

    $str_search = [
        '@context' => "https://schema.org/",
        "@type" => "WebSite",
        "url"=> $home_url,
        "potentialAction"=> [
            "@type"=> "SearchAction",
            "target"=> $home_url."/?post_type=product&s={s}",
            "query-input"=> 'required name=s',
        ],
    ];

?>
    <script type="application/ld+json">
        <?php echo json_encode($str_data); ?>
    </script>

    <script type="application/ld+json">
        <?php echo json_encode($str_search); ?>
    </script>
<?php
}

add_action( 'adswth_before_header', 'adswth_common_structure_data');


//product lists structure data
function adswth_product_structure_data(){

        global $product;

        $shop_url = home_url();
        $currency = get_woocommerce_currency();
        $permalink = get_permalink($product->get_id());
        $image = wp_get_attachment_url($product->get_image_id());
        $priceValidUntil = date('Y-m-d',
            strToTime('today + 30 days')
        );

        $aggregate_rating = "";
        if ($product->get_rating_count() && wc_review_ratings_enabled()) {
            $aggregate_rating = "<div style='display:none;' itemprop='aggregateRating' itemscope itemtype='https://schema.org/AggregateRating'><span itemprop='ratingValue'>" . $product->get_average_rating() . "</span><span itemprop='reviewCount'>" . $product->get_review_count() . "</span></div>";;
        }

        echo "<div class='d-none'  itemscope itemtype='https://schema.org/Product'>";
        echo "<meta itemprop='name' content='" . $product->get_name() . "'/>";
        echo "<meta itemprop='mpn' content='" . $product->get_id() . "'/>";
        echo "<meta itemprop='sku' content='" . ($product->get_sku() ? $product->get_sku() : $product->get_id()) . "'/>";
        echo "<meta itemprop='brand' content='" . $shop_url . "'/>";
        echo "<meta itemprop='image' content='" . $image . "'/>";
        echo $aggregate_rating;
        echo "<meta itemprop='description' content='" . wp_strip_all_tags(do_shortcode($product->get_short_description() ? $product->get_short_description() : "")) . "'/>";
        echo "<div class='d-none' itemprop='offers' itemscope itemtype='https://schema.org/Offer'>";
        echo "<meta itemprop='price' content='" . $product->get_price() . "'/>";
        echo "<meta itemprop='priceCurrency' content='" . $currency . "'/>";
        echo "<meta itemprop='url' content='" . $permalink . "'/>";
        echo "<meta itemprop='priceValidUntil' content='" . $priceValidUntil . "'/>";
        echo "<meta itemprop='availability' content='https://schema.org/" . ($product->is_in_stock() ? 'InStock' : 'OutOfStock') . "'/>";
        echo "</div>";
        echo "</div>";
}

add_action('woocommerce_after_shop_loop_item', 'adswth_product_structure_data');


//single product structure data
function adswth_single_product_structure_data( $markup, $product ){
    $markup['mpn'] = $product->get_id();
    $markup['brand'] = $_SERVER['SERVER_NAME'];
    return $markup;

}
add_filter( 'woocommerce_structured_data_product', 'adswth_single_product_structure_data', 10, 2 );

if ( ! function_exists( 'adswth_get_page_by_title' ) ) {
	function adswth_get_page_by_title($page_title, $output = OBJECT, $post_type = 'page')
	{

		global $wpdb;

		if (is_array($post_type)) {
			$post_type = esc_sql($post_type);
			$post_type_in_string = "'" . implode("','", $post_type) . "'";
			$sql = $wpdb->prepare(
				"
            SELECT ID
            FROM $wpdb->posts
            WHERE post_title = %s
            AND post_type IN ($post_type_in_string)
        ",
				$page_title
			);
		} else {
			$sql = $wpdb->prepare(
				"
            SELECT ID
            FROM $wpdb->posts
            WHERE post_title = %s
            AND post_type = %s
        ",
				$page_title,
				$post_type
			);
		}

		$page = $wpdb->get_var($sql);

		if ($page) {
			return get_post($page, $output);
		}

		return null;
	}
}