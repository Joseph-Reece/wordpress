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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', '@AttoSoft1@' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'hO?iAW68djQOzL}f+i@!+YPH@o76(^x1]@u!KtQKkR.]i1LLe~Xw@@oW=meD&p+5' );
define( 'SECURE_AUTH_KEY',  'B=@a(>&sOhuA(-de(sN^IUILZ9?/tF~wtR(AeC9YBH1g^0$QOG*|AX${]0C6Lvrv' );
define( 'LOGGED_IN_KEY',    '1)UbP`_qAi6K&GUg=4$$/]/AcM;?v83~i`3m~.eCV#cHk3*XVo>9}8QW+H%)&6:[' );
define( 'NONCE_KEY',        'n;Eg~IY`lQ_2h)ZkvWVu%k*?0^^=VD*R~u[UGo6r02%u%P@5Ztc[;dxr`q*y|4[H' );
define( 'AUTH_SALT',        ':ZX1dL+*g^ Y`Cipq%g6!d$oMq]Sg0U|Zy;TjI%T]{QOkH5yw5Hs%XCy7qgTg;lE' );
define( 'SECURE_AUTH_SALT', 'PzKQu=7%,:S?BOKd29Q<!x_AJ2M*r> 2Xw9HGU22G8(pd!0R{4+9M,7+>]QB]d?%' );
define( 'LOGGED_IN_SALT',   'W(oN_ &/{w|uL_MP{Ot ]:tSQu/!Py_X1O%d| +;x3Z|Jfp/|?wki`tiR(J%n:j5' );
define( 'NONCE_SALT',       'HrmSO^`CKunC*`FJt_SOzJN$VqaI`^W~=ohy3!~H)Ah;$;u:m!EknVSNsnm%rVIu' );

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
