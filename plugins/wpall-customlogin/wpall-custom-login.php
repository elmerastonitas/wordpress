<?php
/**
 * Plugin Name: WPall CustomLogin
 * Plugin URI: https://github.com/elmerastonitas/wordpress/tree/main/plugins/wpall-customlogin
 * Description: Customize the WordPress login page.
 * Version: 1.0.1
 * Author: Elmer Astonitas
 * Author URI: https://elmerastonitas.com/
 * License: GNU General Public License v3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wpall-customlogin
 * Domain Path: /languages
 * Requires at least: 6.4
 * Requires PHP: 7.4
 */

defined('ABSPATH') || exit;

// Load plugin text domain for translations
function wpall_customlogin_load_textdomain() {
    load_plugin_textdomain('wpall-customlogin', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'wpall_customlogin_load_textdomain');

// Include required files
require_once plugin_dir_path(__FILE__) . 'includes/class-wpall-customlogin.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-login-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-login-helpers.php';

// Initialize the plugin
function wpall_customlogin_init() {
    new WPAll_CustomLogin();
}
add_action('plugins_loaded', 'wpall_customlogin_init');
