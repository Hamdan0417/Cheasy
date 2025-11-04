<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WC_Gateway_Thirdweb extends WC_Payment_Gateway {

    public function __construct() {
        $this->id                 = 'thirdweb_crypto';
        $this->method_title       = __( 'Crypto (thirdweb)', 'thirdweb-woo' );
        $this->method_description = __( 'Accept cryptocurrency payments through thirdweb Checkout.', 'thirdweb-woo' );
        $this->has_fields         = true;
        $this->supports           = [ 'products' ];

        $this->init_form_fields();
        $this->init_settings();

        $this->title        = $this->get_option( 'title' );
        $this->description  = $this->get_option( 'description' );
        $this->enabled      = $this->get_option( 'enabled' );
        $this->instructions = $this->get_option( 'instructions' );

        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options' ] );
        add_action( 'woocommerce_thankyou_' . $this->id, [ $this, 'thankyou_page' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    public function init_form_fields() {
        $this->form_fields = [
            'enabled' => [
                'title'   => __( 'Enable/Disable', 'thirdweb-woo' ),
                'type'    => 'checkbox',
                'label'   => __( 'Enable thirdweb Crypto Payments', 'thirdweb-woo' ),
                'default' => 'no',
            ],
            'title'   => [
                'title'       => __( 'Title', 'thirdweb-woo' ),
                'type'        => 'text',
                'description' => __( 'Title of the payment method displayed during checkout.', 'thirdweb-woo' ),
                'default'     => __( 'Crypto (thirdweb)', 'thirdweb-woo' ),
                'desc_tip'    => true,
            ],
            'description' => [
                'title'       => __( 'Description', 'thirdweb-woo' ),
                'type'        => 'textarea',
                'description' => __( 'Description displayed during checkout.', 'thirdweb-woo' ),
                'default'     => __( 'Pay securely using your crypto wallet through thirdweb.', 'thirdweb-woo' ),
                'desc_tip'    => true,
            ],
            'instructions' => [
                'title'       => __( 'Instructions', 'thirdweb-woo' ),
                'type'        => 'textarea',
                'description' => __( 'Instructions added to the thank you page and emails.', 'thirdweb-woo' ),
                'default'     => __( 'Your payment will be confirmed on-chain. We will notify you once the transaction is complete.', 'thirdweb-woo' ),
            ],
        ];
    }

    public function payment_fields() {
        if ( $this->description ) {
            echo wpautop( wp_kses_post( $this->description ) );
        }

        echo '<div id="thirdweb-checkout-container" data-order=""></div>';
        echo '<button type="button" class="button alt" id="thirdweb-launch-checkout">' . esc_html__( 'Pay with Crypto', 'thirdweb-woo' ) . '</button>';
        echo '<input type="hidden" name="thirdweb_checkout_session" id="thirdweb_checkout_session" value="" />';
    }

    public function enqueue_scripts() {
        if ( ! is_checkout() ) {
            return;
        }

        wp_enqueue_script( 'thirdweb-checkout' );
    }

    public function process_payment( $order_id ) {
        $order = wc_get_order( $order_id );
        $order->update_status( 'pending', __( 'Awaiting thirdweb crypto payment.', 'thirdweb-woo' ) );

        WC()->cart->empty_cart();

        return [
            'result'   => 'success',
            'redirect' => $this->get_return_url( $order ),
        ];
    }

    public function thankyou_page( $order_id ) {
        if ( $this->instructions ) {
            echo wp_kses_post( wpautop( $this->instructions ) );
        }

        echo '<div class="thirdweb-payment-status" data-order-id="' . esc_attr( $order_id ) . '">';
        echo '<p>' . esc_html__( 'If you have not completed your crypto payment, please use the button below.', 'thirdweb-woo' ) . '</p>';
        echo '<button class="button" id="thirdweb-resume-checkout" data-order-id="' . esc_attr( $order_id ) . '">' . esc_html__( 'Complete Crypto Payment', 'thirdweb-woo' ) . '</button>';
        echo '</div>';
    }
}
