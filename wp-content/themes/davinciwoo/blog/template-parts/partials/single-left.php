<div class="articleL">
    <div class="blog_article">
        <h1><?php the_title(); ?></h1>
        <div class="article_info">
            <div class="article_stats">
                <div class="article_by">
                    <?php _e( 'by', 'davinciwoo' ) ?>
                    <?php echo get_the_author() ?>
                </div>
                <div class="article_date_tags">
                    <span class="blog_date"><?php echo date_i18n( 'M j, Y', strtotime( get_the_date() ) ); ?></span>
                    <div class="blog_tags">
                        <?php echo get_the_category_list( ', ', 1 ); ?>
                    </div>
                </div>
            </div>
            <div class="article_socs">
                <div class="sharePopup"><div class="share-btn"></div></div>
            </div>
        </div>

        <div class="article_content clearfix">
            <?php the_content(); ?>
        </div>

    </div>

    <div class="article_prev_next">
        <?php adswth_get_prev_next(); ?>
    </div>

    <?php if( ( comments_open() || get_comments_number() ) ) { comments_template(); } ?>

</div>