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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'user_management' );

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
define( 'AUTH_KEY',         'XuN9r:=(DW^8UY_R/+=$zT^vi#Jct&Uf5H4Jd3z]v>BKdxLuHh<`taflZSPx:Cv%' );
define( 'SECURE_AUTH_KEY',  'P^V_<eT7.wB.<u88L8dw@NU(9LW_4:F=P`pz}Yjz%o+d4.=]0WEgxhz6!/5*[0#_' );
define( 'LOGGED_IN_KEY',    'h(HrBN !98V:Gtk3@~4K[r8RdQ%pvieaZY}4eT0U):OP^_QAo$VSP.JiJ*sOCfca' );
define( 'NONCE_KEY',        'BMl~$-a|Rl2p3|%%J2(t a`*F+N`2[q_2kpy2Kt9cT|-M^Ji!$P$&vRHD>s(+i+}' );
define( 'AUTH_SALT',        '1CaQA16Wg&}K3#*rM/NaxMz=8P4PT./7oYzn47F1b+u5AKR@nBO<G}#+w=:X993&' );
define( 'SECURE_AUTH_SALT', ';2Yz_0,sO&ps0;KidB;PW9p?nIKTio1G={$%Nva=Q91yPUy1-a%g$Ho,,ST_*uK_' );
define( 'LOGGED_IN_SALT',   'ZF3yT)[|jf5WLmc+Po~uh_G@1$]Yb>hR>^0<DL (UY{Lk:%KJz-uLmJ;% /,|_Fl' );
define( 'NONCE_SALT',       'f/qUhmC-2{tM{^OeeN=Xig.Q@|*GS]hH8D*R(V%PBl/_F1]bP1RXzTR$A7~qDuR[' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
// define( 'WP_DEBUG', true );
//    define('WP_DEBUG_DISPLAY', true);
//    define('WP_DEBUG_LOG', true);
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
