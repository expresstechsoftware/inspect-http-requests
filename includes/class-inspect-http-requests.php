<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Inspect_Http_Requests
 * @subpackage Inspect_Http_Requests/includes
 * @author     ExpressTech Softwares Solutions Pvt Ltd <contact@expresstechsoftwares.com>
 */
class Inspect_Http_Requests {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Inspect_Http_Requests_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'INSPECT_HTTP_REQUESTS_VERSION' ) ) {
			$this->version = INSPECT_HTTP_REQUESTS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'inspect-http-requests';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Inspect_Http_Requests_Loader. Orchestrates the hooks of the plugin.
	 * - Inspect_Http_Requests_i18n. Defines internationalization functionality.
	 * - Inspect_Http_Requests_Admin. Defines all hooks for the admin area.
	 * - Inspect_Http_Requests_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions.php';            

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-inspect-http-requests-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-inspect-http-requests-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-inspect-http-requests-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-inspect-http-requests-public.php';

		$this->loader = new Inspect_Http_Requests_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Inspect_Http_Requests_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Inspect_Http_Requests_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Inspect_Http_Requests_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'ets_inspect_http_requests_add_tools_menu' );                
		$this->loader->add_action( 'http_api_debug', $plugin_admin, 'ets_inspect_http_requests_capture_request', 10, 5 );                                
		$this->loader->add_action( 'wp_ajax_ets_inspect_http_requests_update_status_url', $plugin_admin, 'ets_inspect_http_requests_update_status_url' );                                                                                                                
		$this->loader->add_filter( 'pre_http_request', $plugin_admin, 'ets_inspect_http_requests_approved_requests', 10, 3 );                
		$this->loader->add_filter( 'ets_inspect_http_requests_ignore_hostname', $plugin_admin, 'ets_inspect_http_requests_ignore_specific_hostname', 10, 1 );                                
		$this->loader->add_filter( 'http_request_args', $plugin_admin, 'ets_inspect_http_requests_get_runtime', 10, 1 );                                                
		$this->loader->add_action( 'wp_ajax_ets_inspect_http_requests_search', $plugin_admin, 'ets_inspect_http_requests_search' );                                                                                                                                
		$this->loader->add_action( 'wp_ajax_ets_inspect_http_requests_add_valid_url', $plugin_admin, 'ets_inspect_http_requests_add_valid_url' );                                                                                                                                                

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Inspect_Http_Requests_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
