<?php
$logo       = adswth_option( 'site_logo' );
$logo_url   = '';
$logo_alt   = '';
$image      = '';
$site_title = get_bloginfo( 'name', 'display' );
$attributes = [
    'class'   => 'site-logo img-fluid',
    'loading' => 'eager',
    'decoding'=> 'async',
];

if ( is_array( $logo ) ) {
    $logo_url = $logo['url'] ?? '';

    if ( ! empty( $logo['id'] ) ) {
        $logo_alt = get_post_meta( $logo['id'], '_wp_attachment_image_alt', true );
        $image    = wp_get_attachment_image(
            (int) $logo['id'],
            'full',
            false,
            array_merge(
                $attributes,
                [ 'alt' => $logo_alt ?: $site_title ]
            )
        );
    }
}

if ( empty( $image ) && $logo_url ) {
    $image = sprintf(
        '<img src="%1$s" alt="%2$s" class="site-logo img-fluid" loading="eager" decoding="async" width="180" height="60" />',
        esc_url( $logo_url ),
        esc_attr( $logo_alt ?: $site_title )
    );
}

if ( empty( $image ) && has_custom_logo() ) {
    $image = get_custom_logo();
}

if ( empty( $image ) ) {
    $image = sprintf( '<span class="site-title text-uppercase font-weight-bold">%s</span>', esc_html( $site_title ) );
}
?>
<div class="site-logo-wrap d-flex align-items-center">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <?php echo $image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </a>
</div>
