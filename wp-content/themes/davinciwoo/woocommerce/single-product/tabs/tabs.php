<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

    <?php if( adswth_option( 'product_page_share_show' ) ) { ?>
        <div class="col adshwth-share-mob d-flex justify-content-center d-sm-none">
            <div class="sharePopup"><div class="share-btn"></div></div>
        </div>
    <?php } //endif; ?>

	<div class="tabs wrapper">
		<ul class="nav nav-tabs d-none d-sm-flex" role="tablist">
            <?php $count = 0; ?>
            <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
                <?php $class = $count == 0 ? 'active' : ''; ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" >
					<a data-toggle="tab" href="#tab-<?php echo esc_attr( $key ); ?>" class="<?php echo $class; ?>">
                        <?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
                    </a>
				</li>
				<?php $count++; ?>
			<?php endforeach; ?>
		</ul>
        <div class="tab-content">
            <?php $count = 0; ?>
            <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
	            <?php $class = $count == 0 ? 'entry-content tab-pane fade active show' : 'entry-content tab-pane fade'; ?>
                <div class="<?php echo $class; ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="<?php echo $count == 0 ? '' : 'collapsed'; ?>" data-toggle="collapse" data-parent=".tab-pane" href="#acc-<?php echo esc_attr( $key ); ?>" aria-expanded="<?php echo $count == 0 ? 'true' : 'false'; ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key ); ?></a>
                            </h4>
                        </div>
                        <div id="acc-<?php echo esc_attr( $key ); ?>" class="panel-collapse collapse <?php echo $count == 0 ? 'show' : ''; ?>" style="">
                            <div class="panel-body clearfix">
                                <?php
                                if ( isset( $product_tab['callback'] ) ) {
                                    call_user_func( $product_tab['callback'], $key, $product_tab );
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
	            <?php $count++; ?>
            <?php endforeach; ?>
        </div>

        <?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
