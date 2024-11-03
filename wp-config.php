<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u211132314_Rsihl' );

/** Database username */
define( 'DB_USER', 'u211132314_hma4C' );

/** Database password */
define( 'DB_PASSWORD', 'eNMfLSY37B' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          '0C%hEs4.wnZnbemjR8m?QWp])nz(9T8:@rH#XxyJG3&%/)M$HRu&Z:Y`+7m(NPOt' );
define( 'SECURE_AUTH_KEY',   'nC0S1Sov-R/,B#7]_O[#nwqB3iO+{cP6y+iy8m;,pm_&2vK7;)8q4oXC,{JJwbA(' );
define( 'LOGGED_IN_KEY',     '0jC~~e43{++hI8OIX=W!lh4fla%h|y1LOPp6*:wN<}LA4/9An~r_Or)vZp>F[o+U' );
define( 'NONCE_KEY',         'oiI*J=(wIz(gxQv<|P-99fcx.AV=^p7D<X)wi.Yod&VlRkkC5.uUBA%-Xo9u]u?/' );
define( 'AUTH_SALT',         '??T3V;VPSm|-w{XW86g%#6=[ q$TW+n/at|eK##pvCn9Aq#T?bp$a9u;7e#U=Ec ' );
define( 'SECURE_AUTH_SALT',  'Hp3Kz(U$-b#V[g_))%fK=}X[Q-0ALn1f*POp9>-8%4NV=T=$}?$R!AUg+f<@o?3`' );
define( 'LOGGED_IN_SALT',    '1xhq^W..hRW[``:o$5]{7XF;pkQk]@*bFv~*)3pl5GA>AMPJ?+[lP:0:^3crG|N ' );
define( 'NONCE_SALT',        'kqIrd*PKzA4I?A640S{tj31=^$DWk/4xdrMDc[Y1(Y{jS4RL9RZx$E`AtB)XL JX' );
define( 'WP_CACHE_KEY_SALT', 'xbw}4, N)TXZp._z`igFmFWU8.%cO0Ao1&]}Y>9-y_FD`Ok+j-FX^3+yDB7:_<X3' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', 'ccad9854d573047bd9806abee0a8651d' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
