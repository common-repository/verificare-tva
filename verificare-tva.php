<?php
/**
 * The plugin init file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/verificare-tva
 * @since             1.0.0
 * @package           TheBugTvaCore
 *
 * @wordpress-plugin
 * Plugin Name:       Verificare TVA
 * Plugin URI:        https://wordpress.org/plugins/verificare-tva
 * Description:       Acest plugin crează un widget pe care îl puteți afișa pe site-ul dvs. și care le permite vizitatorilor să verifice starea TVA a unei companii din România, la o anumită dată.
 * Version:           1.0.2
 * Author:            The Bug Software Development & Consulting S.R.L.
 * Author URI:        https://thebug.io
 * License:           GPLv2 or later
 * Text Domain:       verificare-tva
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 *
 * Plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define('TVA_CORE_VERSION', '1.0.2');

/**
 * Current file.
 */
define('TVA_CORE_ROOT_FILE', __FILE__);

/**
 * Plugin path
 */
define('TVA_CORE_PATH', plugin_dir_path(__FILE__));

/**
 * Define the plugin name
 */
define('TVA_CORE_NAME', 'verificare_tva');

/**
 * Define the plugin base name
 */
define('TVA_CORE_BASE_NAME', plugin_basename(__FILE__));

/**
 * Load composer autoload class.
 */
require_once TVA_CORE_PATH . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Boot the app
|--------------------------------------------------------------------------
|
*/
$phpCheck = TheBugTva\Core\WPUpdatePhp::check('5.5');
$wpCheck  = TheBugTva\Core\WPUpdate::check('4.7.0');

if ($phpCheck && $wpCheck) {
    (new TheBugTvaCore\App(__FILE__))->boot();
}
