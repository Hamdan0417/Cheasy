<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add the settings page to the admin menu.
 */
function ctw_add_admin_menu() {
    add_menu_page(
        'thirdweb Integration Settings',
        'thirdweb Settings',
        'manage_options',
        'cheasy_thirdweb_integration',
        'ctw_settings_page_html',
        'dashicons-admin-generic'
    );
}
add_action( 'admin_menu', 'ctw_add_admin_menu' );

/**
 * Register the settings.
 */
function ctw_settings_init() {
    register_setting( 'ctw_settings_group', 'ctw_settings' );
}
add_action( 'admin_init', 'ctw_settings_init' );

/**
 * HTML for the settings page.
 */
function ctw_settings_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'ctw_settings_group' );
            do_settings_sections( 'cheasy_thirdweb_integration' );
            $settings = get_option('ctw_settings');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Client ID</th>
                    <td><input type="text" name="ctw_settings[client_id]" value="<?php echo isset($settings['client_id']) ? esc_attr($settings['client_id']) : ''; ?>" size="50" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Project ID</th>
                    <td><input type="text" name="ctw_settings[project_id]" value="<?php echo isset($settings['project_id']) ? esc_attr($settings['project_id']) : ''; ?>" size="50" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">API Vault Key</th>
                    <td><input type="password" name="ctw_settings[api_vault_key]" value="<?php echo isset($settings['api_vault_key']) ? esc_attr($settings['api_vault_key']) : ''; ?>" size="50" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Webhook Secret</th>
                    <td><input type="password" name="ctw_settings[webhook_secret]" value="<?php echo isset($settings['webhook_secret']) ? esc_attr($settings['webhook_secret']) : ''; ?>" size="50" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Loyalty NFT Contract Address</th>
                    <td><input type="text" name="ctw_settings[loyalty_nft_contract_address]" value="<?php echo isset($settings['loyalty_nft_contract_address']) ? esc_attr($settings['loyalty_nft_contract_address']) : ''; ?>" size="50" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Token Gated NFT Contract Address</th>
                    <td><input type="text" name="ctw_settings[token_gated_nft_contract_address]" value="<?php echo isset($settings['token_gated_nft_contract_address']) ? esc_attr($settings['token_gated_nft_contract_address']) : ''; ?>" size="50" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Token Gated Coupon Code</th>
                    <td><input type="text" name="ctw_settings[token_gated_coupon_code]" value="<?php echo isset($settings['token_gated_coupon_code']) ? esc_attr($settings['token_gated_coupon_code']) : ''; ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
