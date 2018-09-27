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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'femmes_de_papier' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Axelamour1' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'F&H9YrDLH{HH7/M+}^^P%}J||le5aJ^([BiN^Wgt@EB?*.jvE:FAg{h>@QpElxuT' );
define( 'SECURE_AUTH_KEY',   'B;O&&RB+uCVor;uy;_:5q%+u5S[,R38<ziidAEhtNE8C<?Z/:~prSQUW~yG?dguF' );
define( 'LOGGED_IN_KEY',     'QTsV74a &fC&]*@U{caGC*8$)?bVjZ$usGd?bGq)Bm@/no;|NG_+k?9Lk@3YGJ;V' );
define( 'NONCE_KEY',         'V#:ohc-4[m<WZSij,EcvJH)zK,MtHyrFW%}oexp_D %M}w_Z)k;47gMu2hynVC2r' );
define( 'AUTH_SALT',         '{u]Am;FDKaxv.I{pu?Mr(<|))ip%7`CCcQ<F4i Dl`D?%hQ$s`],*^G,k>dWAt!y' );
define( 'SECURE_AUTH_SALT',  '4:GyPwrx~J!^:8b2Fxd8kjLm2q>jnkHskd{<JhSLKn1F7 {KBo}_Kar_6*C=@J(h' );
define( 'LOGGED_IN_SALT',    'pX|(fOWQ-*.xX@wBon!%L9RC cMX5O$%G+J-l5uT?/Lu,s#.3>pQDC69=e&;KPSc' );
define( 'NONCE_SALT',        '<w5~)@00E/&?DfX`?&s(m,(kcKtQioj|Q04`jf+Q,gh>:(d4]t@|qm3B[(BW@~+A' );
define( 'WP_CACHE_KEY_SALT', 'cK.gc%%XXG=g}ID*+.=iw Vn{GAk{o7#`@.Bg+<57Xx69|V+ErY>TmW6ZM7L%8~j' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
