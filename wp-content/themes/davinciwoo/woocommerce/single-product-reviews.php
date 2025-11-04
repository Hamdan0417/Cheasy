<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews mt-px-30">
	<div id="comments">
        <div class="block-title-wrap d-flex align-items-center mb-px-25">
            <h3 class="reviews-title text-uppercase block-title"><?php _e( 'Real customer reviews', 'davinciwoo' ); ?></h3>
            <div class="block-title-divider"></div>
        </div>

		<?php if ( have_comments() ) : ?>
            <?php
			$rating_count  = $product->get_rating_count();
			$review_count  = $product->get_review_count();
			$rating_counts = $product->get_rating_counts();
			$average       = $product->get_average_rating();
			$total_sales   = $product->get_total_sales();

			$enjoyed_5 = isset( $rating_counts[5] ) ? intval( $rating_counts[5] ) : 0;
			$enjoyed_4 = isset( $rating_counts[4] ) ? intval( $rating_counts[4] ) : 0;

			$enjoyed   = ( intval( $rating_count ) > 0 ) ? round( ( $enjoyed_4 + $enjoyed_5 ) / $rating_count * 100, 1 ) : false;
            ?>
            <div class="product-raiting-count">
                <div class="row justify-content-around align-items-center">
                    <div class="col-xl-5 col-md-6">
                        <div class="woocommerce-product-rating">
                            <div class="stars-block">
                                <?php echo wc_get_rating_html( $average, $rating_count ); ?>
                            </div>
                            <div class="review-count">
	                            <?php printf( _n( '%s review', '%s reviews', $review_count, 'davinciwoo' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>
                            </div>
                            <?php if( $enjoyed ) { ?>
                            <div class="review-enjoyed"><?php echo '<span>' . $enjoyed . '%</span>&nbsp;' .__( 'of buyers enjoyed this product!', 'davinciwoo' ); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-6">
                        <div class="rating-status">
                        <?php
                            for( $i = 5; $i > 0; $i--) { ?>
                                <div class="rating-status-row d-flex">
                                    <div class="review-status-label"><?php printf( _n( '%s star', '%s stars', $i, 'davinciwoo' ),  $i ); ?></div>
                                    <div class="review-status-percent">
                                    <?php
                                        if( isset( $rating_counts[ $i ] ) &&  intval( $rating_counts[ $i ] ) > 0 ) {
	                                        $percent = round( intval( $rating_counts[ $i ] ) / $rating_count * 100, 2 );
	                                        $count = intval( $rating_counts[ $i ] );
                                        }else{
                                            $percent = 0;
	                                        $count = 0;
                                        }
                                    ?>
                                        <span style="width:<?php echo $percent; ?>%;"></span>
                                    </div>
                                    <div class="review-status-count">( <?php echo $count; ?> )</div>
                                </div>
                            <?php }
                        ?>
                        </div>
                    </div>
                </div>
            </div>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '<i class="icon-left-open"></i>',
					'next_text' => '<i class="icon-right-open"></i>',
					'type'      => 'list',
					'end_size'  => 1,
					'mid_size'  => 3,
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<div class="woocommerce-noreviews mb-px-25"><?php _e( 'There are no reviews yet.', 'davinciwoo' ); ?></div>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper" class="review-form-wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = [
						'title_reply'          => have_comments() ? __( 'Write a review', 'davinciwoo' ) : __( 'Write a review', 'davinciwoo' ),
						'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
						'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
						'title_reply_after'    => '</span>',
                        'comment_notes_before' => '',
						'comment_notes_after'  => '',
                        'class_form'           => 'comment-form nicelabel',
						'fields'               => [
							'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label> ' .
										'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
							'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label> ' .
										'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
						],
						'logged_in_as'  => '',
						'comment_field' => '',
						'class_submit'  => 'btn btn-secondary',
                        'id_submit'     => 'submit-review',
						'label_submit'  => __( 'Submit a Review', 'davinciwoo' ),
                        'submit_field'  => '<div class="form-submit">%1$s %2$s</div>'
					];

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'woocommerce' ), esc_url( $account_page_url ) ) . '</p>';
					}

				    $comment_form['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea><label for="comment">' . esc_html__( 'Your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label></p>';

					if ( wc_review_ratings_enabled() ) {
						$comment_form['comment_field'] .= '<div class="comment-form-rating"><select name="rating" id="rating" aria-required="true" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
						</select></div>';
					}

					if( adswth_option( 'product_page_reviews_terms_conditions_show' ) ){
						$comment_form['comment_field'] .= '<div class="comment-form-conditions form-group"><label class="checkbox is-not-empty" for="terms">
                                                                <input name="terms" value="0" type="hidden">
                                                                <input class="in-conditions-review" id="terms" name="terms" type="checkbox" value="1">
                                                                <span>'. adswth_option( 'product_page_reviews_terms_conditions_text' ) . '</span>
                                                            </label></div>';
                    }

                    ob_start();
                    comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                    $form = ob_get_contents();ob_end_clean();
                    echo str_replace('<form','<form enctype="multipart/form-data"',$form);
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
