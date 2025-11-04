<?php
if(!function_exists('theme_list_comment')){
    function theme_list_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; ?>

        <div <?php comment_class('comment-item'); ?> id="comment-<?php comment_ID(); ?>">
            <?php
            if ($comment->user_id > 0) {
                $user = get_userdata($comment->user_id);
                $username = (!empty($user->first_name) || !empty($user->last_name)) ? $user->first_name . " " . $user->last_name : $user->display_name;
            } else {
                $username = $comment->comment_author;
            }
            ?>
            <div class="comment-author">
                <i class="fa fa-user margin-right"></i>
                <?php printf('<span class="comment-author-name">%s</span>', $username); ?>
                <?php printf('<span class="comment-date" data-now="%1$s"></span>', get_comment_date()) ?>
            </div>

            <div class="comment-text">

                <?php if ($comment->comment_approved == '0') : ?>
                    <div class="alert alert-info margin-bottom"><?php _e('Your comment is awaiting moderation.', 'davinciwoo');?></div>
                <?php endif; ?>

                <?php comment_text(); ?>
            </div>

            <div class="comment-meta">

                <?php if ( comments_open() AND ( get_option( 'thread_comments' ) == 1 ) AND ( $depth != $args['max_depth'] ) ) : ?>
                    <?php comment_reply_link( array_merge( $args, [ 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ] ) ) ?>
                <?php endif; ?>

                <?php edit_comment_link( __( 'Edit', 'davinciwoo' ), '  ', '') ?>

            </div>


        </div>

        <?php
    }

    function theme_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        ?>
        <div class="comm_one" id="comment-<?php comment_ID(); ?>">
            <div class="comm_head">
                <div class="comm_who"><?php echo get_comment_author_link();?></div>
                <div class="comm_date"><?php echo get_comment_date('F j, Y');?></div>
            </div>
            <div class="comm_body">
                <?php if ($comment->comment_approved == '0') : ?>
                    <div class="alert alert-info margin-bottom"><?php _e('Your comment is awaiting moderation.', 'davinciwoo');?></div>
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
            <span class="comm_reply"><?php comment_reply_link( array_merge( $args, [ 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ] ) ); ?></span>
            <?php edit_comment_link(__('Edit', 'davinciwoo'), '  ', '') ?>
        </div>
        <?php
    }


    add_filter('comment_form_default_fields', function($fields) {
        unset($fields['url']);
        return $fields;
    });


//output comments
    function theme_show_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;

        ?>
        <div class="text" id="comment-<?php comment_ID(); ?>">
            <?php comment_text(); ?>
            <div class="author"><?php comment_author(); ?></div>
        </div>
        <?php
    }


    function custom_comment_form( $args = [], $post_id = null ) {
        if ( null === $post_id ) {
            $post_id = get_the_ID();
        }

        $commenter = wp_get_current_commenter();
        $user = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';

        $args = wp_parse_args( $args );

        $fields   =  [
            'author' => '
            <div class="form-group">
                <input type="text" id="author_comm" class="form-control" name="author" required  value="' . esc_attr( $commenter['comment_author'] ) . '">
                <label for="author_comm">* '. __('Name','davinciwoo') . '</label>
            </div>',

            'email' => '
            <div class="form-group">
                <input type="email" id="email_comm" class="form-control" name="email" required  value="' . esc_attr(  $commenter['comment_author_email'] ) . '">
                <label for="email_comm">* '. __('Email', 'davinciwoo') .'</label>
            </div>',

            'url' => '',
        ];

        /**
         * Filter the default comment form fields.
         *
         * @since 3.0.0
         *
         * @param array $fields The default comment fields.
         */
        $fields = apply_filters('comment_form_default_fields', $fields);
        $defaults = [
            'fields'               => $fields,

            'comment_field'        => '
        <div class="form-group">
            <textarea id="textarea_comm" rows="5" class="form-control" name="comment" required></textarea>
            <label for="textarea_comm">* '. __('Comment', 'davinciwoo') .'</label>
        </div>',

            /** This filter is documented in wp-includes/link-template.php */
            'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'davinciwoo' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',

            /** This filter is documented in wp-includes/link-template.php */
            'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'davinciwoo' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            'id_form'              => 'commentform',
            'id_submit'            => 'submit',
            'class_submit'         => 'submit btn btn-lg btn-default',
            'name_submit'          => 'submit',
            'title_reply'          => __('Leave a comment', 'davinciwoo'),
            'title_reply_to'       => __('Leave a reply to', 'davinciwoo') . ' %s',
            'cancel_reply_link'    => __('Cancel reply', 'davinciwoo'),
            'label_submit'         => __('Post Сomment', 'davinciwoo'),
            'format'               => 'xhtml',
        ];

        /**
         * Filter the comment form default arguments.
         *
         * Use 'comment_form_default_fields' to filter the comment fields.
         *
         * @since 3.0.0
         *
         * @param array $defaults The default comment form arguments.
         */
        $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

        ?>
        <?php if ( comments_open( $post_id ) ) : ?>

            <?php do_action( 'comment_form_before' ); ?>

            <div class="comm_form comment-respond" id="respond">
                <h5 class="bigH5"><?php comment_form_title($args['title_reply'], $args['title_reply_to']); ?></h5>
                <div class="comment-meta">
                    <?php cancel_comment_reply_link($args['cancel_reply_link']); ?>
                </div>


                <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>

                    <?php echo $args['must_log_in']; ?>

                    <?php do_action( 'comment_form_must_log_in_after' ); ?>

                <?php else : ?>

                    <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="nicelabel comment-form form-comment" data-toggle="validator" role="form">

                        <?php

                        do_action('comment_form_top');

                        if ( is_user_logged_in() ) :

                            echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );

                            do_action( 'comment_form_logged_in_after', $commenter, $user_identity );

                        else :

                            echo $args['comment_notes_before'];

                            do_action( 'comment_form_before_fields' );

                            foreach ((array)$args['fields'] as $name => $field) {
                                echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                            }

                            do_action( 'comment_form_after_fields' );

                            echo $args['comment_notes_after'];

                        endif;

                        echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );

                        ?>

                        <div class="form-group submit_cont">
                            <button type="submit" class="btn btn-secondary"><?php echo esc_attr( $args['label_submit'] ); ?></button>
                        </div>
                        <div class="list-file"></div>
                        <?php comment_id_fields( $post_id );
                        do_action( 'comment_form', $post_id );
                        ?>
                    </form>

                <?php endif; ?>

            </div><!-- #respond -->

            <?php
            /**
             * Fires after the comment form.
             *
             * @since 3.0.0
             */
            do_action( 'comment_form_after' );
        else :
            /**
             * Fires after the comment form if comments are closed.
             *
             * @since 3.0.0
             */
            do_action( 'comment_form_comments_closed' );
        endif;
    }


    if (post_password_required()) {
        return;
    }

    ?>

    <div class="comm_cont">

        <?php if (have_comments()) : ?>

            <h5 class="bigH5"><?php _e( 'Comments', 'davinciwoo' ) ?> <span>(<?php echo get_comments_number(); ?>)</span></h5>

            <div class="comm_list">
                <?php wp_list_comments('callback=theme_comment'); ?>
            </div>

        <?php endif; // have_comments() ?>

        <?php custom_comment_form(); ?>

    </div><!-- #comments.comments -->
<?php }

