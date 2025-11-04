<?php

if ( ! function_exists( 'is_blog' ) ) {

    function is_blog() {
        return is_author() || is_category() || is_tag() || is_date() || is_home() || ( is_single()  && 'post' == get_post_type() );
    }

}

if ( ! function_exists( 'is_blog_search' ) ) {

    function is_blog_search() {
        return is_search() && isset( $_GET[ 'post_type' ] ) && $_GET[ 'post_type' ] ==  'post';
    }

}

/**
 * Print categories lists of Blog for mobile and desktop.
 *
 * @param string $list_class Class for list.
 * @param string $active_class Active class for list item.
 * @param boolean $create_mobile_menu Flag for creation of mobile menu.
 * @param string $mobile_list_class Class for mobile menu.
 */

function get_top_blog_category_menu( $list_class = '', $active_class = 'active' ) {

    $queried_object = get_queried_object();
    $post_slug  = '';

    if( is_object( $queried_object ) ) {
        $post_slug  = get_queried_object()->slug;
    }

    $categories = get_categories( [
        'taxonomy' => 'category',
        'orderby'  => 'name',
        'order'    => 'ASC',
        'child_of' => 0,
    ] );

    $mobile_list = '';


    $list_start              = '';
    $list_end                = '';
    $list                    = '';
    $item_active_class       = $active_class;
    $first_item_active_class = $item_active_class;

    foreach( $categories as $category ) {

        if( $category->count > 0 ) {

            $item_class = '';

            if( ($category->slug) == $post_slug ) {
                $item_class = $item_active_class;
                $first_item_active_class = '';
            }

            $list .= sprintf(
                '<a class="%2$s" href="%1$s">%3$s</a>', get_term_link( $category->term_id , 'category' ), $item_class, $category->name
            );
        }
    }

    $first_list_item = '' . sprintf(
            '<a href="%1$s" class="%2$s">%3$s</a>', home_url('blog'), $first_item_active_class, __( 'All Categories', 'davinciwoo' )
        );

    $list = $list_start . $first_list_item . $list . $list_end;
    $list .= $mobile_list;

    echo $list;
}

function adswth_search_post()
{
    $search = esc_attr( $_POST[ 'q' ] );

    $q = new WP_Query(
        [
            'post_type'			=> 'post',
            'post_status'       => 'publish',
            'posts_per_page'	=> 10,
            's'					=> $search
        ]
    );

    $foo = [];

    $posts = $q->get_posts();
    if( $posts ) {
        foreach ($posts as $post){
            $foo[] = [
                'title'=> $post->post_title,
                'url' => get_permalink($post),
                'category' => get_the_category_list( ', ','multiple', $post->ID ),
                'excerpt' => wp_trim_words( $post->post_content, 55, '...' ),
                'date'  => date_i18n( 'M j, Y', strtotime( $post->post_modified ) ),
            ];
        }

    }

    wp_reset_postdata();

    echo json_encode( [ 'posts' => $foo ] );
    die;

}
add_action('wp_ajax_adswth_search_post', 'adswth_search_post');
add_action('wp_ajax_nopriv_adswth_search_post', 'adswth_search_post');

function adswth_blog_loadmore(){

    $args = unserialize( base64_decode(stripslashes( $_POST['query'] ) ) );
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part('blog/template-parts/single', 'cat');
        }
    } else {
        // Постов не найдено
    }

    wp_reset_postdata();

    die();
}

add_action('wp_ajax_blog_loadmore', 'adswth_blog_loadmore');
add_action('wp_ajax_nopriv_blog_loadmore', 'adswth_blog_loadmore');


function adswth_blog_post_thumbnail( $post_id, $size = 'thumbnail' ){

    if( has_post_thumbnail( $post_id) ){
        return get_the_post_thumbnail( $post_id, $size );
    } else {
        return '<img src="' . ADSW_THEME_URL . '/blog/assets/images/noimage.jpg"/>';
    }
}

function adswth_blog_get_template_field( $pagename ) {

    $file = ADSW_THEME_PATH . '/blog/template-parts/defaults_template/' . $pagename . '.php';

    if ( file_exists( $file ) ) {

        ob_start();

        include( $file );
        $text = ob_get_contents();

        ob_end_clean();

        return $text;
    }

    return '';
}

function adswth_blog_subscribe_form(){

    get_template_part('blog/template-parts/partials/subscribe');
}

add_action( 'adswth_after_main', 'adswth_blog_subscribe_form' );

function adswth_get_prev_next(){
    $prevID = get_previous_post(true);
    $nextID = get_next_post(true);
    if (!empty($prevID->ID)) {
        echo sprintf(
            '<div class="blog_item prev_one">
                            <div class="blog_info">
                                <h3><a href="%1$s" class="blog-post-item__title">
                                    %4$s
                                </a></h3>
                                <div class="blog_stats">
                                    <span class="blog_date">%5$s</span>
                                    <div class="blog_tags">
                                        %3$s
                                    </div>
                                </div>
                                <div class="blog_desc">
                                    <p><a href="%1$s">%6$s</a></p>
                                </div>
                                <div class="blog_readmore">
                                    <a href="%1$s"><i class="icon-blog-left"></i> %7$s</a>
                                </div>
                            </div>
                        </div>',
            get_the_permalink($prevID),
            '',//get_the_post_thumbnail($prevID,array(400, 400)),
            get_the_category_list( ', ', 1, $prevID ),
            get_the_title($prevID),
            date_i18n( 'M j, Y', strtotime( $prevID->post_modified ) ),
            wp_trim_words( apply_filters( 'the_content', $prevID->post_content ), 55, '...' ),
            __( 'Previous', 'davinciwoo' )
        );

    }
    if (!empty($nextID->ID)) {
        echo sprintf(
            '<div class="blog_item next_one">
                            <div class="blog_info">
                                <h3><a href="%1$s" class="blog-post-item__title">
                                    %4$s
                                </a></h3>
                                <div class="blog_stats">
                                    <span class="blog_date">%5$s</span>
                                    <div class="blog_tags">
                                        %3$s
                                    </div>
                                </div>
                                <div class="blog_desc">
                                    <p><a href="%1$s">%6$s</a></p>
                                </div>
                                <div class="blog_readmore">
                                    <a href="%1$s">%7$s <i class="icon-blog-right"></i></a>
                                </div>
                            </div>
                        </div>',
            get_the_permalink($nextID),
            '',//get_the_post_thumbnail($nextID,array(400, 400)),
            get_the_category_list( ', ', 1, $nextID ),
            get_the_title($nextID),
            date_i18n( 'M j, Y', strtotime( $nextID->post_modified ) ),
            wp_trim_words( apply_filters( 'the_content', $nextID->post_content ), 55, '...' ),
            __( 'Next', 'davinciwoo' )
        );
    }
};

