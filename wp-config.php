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
define('DB_NAME', 'cos_hgm');

/** MySQL database username */
define('DB_USER', 'general_account');

/** MySQL database password */
define('DB_PASSWORD', "6s9Fw5soPmVg");

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
define('AUTH_KEY',         't1[~2>S7<%r-3$ma<qD uS/#2b)*/3{k~Z}Q#/euu/GTZ>6CW).O/<-K>;-V4ch|');
define('SECURE_AUTH_KEY',  '*zWiMDhxY6pprU<A!ZO@_$l-0p*^_-OUWC{t_13fatho+Y|B(I8;G65]aU=g*k|Z');
define('LOGGED_IN_KEY',    'R *uij1K^VGb](9/&J2i>?%/;M{Yd=Q0D|*p{!$B{<Z-+C*<0zypVH7<p`{!,@t{');
define('NONCE_KEY',        '$P8I-,]%LQ^=z9%c2>V+XkRz|+{&GrAq0jo1gu!I3],-.,IF~IT+SO+Hq0nnzWcv');
define('AUTH_SALT',        ',EiqEq-^pJTzSXTL)@~@ghqaB4hp&7A~s@ uQ|+}-+5i!E;S2mg,FvTvk7hsp$/C');
define('SECURE_AUTH_SALT', '@rqsQ>k`s;y0|s#+SDZ|_&|^jrx2k.%%iE@!?F0k-@[?1_I833,yj5|R %(.]9lV');
define('LOGGED_IN_SALT',   '*+)f1 3q.O#=m+q6UfE95M2rP>Q{uj|4{D~-o0JZ[icK(qBp`nQEmyT4{!sE]k//');
define('NONCE_SALT',       'QeVyTRW_{Jp_y$xE}Ez)fPwZ%rcVmHL|jj~RxNkxDO3z(~_15Ea0fT`|{ Eq4b}t');

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
