<?php
/**
 * Entry point for plugin integrations
 */

// Add Yith Wishlist integration.
if ( class_exists( 'YITH_WCWL' ) ) {
	require ADSW_THEME_PATH . '/include/integrations/wc-yith-wishlist/yith-wishlist.php';
}
