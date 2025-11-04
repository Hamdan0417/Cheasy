<?php
/**
 * Wishlist header
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 3.0.0
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
$is_custom_list = false;
?>

<?php do_action( 'yith_wcwl_before_wishlist_form', $wishlist ); ?>

<form id="yith-wcwl-form" action="<?php echo $form_action ?>" method="post" class="woocommerce yith-wcwl-form wishlist-fragment" data-fragment-options="<?php echo esc_attr( json_encode( $fragment_options ) )?>">

	<!-- TITLE -->
	<?php
	do_action( 'yith_wcwl_before_wishlist_title', $wishlist );

	if( ! empty( $page_title ) ) :
		?>
		<div class="wishlist-title <?php echo ( $is_custom_list ) ? 'wishlist-title-with-form' : ''?>">
			<?php echo apply_filters( 'yith_wcwl_wishlist_title', '<h2>' . $page_title . '</h2>' ); ?>
			<?php if( $is_custom_list ): ?>
				<a class="btn button show-title-form">
					<?php echo apply_filters( 'yith_wcwl_edit_title_icon', '<i class="fa fa-pencil"></i>' )?>
					<?php _e( 'Edit title', 'yith-woocommerce-wishlist' ) ?>
				</a>
			<?php endif; ?>
		</div>
		<?php if( $is_custom_list ): ?>
            <div class="hidden-title-form">
                <input type="text" value="<?php echo $page_title ?>" name="wishlist_name"/>
                <input type="submit" name="save_title" value="<?php _e( 'Save', 'yith-woocommerce-wishlist' )?>" />
                <a class="hide-title-form btn button">
                    <?php echo apply_filters( 'yith_wcwl_cancel_wishlist_title_icon', '<i class="fa fa-remove"></i>' )?>
                    <?php _e( 'Cancel', 'yith-woocommerce-wishlist' )?>
                </a>
            </div>
        <?php endif; ?>
	<?php
	endif;

	do_action( 'yith_wcwl_before_wishlist', $wishlist);
	?>
