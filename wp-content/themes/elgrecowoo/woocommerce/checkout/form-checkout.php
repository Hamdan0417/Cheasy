<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trust_image = adswth_option( 'checkout_trust_box_image' );
$trust_title = adswth_option( 'checkout_trust_box_title' );
$trust_text = adswth_option( 'checkout_trust_box_description' );
$countdown_timer_text = adswth_option( 'checkout_countdown_timer_title' );
$countdown_minutes = adswth_option( 'checkout_countdown_timer_minutes' ) ? adswth_option( 'checkout_countdown_timer_minutes' ) : 15;
?>
<?php if(adswth_option( 'checkout_trust_box_show' ) && !empty($trust_image)){ ?>
    <div class="trust-box my-px-20 px-px-15 d-lg-none text-center">
        <img src="<?php echo $trust_image; ?>" alt="trust-box" />
    </div>
<?php } ?>
<?php if(adswth_option( 'checkout_countdown_timer_banner_show' )){ ?>
    <div class="checkout-countdown mb-px-20 d-lg-none">
        <div class="checkout-countdown-inner text-center">
            <?php if(!empty($countdown_timer_text)){ ?>
                <?php echo $countdown_timer_text; ?>
            <?php } ?>

            <?php if(adswth_option( 'checkout_countdown_timer_show' )){ ?>
                <span class="checkout-countdown-timer" data-minutes="<?php echo $countdown_minutes; ?>"><?php echo $countdown_minutes; ?></span> <?php _e( 'minutes', 'elgrecowoo' ) ?>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout mt-px-20" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <div class="row">
	<?php if ( $checkout->get_checkout_fields() ) : ?>
        <div class="col-lg-7">

            <?php if(adswth_option( 'checkout_countdown_timer_banner_show' )){ ?>
                <div class="checkout-countdown mb-px-20 d-none d-lg-block">
                    <div class="checkout-countdown-inner text-center">
                        <?php if(!empty($countdown_timer_text)){ ?>
                            <?php echo $countdown_timer_text; ?>
                        <?php } ?>

                        <?php if(adswth_option( 'checkout_countdown_timer_show' )){ ?>
                            <span class="checkout-countdown-timer" data-minutes="<?php echo $countdown_minutes; ?>"><?php echo $countdown_minutes; ?></span> <?php _e( 'minutes', 'elgrecowoo' ) ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

            <div class="row" id="customer_details">
                <div class="col-lg-12">
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                </div>

                <div class="col-lg-12">
                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                </div>
            </div>

            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <?php if(adswth_option( 'checkout_trust_box_show' )){ ?>
                <div class="trust-box mt-px-40 px-px-20 py-px-20 d-none d-lg-block">
                    <?php if(!empty($trust_title)){ ?>
                        <h4><?php echo $trust_title; ?></h4>
                    <?php } ?>
                    <?php if(!empty($trust_text)){ ?>
                        <p><?php echo $trust_text; ?></p>
                    <?php } ?>
                    <?php if(!empty($trust_image)){ ?>
                        <div class="text-center">
                            <img src="<?php echo $trust_image; ?>" alt="trust-box" />
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

	<?php endif; ?>
        <div class="col-lg-5">
            <div class="bg-white px-xl-px-15 py-px-15">
                <h3 id="order_review_heading" class="text-uppercase"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </div>
            <?php if(adswth_option( 'checkout_why_buy_show' )){ ?>
                <?php
                    $reason_title = adswth_option( 'checkout_why_buy_title' );
                    $reasons = adswth_option( 'checkout_why_buy_list' );
                ?>
                <div class="checkout-reason-box px-xl-px-15 mt-xl-px-40">
                    <?php if(!empty($reason_title)){ ?>
                        <h2 class="mb-px-20"><?php echo $reason_title; ?></h2>
                    <?php } ?>
                    <?php if(!empty($reasons)){ ?>
                        <div class="checkout-reasons">
                            <?php foreach($reasons as $reason): ?>
                                <div class="checkout-reason mb-px-20 d-flex">
                                    <?php if(!empty($reason['checkout_reason_image'])){ ?>
                                        <?php $reason_image = is_numeric( $reason[ 'checkout_reason_image' ] ) ? wp_get_attachment_url( $reason[ 'checkout_reason_image' ] ) : $reason[ 'checkout_reason_image' ]; ?>
                                        <div class="checkout-reason-img">
                                            <img src="<?php echo $reason_image; ?>" alt="<?php echo $reason['checkout_reason_title']; ?>" />
                                        </div>
                                    <?php } ?>
                                    <?php if(!empty($reason['checkout_reason_title']) || !empty($reason['checkout_reason_text'])): ?>
                                        <div class="checkout-reason-text">
                                            <?php if(!empty($reason['checkout_reason_title'])){ ?>
                                                <h5><?php echo $reason['checkout_reason_title']; ?></h5>
                                            <?php } ?>
                                            <?php if(!empty($reason['checkout_reason_text'])){ ?>
                                                <p><?php echo $reason['checkout_reason_text']; ?></p>
                                            <?php } ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
