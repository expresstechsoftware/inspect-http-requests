<?php
/**
 *
 * @link              https://www.expresstechsoftwares.com
 * @since             1.0.0
 * @package           Inspect_Http_Requests
 *
 * @wordpress-plugin
 * Plugin Name:       Inspect HTTP Requests
 * Plugin URI:        https://www.expresstechsoftwares.com/inspect-http-requests
 * Description:       Monitor all the HTTP Request being made via WP HTTP Methods i.e. wp_remote_get, wp_remote_post Block any request by just a click of button.
 * Version:           1.0.5
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
 */
define( 'INSPECT_HTTP_REQUESTS_VERSION', '1.0.5' );

/**
 * Define plugin directory path
 */
define( 'INSPECT_HTTP_REQUESTS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Define plugin directory url
 */
define( 'INSPECT_HTTP_REQUESTS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_inspect_http_requests() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inspect-http-requests-activator.php';
	Inspect_Http_Requests_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
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
 * @since    1.0.0
 */
function run_inspect_http_requests() {

	$plugin = new Inspect_Http_Requests();
	$plugin->run();

}
run_inspect_http_requests();
