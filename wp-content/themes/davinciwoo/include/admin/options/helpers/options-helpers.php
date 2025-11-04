<?php

// Set default transport
$transport = 'postMessage';
if ( ! isset( $wp_customize->selective_refresh ) ) {
  $transport = 'refresh';
}

$image_url = ADSW_THEME_URL . '/include/admin/customizer/images/';
