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
define('DB_NAME', 'sadbhaw');

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
define( 'FS_METHOD', 'direct' );


define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'U{+K1lE;N-)kgEp]=GNF&{*OgTMnPWS^u7SGt4t9GnKkuTd:_M]Rp:)E:97Udb_N');
define('SECURE_AUTH_KEY',  'HcvttMkN*oq*!NmHFa<,k7-py*<4@)$.|MITt3#Y*+gGO2A;kT4q&guCJ5>xoJCR');
define('LOGGED_IN_KEY',    'e+JLz+n*Sr2$fr2~[x%^Ey7?&!BhQh:C,^Pno<Q]Rf6>-oyrJ5}wG]&YR@33&CN;');
define('NONCE_KEY',        '}8]QH[H3cF`Xw,g+tr{d>#(R33QCTYOlHQxe5#4%t&d,S1xH/:J#{W2aIdW!tY{x');
define('AUTH_SALT',        'Bx]zz9~$%@E=Q.Q_|_0G^VD=uK39ilG^GZ`OGhUu5=1IOmXB]^<]WQlaf<OTBnPh');
define('SECURE_AUTH_SALT', '&z?yU<wCqA#XGK%Z:;QkP0=U(W9q6)CtKd$1,P{gZmd6gt0]_nQn@.0<$-s*cK-%');
define('LOGGED_IN_SALT',   'BJ- LAG[{N/:lMz3;dx($n~X4c-jNjR&h-[@J;`8x6YDC/[2<^%qS2mcv26c}E_,');
define('NONCE_SALT',       'a~?`|#+{s6(4C`_-*$m#f<EKFI)?=8R e_o/6P-!x34yn%p0fU<9|duq,3fL7{+d');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
