<?php

$cats = get_the_category();

$the_query = new WP_Query( [
    'post_type'      => 'post',
    'post__not_in'   => [ get_the_ID() ],
    'posts_per_page' => 3,
    'cat'            => $cats[0]->term_id
] );

if ( $the_query->have_posts() ) : ?>
    <div class="related_posts">
        <h5 class="hugeH5"><?php echo adswth_option( 'blog_further_reading_heading' )?></h5>
        <div class="common_news product-slider further-reading" data-flickity-options='{
                                                                          "cellAlign": "left",
                                                                          "wrapAround": false,
                                                                          "autoPlay": false,
                                                                          "prevNextButtons": false,
                                                                          "percentPosition": true,
                                                                          "imagesLoaded": true,
                                                                          "lazyLoad": 1,
                                                                          "pageDots": true,
                                                                          "contain": true,
                                                                          "groupCells": "100%",
                                                                          "watchCSS": true,
                                                                          "adaptiveHeight": true
                                                                      }'>
            <?php while ( $the_query->have_posts() ) { ?>

                <?php $the_query->the_post(); ?>
                <div class="blog_item">
                    <div class="blog_img">
                        <a href="<?php echo get_the_permalink(); ?>"><?php
                            echo adswth_blog_post_thumbnail( get_the_ID(), 'medium_large' );
                            ?></a>
                    </div>
                    <div class="blog_info">
                        <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <div class="blog_stats">
                            <span class="blog_date"><?php echo date_i18n( 'M j, Y', strtotime( get_the_date() ) );?></span>
                            <div class="blog_tags">
                                <?php echo get_the_category_list( ', ', 1 ); ?>
                            </div>
                        </div>
                        <div class="blog_desc">
                            <p><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_excerpt()?></a></p>
                        </div>
                        <div class="blog_readmore">
                            <a href="<?php echo get_the_permalink(); ?>"><?php _e( 'Read More', 'davincwoo' ) ?></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php wp_reset_postdata(); ?>
        </div>

    </div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

