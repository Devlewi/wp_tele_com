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

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );

define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
define( 'DOMAIN_CURRENT_SITE', 'localhost' );
define( 'PATH_CURRENT_SITE', '/siteA/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );


// Active le mode WP_DEBUG
define( 'WP_DEBUG', true );
 
// Active l’enregistrement dans le fichier /wp-content/debug.log
define( 'WP_DEBUG_LOG', true );
 
// Désactive l’affichage des erreurs et des avertissements
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );
 
// Utiliser les versions en développement des fichiers JS et CSS de base (seulement nécessaire si vous modifiez ces fichiers de base)
define( 'SCRIPT_DEBUG', true );







define('JWT_AUTH_SECRET_KEY', '7/xh%LHH2UB[j+PpVoI0ueM9RGAnJPS~7`-4p;U+Ihs|/Bi3>x_r.[xOqYtW|]AN');
define('JWT_AUTH_CORS_ENABLE', true);

define( 'FS_METHOD', 'direct' );
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'siteA_db' );

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
define( 'AUTH_KEY',         'vQbD!h)g#gH}<ST)V}xNK|AuDPB*d@&nx:IgC.8xxn42;[Y(}w0|;^eOcUPdQs2:' );
define( 'SECURE_AUTH_KEY',  '2|#V?2()SEmm6FC;BFx~[Y{q~zp.sZd5fnq}<Lf:c<F>MADm@#,5R1ej5!/<bLdc' );
define( 'LOGGED_IN_KEY',    'U7<wqRS:]j&%91Zb$mlPhwkexT3U5[kOVy+maqFegvk0jL)i~Qch;$<y~^i>{#8y' );
define( 'NONCE_KEY',        'le%c=oNhPeK2S7|5N=]JpJ[d!L;}uNB^V7lA9Yrc=L)bLtG#VHll)*vsS&MpLml/' );
define( 'AUTH_SALT',        'uR>`d6ER@1Tdz~7RWbYt|^haRLF]1<)WmLO@$#K},&,W8$Xh/naHV4:R$vu!w%ff' );
define( 'SECURE_AUTH_SALT', '>|LsYt:y@<NOH%Sc2#@HrGgcJB L1rE[H)h1C+8*@f7]/Y-7>@x8V-j}dU:?.E;O' );
define( 'LOGGED_IN_SALT',   '~Tzo_I=z;^KkV:+/DyAy3Gr@3zf96Ake;@U= v<%1?qm*nWA6YzjK-([}syL;GPR' );
define( 'NONCE_SALT',       '1Q08q-?iR2Myv7D+nyLE7c=d_/NwD%_n@dV{eioAp:KLMvysKR(X&9EW5us~~-.`' );

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
//define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
