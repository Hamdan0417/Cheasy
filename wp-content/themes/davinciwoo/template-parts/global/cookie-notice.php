<?php
/**
 * Cookie notice banner markup.
 */

if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
    return;
}

$defaults = [
    'message'   => __( 'This site uses cookies from Google to deliver its services and to analyze traffic.', 'davinciwoo' ),
    'cta'       => __( 'Got it', 'davinciwoo' ),
    'policy'    => __( 'Learn more', 'davinciwoo' ),
    'policyUrl' => apply_filters( 'davinciwoo_cookie_policy_url', home_url( '/privacy-policy/' ) ),
];
?>
<div class="ali-cookie-banner" data-cookie-banner hidden role="region" aria-live="polite">
    <p class="mb-0" data-cookie-message><?php echo esc_html( $defaults['message'] ); ?></p>
    <div class="ali-cookie-banner__actions">
        <button type="button" class="button button alt" data-cookie-accept><?php echo esc_html( $defaults['cta'] ); ?></button>
        <a class="ali-cookie-banner__link" data-cookie-policy href="<?php echo esc_url( $defaults['policyUrl'] ); ?>" target="_blank" rel="noopener noreferrer">
            <?php echo esc_html( $defaults['policy'] ); ?>
        </a>
    </div>
</div>
