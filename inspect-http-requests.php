<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.expresstechsoftwares.com
 * @since             1.0.0
 * @package           Inspect_Http_Requests
 *
 * @wordpress-plugin
 * Plugin Name:       Inspect HTTP Requests
 * Plugin URI:        https://www.expresstechsoftwares.com/inspect-http-requests
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            ExpressTech Softwares Solutions Pvt Ltd
 * Author URI:        https://www.expresstechsoftwares.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       inspect-http-requests
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'INSPECT_HTTP_REQUESTS_VERSION', '1.0.0' );

/**
 * Define plugin directory path
 */
define( 'INSPECT_HTTP_REQUESTS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-inspect-http-requests-activator.php
 */
function activate_inspect_http_requests() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inspect-http-requests-activator.php';
	Inspect_Http_Requests_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-inspect-http-requests-deactivator.php
 */
function deactivate_inspect_http_requests() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inspect-http-requests-deactivator.php';
	Inspect_Http_Requests_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_inspect_http_requests' );
register_deactivation_hook( __FILE__, 'deactivate_inspect_http_requests' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-inspect-http-requests.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_inspect_http_requests() {

	$plugin = new Inspect_Http_Requests();
	$plugin->run();

}
run_inspect_http_requests();
