<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'cheasyst_wp_ozhih' );

/** Database username */
define( 'DB_USER', 'cheasyst_wp_qylt9' );

/** Database password */
define( 'DB_PASSWORD', '!*AqmBt0r_c2_2~L' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'zCtB66V7P@]XL0&RJc0&*)wAH6_-L8vA5hjU:VwOka;07/Qi3YxM(5l8GAv14x52');
define('SECURE_AUTH_KEY', '/uU51E/;yN;[5PYb1;*U9c0/8W3YA5A)Gx)4ZCOq84N;)9-*q5d7U38j1[%W]-v8');
define('LOGGED_IN_KEY', 'Yd5i1yy9#0:s00~G5yjaSzTZ40wAI_F0t*|:/Q4sKQ3PBB6ExvT~@SlZ6)~AfIb3');
define('NONCE_KEY', '|4N%4%mtd2fECZ_ja60x[:6h67G2Q2!X/G&~5Dg2CkzW])09[!0vc/91;GlE5f#5');
define('AUTH_SALT', '7*#s[6Y09*n[718f3_0GEdEOElyH1r&r3Nz#&v27be7m9NZ8U[9EfddCU6r9Kp%3');
define('SECURE_AUTH_SALT', 'ZsXC%v18[q%44ehNO4Dlf;_m5U63A72Z6I(44~:3yE6-SGGlgd%h(v:juK8#8psg');
define('LOGGED_IN_SALT', 'S9O4o&/W|~G]c)Ci_9lKM@k@Dl1(d9#dg8:+4]L87FGij/%14u1-[dE3kcO3E(Sg');
define('NONCE_SALT', '[yT8y[!1+81lsyrT8s+x~k]a3iXcRf5Llk+O3j8b3GI[a0&ku5I2:#)~3D/%~5ja');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'OKxo8uv9i_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
