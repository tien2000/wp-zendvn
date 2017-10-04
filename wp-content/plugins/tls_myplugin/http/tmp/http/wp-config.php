<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db_zendvn_mp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'jDI&Mho17pzUUA 1Xj?r@L>E.|<V{36<t;|HR8usLDv!=2]83 WmKAx7nD4-tic<');
define('SECURE_AUTH_KEY',  '1Odl.cdkTWpgGO+}V|Of?lC8[p/_/8BtT2X.s@x>emQ<4pX|8pt6@:<F3Ip|Q{:r');
define('LOGGED_IN_KEY',    '.5~/tVE;R=&Q>J;%1}Y;aF]h4pnvBi_=C$$AU<eG61?|<%oG0Ih0urq]kEelAwzS');
define('NONCE_KEY',        'EHFc0Y5Op6*%n;%Q45X>*)>dQP~:z+Y]$1JoW6|,r94K-TwlTEvU{Iq$W#!Y-Sd4');
define('AUTH_SALT',        'vANpS,a$W-|@ox;rA;6V]Xu>$p1guJ}.]jB:&8ULx-W`5zM0sASxf%CxdJ8]vO62');
define('SECURE_AUTH_SALT', '|ST^yPjk]#}NVr=(G,jh0ewKQG?(d^spP=sN,_k^9Y*tF3_fV[eUT2AotJ8te$_?');
define('LOGGED_IN_SALT',   '8SI R<ss5Yg:t?d@yZv<0 94|bf4D+A[j4^uHR^Csv8B:_S0LixSjf93NF]]q>Ot');
define('NONCE_SALT',       'b%>s?Ug,O@^D9uHh>{/@HY@~4;aW]sRrvfq!I~!Wb!DSm]dm?rXw 2<yn|jJ2t$@');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
