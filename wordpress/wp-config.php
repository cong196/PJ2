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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'project1' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'jp`LoTc;=T_f^y$cO2_f7ijGZ=t[mIpZ.Af{9JFboGl.QpWsHp)w&r2l!sS+oc#V' );
define( 'SECURE_AUTH_KEY',  'RH%aSi/qHt(l@zs^8Qj$,x7#nUEH+E?b*0iX(zbo%5mW6 LJ$V_a[J7y}k. He2E' );
define( 'LOGGED_IN_KEY',    'ZfYT;t%WrGU}*uk|}_I.9%O(Og|p/Cq>+9hiH@`d13LD/i^};^+D2gcY@2ib yy2' );
define( 'NONCE_KEY',        ':~~5`$Iq*fo# pWMx:EPqe$A K` !J,6?k-y&@*k|P8P?,Nm*|+q7[QyLr_<nFk!' );
define( 'AUTH_SALT',        'U*c)DJcbf_};vOn_whPAXAR?<d{UW`w%-/HUqcmz$802<4 r=I~m|i-HqWVyJDT<' );
define( 'SECURE_AUTH_SALT', 'Dt:t#F1?>Rr>ikpPtbJ_33ei)~B9b8z!idhr@dJJ9dB=vo+T}7zJ[OPGf]M`#te-' );
define( 'LOGGED_IN_SALT',   ')[i.1E@V{e47#f{AN1.P.6_vDnVc$czFeQD9p{dkhTJJ}LND3:9|Ud8:VcXj*IhM' );
define( 'NONCE_SALT',       'DPE1s$Lbk?(:Pj9KL2L!Tn<yM]Wn~4cV;L.%)59F6Za7SVcjhL0)Gn]>ZbF5cXPg' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
