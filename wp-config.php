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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

if (!defined('FS_METHOD')) define('FS_METHOD', 'direct');

/**
 * For AWS LB
 */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
    $_SERVER['HTTPS'] = 'on';
}

require_once __DIR__ . '/env.php';

/****************************************************************************/
/*                              Database config                             */
/****************************************************************************/
// ** MySQL settings - You can get this info from your web host ** //
define('DB_CHARSET', env('DB_CHARSET', 'utf8'));
define('DB_COLLATE', env('DB_COLLATE', ''));
define('DB_HOST', env('DB_HOST', '127.0.0.1'));
define('DB_NAME', env('DB_NAME', 'th42hub'));
define('DB_USER', env('DB_USER', 'root'));
define('DB_PASSWORD', env('DB_PASSWORD', ''));
$table_prefix = env('DB_TABLE_PREFIX', 'wp_th42hub');

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
define('AUTH_KEY',         'OWZtLz-Xz5xweS@]ONw{N*$%)Ly1-AKx#>l89q$o28^r_U8-Gp8OUd=<T:=`KLyO');
define('SECURE_AUTH_KEY',  'IcHDV}[DYi.x8Z;`>foEI-I3&3%]3=Bj>u%Ylq{uHDk9}+:J==pA 2nMq~.g{<<8');
define('LOGGED_IN_KEY',    'AJpvbo5S7xZspcf_ hkV>YH] Kyff~Jw/7ndE$^G,<J$LRTO|0`-HZS(APrC<eEf');
define('NONCE_KEY',        '28`i;0V+L0DZ1/Bm9cZN^k;_)g-=L#cDz,QI1^1eSyr+83u!:_3Sq*R<h?%b2u@x');
define('AUTH_SALT',        '[}OJ5dC0][FSwXs84(Y6KSITR`i#T(13KETZDN[9FdDOGm-_c~l00TTRagJKheV1');
define('SECURE_AUTH_SALT', '84Bu%Gojxnb6qamD*]SzUPYyToA(Tp_J?C8)xG+jy{Di*Z[%Y]3trjt:s% hm!K@');
define('LOGGED_IN_SALT',   '}B_HAjoZf!y7_9N1s|+Ul+pvY%W]^/OLSR/Le[kzZ0!zl~&^)c*8wT0m%5MF[MU@');
define('NONCE_SALT',       '1:A1M3e?3y0|f^wBWaCR4LW-yDFXRv@C@sZD(*t`B,lphD,y~aFK6l0}c=1hp.1H');

/**#@-*/

/****************************************************************************/
/*                           Auto activate plugin                           */
/****************************************************************************/
if (!function_exists('is_plugin_active')) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

$plugin = 'th42-hub/th42-hub.php';

if (!is_plugin_active($plugin)) {
    activate_plugin($plugin);
}

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define('WP_DEBUG', env('WP_DEBUG', false));
define('WP_DEBUG_LOG', env('WP_DEBUG_LOG', false));
define('WP_DEBUG_DISPLAY', env('WP_DEBUG_DISPLAY', false));
define('SCRIPT_DEBUG', env('SCRIPT_DEBUG', false));

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
