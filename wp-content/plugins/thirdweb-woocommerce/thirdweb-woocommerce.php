<?php
/**
 * Plugin Name: Thirdweb WooCommerce Integration
 * Description: Integrates thirdweb wallet connect, crypto payments, loyalty NFTs, and token-gated perks with WooCommerce.
 * Version: 1.0.0
 * Author: OpenAI Assistant
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Thirdweb_WooCommerce_Integration {
    const OPTION_KEY = 'thirdweb_woo_settings';
    const TABLE_LOGS = 'thirdweb_webhook_logs';
    const SHORTCODE = 'thirdweb_connect_embed';

    public function __construct() {
        register_activation_hook( __FILE__, [ $this, 'activate_plugin' ] );
        register_deactivation_hook( __FILE__, [ $this, 'deactivate_plugin' ] );

        add_action( 'init', [ $this, 'register_shortcode' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
        add_action( 'admin_menu', [ $this, 'register_settings_page' ] );

        add_filter( 'woocommerce_payment_gateways', [ $this, 'register_gateway' ] );
        add_action( 'rest_api_init', [ $this, 'register_rest_routes' ] );

        add_action( 'woocommerce_payment_complete', [ $this, 'handle_payment_complete' ], 20, 1 );
        add_action( 'woocommerce_before_checkout_process', [ $this, 'handle_token_gated_perks' ] );
        add_action( 'woocommerce_checkout_create_order', [ $this, 'attach_wallet_to_order' ], 15, 2 );

        add_action( 'wp_ajax_thirdweb_store_wallet', [ $this, 'handle_wallet_store' ] );
        add_action( 'wp_ajax_nopriv_thirdweb_wallet_login', [ $this, 'handle_wallet_login' ] );
        add_action( 'wp_ajax_thirdweb_wallet_login', [ $this, 'handle_wallet_login' ] );
    }

    public function activate_plugin() {
        global $wpdb;
        $table_name = $wpdb->prefix . self::TABLE_LOGS;
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            received_at datetime NOT NULL,
            event varchar(191) NOT NULL,
            order_id bigint(20) unsigned NULL,
            payload longtext NOT NULL,
            PRIMARY KEY  (id),
            KEY order_id (order_id)
        ) {$charset_collate};";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );

        if ( ! get_option( self::OPTION_KEY ) ) {
            add_option( self::OPTION_KEY, $this->get_default_settings() );
        }
    }

    public function deactivate_plugin() {
        // Keep data by default, but ensure scheduled hooks removed when added in future.
    }

    public function get_default_settings() {
        return [
            'client_id'                  => 'b2b24682c2448fd5fa7c10073947b262',
            'secret_key'                 => 'FTTY9VLKObEpN33e96nGqKz0B8ahxExQk_Ge3J3Fpy1Li1hWO0da_xHnydDbq8kPj76kS35TxhmEJ2Hi4GDJuA',
            'access_token'               => 'vt_act_TIMDKZQGIHNH2HFXOK7ECBBXE23ADRBRLMEKDOIZ2WDJSUF4WGKJRLZQMU7DSQNGXDR7D7NFU3JCUAH5EWGIEGF2JQUJJYILLZVCZPUF',
            'project_id'                 => 'prj_cltj2vy8c0025rw9h3wi51fj5',
            'loyalty_contract'           => '',
            'loyalty_chain'              => 'polygon',
            'token_gated_contract'       => '',
            'token_gated_required'       => '1',
            'token_gated_chain'          => 'polygon',
            'token_gated_coupon'         => '',
            'token_gated_free_shipping'  => '',
            'checkout_chain'             => 'polygon',
            'checkout_payment_method'    => 'crypto',
        ];
    }

    public function register_shortcode() {
        add_shortcode( self::SHORTCODE, [ $this, 'render_connect_embed' ] );
    }

    public function render_connect_embed( $atts ) {
        if ( is_admin() && ! wp_doing_ajax() ) {
            return '<p>' . esc_html__( 'thirdweb Connect Embed preview is not available in the editor.', 'thirdweb-woo' ) . '</p>';
        }

        $settings = $this->get_settings();
        $atts     = shortcode_atts(
            [
                'theme'      => 'dark',
                'modal_title'=> __( 'Connect your wallet or email', 'thirdweb-woo' ),
            ],
            $atts,
            self::SHORTCODE
        );

        ob_start();
        ?>
        <div class="thirdweb-connect-embed" data-theme="<?php echo esc_attr( $atts['theme'] ); ?>" data-modal-title="<?php echo esc_attr( $atts['modal_title'] ); ?>"></div>
        <?php
        wp_enqueue_script( 'thirdweb-connect-embed' );
        wp_enqueue_style( 'thirdweb-connect-embed' );
        wp_localize_script(
            'thirdweb-connect-embed',
            'thirdwebConnectSettings',
            [
                'clientId'   => $settings['client_id'],
                'restUrl'    => esc_url_raw( rest_url( 'thirdweb/v1' ) ),
                'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
                'nonce'      => wp_create_nonce( 'wp_rest' ),
                'siteName'   => get_bloginfo( 'name' ),
                'chain'      => $settings['checkout_chain'],
                'isLoggedIn' => is_user_logged_in(),
            ]
        );

        return ob_get_clean();
    }

    public function register_assets() {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        wp_register_script(
            'thirdweb-connect-embed',
            plugins_url( "assets/js/connect-embed{$suffix}.js", __FILE__ ),
            [],
            '1.0.0',
            true
        );

        wp_register_style(
            'thirdweb-connect-embed',
            plugins_url( 'assets/css/connect-embed.css', __FILE__ ),
            [],
            '1.0.0'
        );

        wp_register_script(
            'thirdweb-checkout',
            plugins_url( "assets/js/checkout{$suffix}.js", __FILE__ ),
            [ 'jquery' ],
            '1.0.0',
            true
        );

        wp_localize_script( 'thirdweb-checkout', 'thirdwebCheckoutSettings', [
            'clientId'    => $this->get_setting( 'client_id' ),
            'chain'       => $this->get_setting( 'checkout_chain' ),
            'projectId'   => $this->get_setting( 'project_id' ),
            'gatewayUrl'  => esc_url_raw( rest_url( 'thirdweb/v1/checkout-session' ) ),
        ] );
    }

    public function register_settings() {
        register_setting( 'thirdweb-woo', self::OPTION_KEY, [ $this, 'sanitize_settings' ] );

        add_settings_section(
            'thirdweb-woo-credentials',
            __( 'thirdweb Credentials', 'thirdweb-woo' ),
            '__return_false',
            'thirdweb-woo'
        );

        $fields = [
            'client_id'                 => __( 'Client ID', 'thirdweb-woo' ),
            'secret_key'                => __( 'Secret Key', 'thirdweb-woo' ),
            'access_token'              => __( 'Access Token', 'thirdweb-woo' ),
            'project_id'                => __( 'Project ID', 'thirdweb-woo' ),
            'loyalty_contract'          => __( 'Loyalty Contract Address', 'thirdweb-woo' ),
            'loyalty_chain'             => __( 'Loyalty Chain (e.g. polygon)', 'thirdweb-woo' ),
            'token_gated_contract'      => __( 'Token Gated Contract Address', 'thirdweb-woo' ),
            'token_gated_required'      => __( 'Required Token Balance', 'thirdweb-woo' ),
            'token_gated_chain'         => __( 'Token Gated Chain (e.g. polygon)', 'thirdweb-woo' ),
            'token_gated_coupon'        => __( 'Coupon Code for Token Holders', 'thirdweb-woo' ),
            'token_gated_free_shipping' => __( 'Free Shipping Method ID', 'thirdweb-woo' ),
            'checkout_chain'            => __( 'Checkout Chain (e.g. polygon)', 'thirdweb-woo' ),
            'checkout_payment_method'   => __( 'Preferred Payment Method (crypto/card)', 'thirdweb-woo' ),
        ];

        foreach ( $fields as $field => $label ) {
            add_settings_field(
                $field,
                $label,
                [ $this, 'render_settings_field' ],
                'thirdweb-woo',
                'thirdweb-woo-credentials',
                [ 'key' => $field ]
            );
        }
    }

    public function sanitize_settings( $input ) {
        $defaults = $this->get_default_settings();
        $sanitized = [];
        foreach ( $defaults as $key => $default ) {
            if ( isset( $input[ $key ] ) ) {
                $value = is_string( $input[ $key ] ) ? sanitize_text_field( $input[ $key ] ) : $input[ $key ];
                $sanitized[ $key ] = $value;
            } else {
                $sanitized[ $key ] = $default;
            }
        }

        return $sanitized;
    }

    public function render_settings_field( $args ) {
        $key       = $args['key'];
        $settings  = $this->get_settings();
        $value     = isset( $settings[ $key ] ) ? $settings[ $key ] : '';
        $type      = 'text';

        if ( 'secret_key' === $key || 'access_token' === $key ) {
            $type = 'password';
        }

        printf(
            '<input type="%1$s" class="regular-text" name="%2$s[%3$s]" value="%4$s" autocomplete="off" />',
            esc_attr( $type ),
            esc_attr( self::OPTION_KEY ),
            esc_attr( $key ),
            esc_attr( $value )
        );

        if ( 'token_gated_free_shipping' === $key ) {
            echo '<p class="description">' . esc_html__( 'Enter a shipping method rate ID (e.g., free_shipping:1) to grant when the user holds the required token.', 'thirdweb-woo' ) . '</p>';
        }
    }

    public function register_settings_page() {
        add_options_page(
            __( 'thirdweb WooCommerce', 'thirdweb-woo' ),
            __( 'thirdweb WooCommerce', 'thirdweb-woo' ),
            'manage_options',
            'thirdweb-woo',
            [ $this, 'render_settings_page' ]
        );
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'thirdweb + WooCommerce Integration', 'thirdweb-woo' ); ?></h1>
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'thirdweb-woo' );
                    do_settings_sections( 'thirdweb-woo' );
                    submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function register_gateway( $gateways ) {
        if ( ! class_exists( 'WC_Gateway_Thirdweb' ) ) {
            require_once __DIR__ . '/includes/class-wc-gateway-thirdweb.php';
        }
        $gateways[] = 'WC_Gateway_Thirdweb';
        return $gateways;
    }

    public function register_rest_routes() {
        register_rest_route(
            'thirdweb/v1',
            '/webhook',
            [
                'methods'             => 'POST',
                'callback'            => [ $this, 'handle_webhook' ],
                'permission_callback' => '__return_true',
            ]
        );

        register_rest_route(
            'thirdweb/v1',
            '/checkout-session',
            [
                'methods'             => 'POST',
                'callback'            => [ $this, 'create_checkout_session' ],
                'permission_callback' => '__return_true',
            ]
        );
    }

    public function attach_wallet_to_order( $order, $data ) {
        if ( ! $order instanceof WC_Order ) {
            return;
        }

        $wallet_address = '';

        if ( isset( $_POST['thirdweb_wallet_address'] ) ) {
            $wallet_address = sanitize_text_field( wp_unslash( $_POST['thirdweb_wallet_address'] ) );
        }

        if ( empty( $wallet_address ) && is_user_logged_in() ) {
            $wallet_address = get_user_meta( get_current_user_id(), '_thirdweb_wallet_address', true );
        }

        if ( $wallet_address ) {
            $order->update_meta_data( '_thirdweb_wallet_address', $wallet_address );
        }
    }

    public function handle_webhook( WP_REST_Request $request ) {
        $settings = $this->get_settings();
        $body     = $request->get_body();
        $event    = $request->get_header( 'x-thirdweb-event' );
        $signature = $request->get_header( 'x-thirdweb-signature' );

        if ( empty( $settings['secret_key'] ) ) {
            return new WP_REST_Response( [ 'error' => 'Missing secret key' ], 400 );
        }

        if ( empty( $signature ) ) {
            return new WP_REST_Response( [ 'error' => 'Missing signature' ], 400 );
        }

        $expected_signature = hash_hmac( 'sha256', $body, $settings['secret_key'] );
        if ( ! hash_equals( $expected_signature, $signature ) ) {
            $this->log_webhook( $event ?: 'unknown', 0, $body );
            return new WP_REST_Response( [ 'error' => 'Invalid signature' ], 401 );
        }

        $payload = json_decode( $body, true );
        if ( empty( $payload ) ) {
            return new WP_REST_Response( [ 'error' => 'Invalid payload' ], 400 );
        }

        $order_id = isset( $payload['metadata']['order_id'] ) ? absint( $payload['metadata']['order_id'] ) : 0;
        $amount   = isset( $payload['amount'] ) ? floatval( $payload['amount'] ) : 0;
        $tx_hash  = isset( $payload['transactionHash'] ) ? sanitize_text_field( $payload['transactionHash'] ) : '';

        if ( $order_id && ( $order = wc_get_order( $order_id ) ) ) {
            $order_total = floatval( $order->get_total() );
            if ( abs( $order_total - $amount ) < 0.01 ) {
                $order->payment_complete( $tx_hash );
                $order->add_order_note( sprintf( __( 'thirdweb payment confirmed. Transaction: %s', 'thirdweb-woo' ), $tx_hash ) );
            } else {
                $order->add_order_note( sprintf( __( 'thirdweb webhook amount mismatch. Expected %1$s, received %2$s', 'thirdweb-woo' ), $order_total, $amount ) );
            }
        }

        $this->log_webhook( $event ?: 'payment', $order_id, $body );

        return new WP_REST_Response( [ 'received' => true ], 200 );
    }

    public function create_checkout_session( WP_REST_Request $request ) {
        $settings = $this->get_settings();
        $order_id = absint( $request->get_param( 'order_id' ) );
        if ( ! $order_id ) {
            return new WP_REST_Response( [ 'error' => 'Missing order_id' ], 400 );
        }

        $order = wc_get_order( $order_id );
        if ( ! $order ) {
            return new WP_REST_Response( [ 'error' => 'Invalid order' ], 404 );
        }

        $payload = [
            'clientId'      => $settings['client_id'],
            'projectId'     => $settings['project_id'],
            'amount'        => $order->get_total(),
            'currency'      => $order->get_currency(),
            'customerEmail' => $order->get_billing_email(),
            'metadata'      => [
                'order_id' => $order_id,
                'wallet'   => $order->get_meta( '_thirdweb_wallet_address' ),
            ],
            'paymentMethod' => $settings['checkout_payment_method'],
            'chain'         => $settings['checkout_chain'],
        ];

        $response = wp_remote_post(
            'https://api.thirdweb.com/v1/payments/checkout',
            [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'x-client-id'   => $settings['client_id'],
                    'Authorization' => 'Bearer ' . $settings['secret_key'],
                ],
                'body'    => wp_json_encode( $payload ),
                'timeout' => 45,
            ]
        );

        if ( is_wp_error( $response ) ) {
            return new WP_REST_Response( [ 'error' => $response->get_error_message() ], 500 );
        }

        $body = json_decode( wp_remote_retrieve_body( $response ), true );

        if ( empty( $body['checkoutUrl'] ) ) {
            return new WP_REST_Response( [ 'error' => 'Unable to create checkout session', 'details' => $body ], 500 );
        }

        return new WP_REST_Response( $body, 200 );
    }

    public function handle_payment_complete( $order_id ) {
        $settings = $this->get_settings();
        $order    = wc_get_order( $order_id );
        if ( ! $order ) {
            return;
        }

        $wallet_address = $order->get_meta( '_thirdweb_wallet_address' );
        if ( ! $wallet_address ) {
            $user_id = $order->get_user_id();
            if ( $user_id ) {
                $wallet_address = get_user_meta( $user_id, '_thirdweb_wallet_address', true );
            }
        }

        if ( empty( $wallet_address ) || empty( $settings['loyalty_contract'] ) ) {
            return;
        }

        $endpoint = sprintf(
            'https://engine.thirdweb.com/%1$s/contract/%2$s/nft/%3$s/mint-to',
            rawurlencode( $settings['loyalty_chain'] ),
            rawurlencode( $settings['loyalty_contract'] ),
            rawurlencode( $settings['project_id'] )
        );

        $payload = [
            'receiver' => $wallet_address,
            'quantity' => 1,
            'metadata' => [
                'name'        => sprintf( __( '%s Loyalty Reward', 'thirdweb-woo' ), get_bloginfo( 'name' ) ),
                'description' => __( 'Thanks for your purchase!', 'thirdweb-woo' ),
                'order_id'    => $order_id,
            ],
        ];

        $response = wp_remote_post(
            $endpoint,
            [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer ' . $settings['access_token'],
                ],
                'body'    => wp_json_encode( $payload ),
                'timeout' => 45,
            ]
        );

        if ( is_wp_error( $response ) ) {
            $order->add_order_note( sprintf( __( 'thirdweb loyalty mint failed: %s', 'thirdweb-woo' ), $response->get_error_message() ) );
            return;
        }

        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        if ( isset( $body['transactionHash'] ) ) {
            $order->add_order_note( sprintf( __( 'thirdweb loyalty NFT minted. Transaction: %s', 'thirdweb-woo' ), $body['transactionHash'] ) );
        } else {
            $order->add_order_note( __( 'thirdweb loyalty mint request sent.', 'thirdweb-woo' ) );
        }
    }

    public function handle_token_gated_perks() {
        if ( ! WC()->cart ) {
            return;
        }

        $settings = $this->get_settings();
        if ( empty( $settings['token_gated_contract'] ) ) {
            return;
        }

        WC()->session->__unset( 'thirdweb_free_shipping' );

        $user_id = get_current_user_id();
        if ( ! $user_id ) {
            return;
        }

        $wallet_address = get_user_meta( $user_id, '_thirdweb_wallet_address', true );
        if ( empty( $wallet_address ) ) {
            return;
        }

        $has_token = $this->wallet_has_token( $wallet_address );
        if ( ! $has_token ) {
            return;
        }

        if ( ! empty( $settings['token_gated_coupon'] ) && ! WC()->cart->has_discount( $settings['token_gated_coupon'] ) ) {
            try {
                WC()->cart->apply_coupon( $settings['token_gated_coupon'] );
            } catch ( Exception $exception ) {
                wc_add_notice( sprintf( __( 'Unable to apply loyalty coupon: %s', 'thirdweb-woo' ), $exception->getMessage() ), 'error' );
            }
        }

        if ( ! empty( $settings['token_gated_free_shipping'] ) ) {
            WC()->session->set( 'thirdweb_free_shipping', $settings['token_gated_free_shipping'] );
            if ( ! has_filter( 'woocommerce_package_rates', [ $this, 'filter_shipping_rates' ] ) ) {
                add_filter( 'woocommerce_package_rates', [ $this, 'filter_shipping_rates' ], 10, 2 );
            }
        }
    }

    public function filter_shipping_rates( $rates, $package ) {
        $free_shipping = WC()->session->get( 'thirdweb_free_shipping' );
        if ( ! $free_shipping ) {
            return $rates;
        }

        foreach ( $rates as $rate_id => $rate ) {
            if ( $rate_id === $free_shipping ) {
                $rates[ $rate_id ]->cost = 0;
                $rates[ $rate_id ]->set_shipping_tax( 0 );
                continue;
            }

            unset( $rates[ $rate_id ] );
        }

        return $rates;
    }

    private function wallet_has_token( $wallet_address ) {
        $settings = $this->get_settings();
        $endpoint = sprintf(
            'https://engine.thirdweb.com/%1$s/contract/%2$s/nft/%3$s/balance',
            rawurlencode( $settings['token_gated_chain'] ),
            rawurlencode( $settings['token_gated_contract'] ),
            rawurlencode( $wallet_address )
        );

        $response = wp_remote_get(
            $endpoint,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $settings['access_token'],
                ],
                'timeout' => 30,
            ]
        );

        if ( is_wp_error( $response ) ) {
            return false;
        }

        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        $required = max( 1, absint( $settings['token_gated_required'] ) );

        if ( isset( $body['balance'] ) ) {
            return intval( $body['balance'] ) >= $required;
        }

        return false;
    }

    public function handle_wallet_store() {
        check_ajax_referer( 'wp_rest', 'nonce' );
        $wallet = isset( $_POST['wallet'] ) ? sanitize_text_field( wp_unslash( $_POST['wallet'] ) ) : '';
        if ( empty( $wallet ) ) {
            wp_send_json_error( [ 'message' => __( 'Missing wallet address.', 'thirdweb-woo' ) ] );
        }

        if ( ! is_user_logged_in() ) {
            wp_send_json_error( [ 'message' => __( 'User not logged in.', 'thirdweb-woo' ) ], 401 );
        }

        $user_id = get_current_user_id();
        update_user_meta( $user_id, '_thirdweb_wallet_address', $wallet );
        wp_send_json_success( [ 'wallet' => $wallet ] );
    }

    public function handle_wallet_login() {
        check_ajax_referer( 'wp_rest', 'nonce' );

        $wallet = isset( $_POST['wallet'] ) ? sanitize_text_field( wp_unslash( $_POST['wallet'] ) ) : '';
        $email  = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

        if ( empty( $wallet ) ) {
            wp_send_json_error( [ 'message' => __( 'Wallet address required.', 'thirdweb-woo' ) ] );
        }

        if ( empty( $email ) ) {
            $email = sprintf( '%s@wallet.thirdweb', strtolower( $wallet ) );
        }

        $user = get_user_by( 'email', $email );
        if ( ! $user ) {
            $username = sanitize_user( current( explode( '@', $email ) ) );
            if ( username_exists( $username ) ) {
                $username .= wp_generate_password( 4, false );
            }
            $password = wp_generate_password( 20 );
            $user_id  = wp_create_user( $username, $password, $email );
            if ( is_wp_error( $user_id ) ) {
                wp_send_json_error( [ 'message' => $user_id->get_error_message() ] );
            }
            $user = get_user_by( 'id', $user_id );
        }

        update_user_meta( $user->ID, '_thirdweb_wallet_address', $wallet );

        wp_set_current_user( $user->ID );
        wp_set_auth_cookie( $user->ID );

        wp_send_json_success( [
            'user_id' => $user->ID,
            'wallet'  => $wallet,
            'email'   => $user->user_email,
        ] );
    }

    private function log_webhook( $event, $order_id, $payload ) {
        global $wpdb;
        $table_name = $wpdb->prefix . self::TABLE_LOGS;
        $wpdb->insert(
            $table_name,
            [
                'received_at' => current_time( 'mysql' ),
                'event'       => sanitize_text_field( $event ),
                'order_id'    => $order_id,
                'payload'     => is_string( $payload ) ? $payload : wp_json_encode( $payload ),
            ]
        );
    }

    public function get_setting( $key, $default = '' ) {
        $settings = $this->get_settings();
        return isset( $settings[ $key ] ) ? $settings[ $key ] : $default;
    }

    public function get_settings() {
        $settings = get_option( self::OPTION_KEY, [] );
        if ( empty( $settings ) ) {
            $settings = $this->get_default_settings();
        }

        return wp_parse_args( $settings, $this->get_default_settings() );
    }
}

new Thirdweb_WooCommerce_Integration();
