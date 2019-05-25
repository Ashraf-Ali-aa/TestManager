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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define('AUTH_KEY',         'EE6cM49Kn331mdBcR+cQCmWrEO1NyRQEASMHI1wepTLETRU5HmvV2GWeOkT2frZM2ExCW7F91QvTXTQnB53pIQ==');
define('SECURE_AUTH_KEY',  'hYFG4FETMAzzX6QPlLxp0J+ZDj16LDMHltk2kl1llJxmp4jCz54K8x1txbctxnoVHRxkg9GIWukwsPjFtcB8ZQ==');
define('LOGGED_IN_KEY',    'guxM0rsDNWNmeTaXakDJhPBcgKmWNRFAUWghiJ8c9KOoTbuAD6I/9YG0Pt6xpnx21Bz+ca2qjzCDoYirprbFNw==');
define('NONCE_KEY',        'X+pG34erbio/0S+t0VPoo/HzoFODEX63fxFQua4WBKFQw5hQOwsGDxHGG8Gzo/zgr4iZ2IctB2dYtHebhHyz8w==');
define('AUTH_SALT',        'jLrqSXqFvthGpmvK8xupw+I0t64dA87GXfoIgrtRICqZg2fqKT/0ZiZXyKFJDVvu0E1Gd4eNwi8vTaARjSxy0A==');
define('SECURE_AUTH_SALT', '0T6XeLwT2Xg4Hq8A+e9pXx6G4CmqeyQYiZ/27xoPHemsHCSYbEhlnoXz6ys9Koro6oaIyWo/tRRov0kSkjRPsg==');
define('LOGGED_IN_SALT',   'YI7oRMdkD8n5IgRbGBgrJ3uexP3kD7mS+SzwdGMHZc2qeuosmP4mZz4UHiOm9HY1dePrcsttq9EfBZph6K6Aog==');
define('NONCE_SALT',       'lCEL6b4PYQ/g1TjnapgCQaBHoBWO+l5257mBL/VMiYFJB/6T3N1lN7jkaYlWEW6ujedmNBIq6rmkuiKHnOu+Yg==');

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
