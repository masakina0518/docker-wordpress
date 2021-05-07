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

// Load Dotenv
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

/** サイトアドレス (URL) */
define( 'WP_HOME', getenv('WP_HTTP_HOST') );

/** WordPress アドレス (URL) */
define( 'WP_SITEURL', getenv('WP_HTTP_HOST'). 'core' );

/** DEBUG */
define( 'WP_DEBUG', filter_var(getenv('WP_DEBUG_ON'), FILTER_VALIDATE_BOOLEAN) );
define( 'WP_DEBUG_DISPLAY', filter_var(getenv('WP_DEBUG_DISPLAY_ON'), FILTER_VALIDATE_BOOLEAN) );
define( 'WP_DEBUG_LOG', getenv('WP_DEBUG_LOG') );

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv('WP_DB_NAME') );

/** MySQL database username */
define( 'DB_USER', getenv('WP_DB_USER') );

/** MySQL database password */
define( 'DB_PASSWORD', getenv('WP_DB_PASSWORD') );

/** MySQL hostname */
define( 'DB_HOST', getenv('WP_DB_HOST') );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', getenv('WP_DB_CHARSET') );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv('WP_DB_COLLATE') );

/** wp-cron.php呼び出し無効(タスク実行による呼び出しに変更) */
define('DISABLE_WP_CRON', 'true');

/** 自動更新を停止 */
define( 'AUTOMATIC_UPDATER_DISABLED', true );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          getenv('WP_AUTH_KEY') );
define( 'SECURE_AUTH_KEY',   getenv('WP_SECURE_AUTH_KEY') );
define( 'LOGGED_IN_KEY',     getenv('WP_LOGGED_IN_KEY') );
define( 'NONCE_KEY',         getenv('WP_NONCE_KEY') );
define( 'AUTH_SALT',         getenv('WP_AUTH_SALT') );
define( 'SECURE_AUTH_SALT',  getenv('WP_SECURE_AUTH_SALT') );
define( 'LOGGED_IN_SALT',    getenv('WP_LOGGED_IN_SALT') );
define( 'NONCE_SALT',        getenv('WP_NONCE_SALT') );
define( 'WP_CACHE_KEY_SALT', getenv('WP_WP_CACHE_KEY_SALT') );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/**
 * Custom contents dir
 */
define( 'WP_CONTENT_DIR', dirname(__FILE__) . '/contents' );
define( 'WP_CONTENT_URL', getenv('WP_HTTP_HOST') . 'contents');

/**
 * Custom plugin dir
 */
define( 'WP_PLUGIN_DIR', dirname(__FILE__) . '/core/wp-content/plugins' );
define( 'WP_PLUGIN_URL', getenv('WP_HTTP_HOST') . 'core/wp-content/plugins');
define( 'PLUGINDIR', dirname(__FILE__) . '/core/wp-content/plugins' );

/**
 * Custom upload dir
 */
define( 'UPLOADS', 'wp-content/media' );

/**
 * Custom lang dir
 */
define( 'WP_LANG_DIR', dirname(__FILE__) . '/core/wp-content/languages' );

/**
 * WP-MAIL_SMTP Settings.
 */
define( 'WPMS_ON', filter_var(getenv('WP_WPMS_ON'), FILTER_VALIDATE_BOOLEAN) );

define( 'WPMS_MAIL_FROM', getenv('WP_WPMS_MAIL_FROM') );
define( 'WPMS_MAIL_FROM_NAME', getenv('WP_WPMS_MAIL_FROM_NAME') );
define( 'WPMS_MAILER', getenv('WP_WPMS_MAILER') );
define( 'WPMS_SET_RETURN_PATH',  (filter_var(getenv('WP_WPMS_SET_RETURN_PATH'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0));
define( 'WPMS_MAIL_FROM_NAME_FORCE', (filter_var(getenv('WP_WPMS_MAIL_FROM_NAME_FORCE'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0));
define( 'WPMS_MAIL_FROM_FORCE', (filter_var(getenv('WP_WPMS_MAIL_FROM_FORCE'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0));

define( 'WPMS_SMTP_HOST', getenv('WP_WPMS_SMTP_HOST') );
define( 'WPMS_SMTP_PORT', getenv('WP_WPMS_SMTP_PORT') );
define( 'WPMS_SSL', getenv('WP_WPMS_SSL') );
define( 'WPMS_SMTP_AUTH', (filter_var(getenv('WP_WPMS_SMTP_AUTH'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0));
define( 'WPMS_SMTP_AUTOTLS', (filter_var(getenv('WP_WPMS_SMTP_AUTOTLS'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0) );
define( 'WPMS_SMTP_USER', getenv('WP_WPMS_SMTP_USER') );
define( 'WPMS_SMTP_PASS', getenv('WP_WPMS_SMTP_PASS') );

/**
 * Amazon-aws-s3-and-cloudflont Setting
 *
 * @link https://deliciousbrains.com/wp-offload-media/doc/settings-constants/
 */
define( 'AS3CF_SETTINGS', serialize( array(
    'provider' => 'aws',
    'access-key-id' => getenv('WP_S3_ACCESS_KEY_ID'),
    'secret-access-key' => getenv('WP_S3_SECRET_ACCESS_KEY'),
    'use-server-roles' => filter_var(getenv('WP_S3_USE_SERVER_ROLES'), FILTER_VALIDATE_BOOLEAN),
    'region' => 'ap-northeast-1',
    'bucket' => getenv('WP_S3_BUCKET'),
    'copy-to-s3' => true,
    'serve-from-s3' => true,
    'domain' => getenv('WP_S3_DOMAIN'),
    'cloudfront' => getenv('WP_S3_CLOUDFRONT'),
    'enable-object-prefix' => filter_var(getenv('WP_S3_ENABLE_OBJECT_PREFIX'), FILTER_VALIDATE_BOOLEAN),
    'object-prefix' => getenv('WP_S3_OBJECT_PREFIX'),
    'use-yearmonth-folders' => false,
    'remove-local-file' => true,
    'force-https' => filter_var(getenv('WP_S3_FORCE_HTTPS'), FILTER_VALIDATE_BOOLEAN),
    'object-versioning' => false
) ) );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
