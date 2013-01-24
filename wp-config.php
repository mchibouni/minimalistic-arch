<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ikbel_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'm3r-@H@xKD(tBoA@Ge[8@lQpU`8sO5/+=uI-hy~M-*ewf7vln89+-dNfH0i_=Z%e');
define('SECURE_AUTH_KEY',  '>fX92-?-3CWfbA]~?Q9p%iaV.azCnC!xAi4@oCGlEFDVu)v}^O?3TCi3~)-eF,%3');
define('LOGGED_IN_KEY',    'x@^K9P&IT;XMD$)BU4p${uc&2^LU5,AS|qX@{Zjd*Kd>F|UWGQk|.k}+Mne$DJe-');
define('NONCE_KEY',        'z2Z#+C};$:|QJ^W!-j=FhPD8BbsZ-L(1yX*#h;L3vZ)w~^dgIFt+a[4LLcS7.wAn');
define('AUTH_SALT',        'Lko8[vA;FobK{u/66Y 9l4,R#]-yC3gvc%cbPe8f)H~j*_z$cC$lRsngKeza1u4a');
define('SECURE_AUTH_SALT', 'K|}H{VQo[[~0X=i%J?v{:8C+zl}y?/{?3tJwHGA|?F]dmM~;bu@+-+7R+Vv:,uqw');
define('LOGGED_IN_SALT',   'wYXehA:wiLP=|IT&*~b<EX0c(Jk<>wK5b7u@SF(hJ-jB$b4iOgsS2/V%`_.MW:c+');
define('NONCE_SALT',       'Tn68:x%yCT,p-|Z*tP`<0:% `5AGU?`E)u]}DwB*#|hGDlY4+}H*+rH+<A;6,up|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
