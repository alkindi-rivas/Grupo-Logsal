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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          '<ZJAjP/|#@<j1f&)w!wNac%yS<<h[ $h7,z>y>vG^_3|==n49]Fs]Baeb8V(6`(+' );
define( 'SECURE_AUTH_KEY',   'zJ+)s%[Yhf{%B[b9=`qH:GjSx+5mi&l-r;1`i!5!k-[1[:I,Ft4i;EC6?{7@JN4%' );
define( 'LOGGED_IN_KEY',     'L(EN([ftz0;~)!D{}juxX<7CqY/^R%E%h@%|<~r?;ACj6UvyvW(]ewowpBE#o//]' );
define( 'NONCE_KEY',         '}>@GDOuiF0]DdD_M3$iIU~9g` 1:O7pwska!cO1:pTEFY6J*<#lXO(|d)/[Khbm1' );
define( 'AUTH_SALT',         'MZDCpu{l!SpX)v:S);!])&7?4X|RT&$Y^Uhl%nU.$bzwY|<pi%/YD|1I|}qMu,5J' );
define( 'SECURE_AUTH_SALT',  'rTf<{IG|`DWa3V3S60YuAO8O]4s}M&{-l)mG=0Uj75SNp7eZ<5{UoLF_4;HyuE$[' );
define( 'LOGGED_IN_SALT',    ']L_dffXC3h;C`wR+j9o@.Xz)0,*LNIun^<O09~R;h&t^)H+9]jY+7q-z>N%Kk[E?' );
define( 'NONCE_SALT',        'uSa;mV6e.X?[zC)o:sLJs,B{Wm/BYqI4}k<4btNF.A>2wm!1mJ02rbKLzx1>R1mj' );
define( 'WP_CACHE_KEY_SALT', 'Ct)~I>TtT!k `#<&9GP9k}@nJT;Xh-q+?kjFx.,sh<0c*Y~Tnj%.21kHzHh5PrFS' );


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

// define( 'WP_DEBUG', true );
// define( 'WP_DEBUG_LOG', true );
// define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_ENVIRONMENT_TYPE', 'local' );
define( 'WP_MEMORY_LIMIT', '256M' );
ini_set('upload_max_size' , '256M' );
ini_set('post_max_size','256M');
ini_set('pcre.recursion_limit',20000000);
ini_set('pcre.backtrack_limit',10000000);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
