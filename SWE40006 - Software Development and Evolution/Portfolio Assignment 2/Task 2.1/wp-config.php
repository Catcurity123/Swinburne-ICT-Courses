<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_db' );

/** Database username */
define( 'DB_USER', 'wp_user' );

/** Database password */
define( 'DB_PASSWORD', 'luan123' );

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
define('AUTH_KEY',         '_._L>r!9&j gPga6B`X?+NVvbyh&VhC1xxyCGo|m T:*#Jk<BW~xc:g4_BwkgiCP');
define('SECURE_AUTH_KEY',  'YyN]*WP20~goxC~7r1?7<GC8T7P$ziuLaS0-H@xPlA62/*] :eVY_qdXw|Zg9<Wi');
define('LOGGED_IN_KEY',    '$od|m9&XeuU)fs1Hu>%-YH=^^aSJxA |-1v*a!>EXc^~VO`sSx?oBM t$U=!jM`J');
define('NONCE_KEY',        '9xUeE#9}t8ghy=VUd5ag-$>/#@F)^#F{4A+g-}~D~1TmA<pmKDM]2`<Q<AXa)R?/');
define('AUTH_SALT',        '4fhEKz|`G>a 5N*ozzK&6dec-eGX, wc[gBHhUgg=|%T`hKxgD77b)ddY8W,v<ah');
define('SECURE_AUTH_SALT', 'XNDU-T}_WS2(<|*=]>l&Etz4zn!|SX0TH6-HowN 9*,M[38h@f~&^,}up%]oM*mA');
define('LOGGED_IN_SALT',   'G>eUWsFh#(DJUcB/rIme2,E.B4buh;((C-lKt;Xkdv_e/@fROnEhWj[9xXI7nC(W');
define('NONCE_SALT',       'kJ+1-O[(D3g- o)44qUgs.>ScRB!NMp)3XC-GKk9*~2U_{683A9,(AtF@KX2.SXI');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
