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
define('JWT_AUTH_SECRET_KEY', '7/xh%LHH2UB[j+PpVoI0ueM9RGAnJPS~7`-4p;U+Ihs|/Bi3>x_r.[xOqYtW|]AN');
define('JWT_AUTH_CORS_ENABLE', true);

define( 'FS_METHOD', 'direct' );
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'siteB_db' );

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
define( 'AUTH_KEY',         '|3Fd276Gmt_!i/u<#);(>9xu}*|$AU~_/K.mAVU5g*X6RxkYhx20I<3a*,U^Jj(q' );
define( 'SECURE_AUTH_KEY',  ':`.]AsjzPuH20R!!8E*Q}p)h}!Hwbrzt-sz]$MEI}tV;5pVN7G+PYTkS%GDu8k;_' );
define( 'LOGGED_IN_KEY',    'R{TPo3aZ0ttk,+j?]Q>1oF2l-OwxvPXq!`.yXQTjgE_FH[2kMqS`ZGlg@ysN,2}.' );
define( 'NONCE_KEY',        'xm]z=Pn%fsdhprVZZ0Cd+ #.^?^SeyG# z!3Uh~{=Z:6QXI`.o(c}dnirrYxpS<m' );
define( 'AUTH_SALT',        'c+9r:Vq],~|LIes]3-i`S=SFkb9]Q0JU}Ho_SI+(^g}vD] {f ;R0lu6U XYc{pT' );
define( 'SECURE_AUTH_SALT', 'Zp|-N&.tky2y%h&`+unbL.0OL&_N,{ r[O;blb^E/5`Ei{bYjt_4<QUR^} H[hio' );
define( 'LOGGED_IN_SALT',   '$C~`Ta])OY%d{]j jY<hR~XgzSk>r7Ka7!)w_9XjE#Ix76,nJtpmI#]N_hW<1mP4' );
define( 'NONCE_SALT',       '~2Ng|%td5z+RcYQKaxLN86Ssf[ib`F}.Dj(3BW|?MeO8jC;PR(QtniB@H=-R&*]W' );

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
