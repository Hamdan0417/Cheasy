<?php
/**
 * Plugin Name: Cheasy Thirdweb Integration
 * Plugin URI: https://cheasystore.com
 * Description: Integrates WooCommerce with thirdweb for Web3 functionality.
 * Version: 1.1.0
 * Author: Jules
 * Author URI: https://jules.ai
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: cheasy-thirdweb-integration
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Include settings page
require_once( plugin_dir_path( __FILE__ ) . 'includes/settings-page.php' );


/**
 * Enqueue scripts and styles.
 */
function ctw_enqueue_scripts() {
    $settings = get_option('ctw_settings');
    $client_id = isset($settings['client_id']) ? $settings['client_id'] : '';

	global $post;
	if ( (is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'thirdweb_connect' )) || is_checkout() ) {
		wp_enqueue_script( 'react', 'https://unpkg.com/react@18/umd/react.production.min.js', array(), '18.2.0', true );
		wp_enqueue_script( 'react-dom', 'https://unpkg.com/react-dom@18/umd/react-dom.production.min.js', array( 'react' ), '18.2.0', true );
		wp_enqueue_script( 'thirdweb-react', 'https://unpkg.com/@thirdweb-dev/react@latest/dist/thirdweb-react.js', array( 'react', 'react-dom' ), null, true );

		wp_enqueue_script( 'ctw-connect', plugins_url( 'js/connect.js', __FILE__ ), array( 'thirdweb-react' ), '1.1.0', true );
		wp_localize_script( 'ctw-connect', 'ctw_vars', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'ctw_nonce' ),
            'client_id' => esc_js($client_id)
		) );

        if ( is_checkout() ) {
            wp_enqueue_script( 'ctw-checkout', plugins_url( 'js/checkout.js', __FILE__ ), array( 'thirdweb-react' ), '1.1.0', true );
            wp_localize_script( 'ctw-checkout', 'ctw_checkout_vars', array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce( 'ctw_checkout_nonce' ),
                'client_id' => esc_js($client_id)
            ) );
        }
	}
}
add_action( 'wp_enqueue_scripts', 'ctw_enqueue_scripts' );

/**
 * Register the shortcode.
 */
function ctw_connect_shortcode() {
	return '<div id="thirdweb-connect-root"></div>';
}
add_shortcode( 'thirdweb_connect', 'ctw_connect_shortcode' );


/**
 * AJAX handler for saving wallet address.
 */
function ctw_save_wallet_address() {
	check_ajax_referer( 'ctw_nonce', 'nonce' );

	if ( ! is_user_logged_in() ) {
		$email = sanitize_email( $_POST['email'] );
		$address = sanitize_text_field( $_POST['address'] );

		if ( ! $email || ! is_email($email) ) {
			wp_send_json_error( array( 'message' => 'A valid email is required for new users.' ) );
			return;
		}

		$user = get_user_by( 'email', $email );
		if ( ! $user ) {
			$username = sanitize_user( explode( '@', $email )[0] );
			$random_password = wp_generate_password( 12, false );
			$user_id = wp_create_user( $username, $random_password, $email );
			if ( is_wp_error( $user_id ) ) {
				wp_send_json_error( array( 'message' => 'Could not create user.' ) );
				return;
			}
			wp_set_current_user( $user_id );
			wp_set_auth_cookie( $user_id );
		} else {
			$user_id = $user->ID;
		}
	} else {
		$user_id = get_current_user_id();
		$address = sanitize_text_field( $_POST['address'] );
	}

	if ( $address ) {
		update_user_meta( $user_id, 'thirdweb_wallet_address', $address );
		wp_send_json_success( array( 'message' => 'Wallet address saved.' ) );
	} else {
		wp_send_json_error( array( 'message' => 'Address is required.' ) );
	}
}
add_action( 'wp_ajax_ctw_save_wallet_address', 'ctw_save_wallet_address' );
add_action( 'wp_ajax_nopriv_ctw_save_wallet_address', 'ctw_save_wallet_address' );


/**
 * Initialize thirdweb payment gateway.
 */
function ctw_init_gateway_class() {
    if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;

    class WC_Gateway_Thirdweb extends WC_Payment_Gateway {
        public function __construct() {
            $this->id                 = 'thirdweb';
            $this->icon               = '';
            $this->has_fields         = true;
            $this->method_title       = 'Crypto (thirdweb)';
            $this->method_description = 'Pay with cryptocurrency using thirdweb.';
            $this->init_form_fields();
            $this->init_settings();
            $this->title        = $this->get_option( 'title' );
            $this->description  = $this->get_option( 'description' );
            $this->enabled      = $this->get_option( 'enabled' );
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
            add_action( 'woocommerce_api_wc_gateway_thirdweb', array( $this, 'webhook_handler' ) );
        }

        public function init_form_fields() {
            $this->form_fields = array( /* ... same as before ... */ );
        }

        public function payment_fields() {
            if ( $this->description ) {
                echo wpautop( wp_kses_post( $this->description ) );
            }
            echo '<div id="thirdweb-checkout-root" data-order-total="'.WC()->cart->total.'"></div>';
        }

        public function process_payment( $order_id ) {
            $order = wc_get_order( $order_id );
            $order->update_status( 'on-hold', __( 'Awaiting crypto payment', 'cheasy-thirdweb-integration' ) );
            wc_reduce_stock_levels( $order_id );
            WC()->cart->empty_cart();
            return array(
                'result'   => 'success',
                'redirect' => $this->get_return_url( $order )
            );
        }

        public function webhook_handler() {
            $settings = get_option('ctw_settings');
            $webhook_secret = isset($settings['webhook_secret']) ? $settings['webhook_secret'] : '';

            $signature = $_SERVER['HTTP_X_THIRDWEB_SIGNATURE'];
            $payload = file_get_contents( 'php://input' );

            if (empty($webhook_secret) || empty($signature)) {
                http_response_code( 400 );
                exit();
            }

            $expected_signature = hash_hmac('sha256', $payload, $webhook_secret);

            if (hash_equals($expected_signature, $signature)) {
                $event = json_decode( $payload );
                if ( isset( $event->orderId ) && isset( $event->transactionHash ) ) {
                    $order_id = intval( $event->orderId );
                    $order = wc_get_order( $order_id );
                    if ( $order ) {
                        $order->payment_complete( $event->transactionHash );
                        $order->add_order_note( 'thirdweb transaction hash: ' . $event->transactionHash );
                    }
                }
                http_response_code( 200 );
            } else {
                http_response_code( 401 );
            }
            exit();
        }
    }
}
add_action( 'plugins_loaded', 'ctw_init_gateway_class' );

/**
 * Add Gateway to WooCommerce.
 */
function ctw_add_gateway_class( $methods ) {
    $methods[] = 'WC_Gateway_Thirdweb';
    return $methods;
}
add_filter( 'woocommerce_payment_gateways', 'ctw_add_gateway_class' );


/**
 * Mint loyalty NFT on payment completion.
 */
function ctw_mint_loyalty_nft( $order_id ) {
    $settings = get_option('ctw_settings');
    if (empty($settings['api_vault_key']) || empty($settings['loyalty_nft_contract_address'])) return;

    $order = wc_get_order( $order_id );
    $user_id = $order->get_user_id();
    if ( $user_id ) {
        $wallet_address = get_user_meta( $user_id, 'thirdweb_wallet_address', true );
        if ( $wallet_address ) {
            $engine_url = 'https://engine.thirdweb.com/contract/mumbai/' . $settings['loyalty_nft_contract_address'] . '/erc721/mint';

            $response = wp_remote_post( $engine_url, array(
                'method'    => 'POST',
                'headers'   => array(
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer ' . $settings['api_vault_key'],
                    'x-project-id' => $settings['project_id']
                ),
                'body'      => json_encode(array(
                    'receiver' => $wallet_address,
                    'metadata' => array('name' => 'Loyalty NFT'),
                )),
            ));

            if (!is_wp_error($response)) {
                $order->add_order_note('Loyalty NFT minted successfully.');
            }
        }
    }
}
add_action( 'woocommerce_payment_complete', 'ctw_mint_loyalty_nft' );


/**
 * Apply token-gated discount.
 */
function ctw_apply_token_gated_discount( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    $settings = get_option('ctw_settings');
    if (empty($settings['api_vault_key']) || empty($settings['token_gated_nft_contract_address']) || empty($settings['token_gated_coupon_code'])) return;

    $user_id = get_current_user_id();
    if ( $user_id ) {
        $wallet_address = get_user_meta( $user_id, 'thirdweb_wallet_address', true );
        if ( $wallet_address ) {
            $engine_url = 'https://engine.thirdweb.com/contract/mumbai/' . $settings['token_gated_nft_contract_address'] . '/erc721/balance-of?walletAddress=' . $wallet_address;

            $response = wp_remote_get( $engine_url, array(
                'headers'   => array(
                    'Authorization' => 'Bearer ' . $settings['api_vault_key'],
                    'x-project-id' => $settings['project_id']
                ),
            ));

            if (!is_wp_error($response)) {
                $body = json_decode(wp_remote_retrieve_body($response));
                if (isset($body->result) && $body->result > 0) {
                    if (!$cart->has_discount($settings['token_gated_coupon_code'])) {
                        $cart->add_coupon($settings['token_gated_coupon_code']);
                    }
                }
            }
        }
    }
}
add_action( 'woocommerce_before_calculate_totals', 'ctw_apply_token_gated_discount', 10, 1 );
