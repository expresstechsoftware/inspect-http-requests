<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.expresstechsoftwares.com
 * @since      1.0.0
 *
 * @package    Inspect_Http_Requests
 * @subpackage Inspect_Http_Requests/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inspect_Http_Requests
 * @subpackage Inspect_Http_Requests/admin
 * @author     ExpressTech Softwares Solutions Pvt Ltd <contact@expresstechsoftwares.com>
 */
class Inspect_Http_Requests_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Inspect_Http_Requests_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Inspect_Http_Requests_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/inspect-http-requests-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Inspect_Http_Requests_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Inspect_Http_Requests_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/inspect-http-requests-admin.js', array( 'jquery' ), $this->version, false );
		$script_params = array(
			'admin_ajax'                       => admin_url( 'admin-ajax.php' ),
			'is_admin'                         => is_admin(),
			'ets_inspect_http_requests_nonce' => wp_create_nonce( 'ets-inspect-http-requests-ajax-nonce' ),
		);
		wp_localize_script( $this->plugin_name, 'etsInspectHttpRequestsParams', $script_params );                 

	}

	/**
	 * Method to add inspect http requests sub-menu under WP Top-level menu Tools
	 *
	 * @since    1.0.0
	 */        
	public function ets_inspect_http_requests_add_tools_menu() {
		add_submenu_page ( 'tools.php' ,  __( 'Inspect HTTP Request', 'inspect-http-requests' ) , __( 'Inspect HTTP Request', 'inspect-http-requests' ), 'manage_options', 'inspect-http-requests', array( $this, 'ets_inspect_http_requests_tools_page' ) );
            
	}

	/**
	 * Callback to display all the HTTP Requests being made.
	 *
	 * @since    1.0.0
	 */        
	public function ets_inspect_http_requests_tools_page() {
		if ( ! current_user_can( 'administrator' ) ) {
			wp_send_json_error( 'You do not have sufficient rights', 403 );
			exit();
		}
             
		require_once INSPECT_HTTP_REQUESTS_PLUGIN_DIR_PATH . 'admin/partials/inspect-http-requests-admin-display.php';           
        }

	/**
	 * Capture the request and save it inside the DB table.
	 *
	 * @since    1.0.0
         * 
         * @param type $response
	 */	
	public function ets_inspect_http_requests_capture_request( $response, $context, $transport, $args, $url ) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'ets_wp_outbound_http_requests';
                
		$request_args = json_encode( $args );
		$runtime = $args['timeout'];
		$http_api_call_data = array(
			'URL' => sanitize_url ( $url ),
			'request_args' => $request_args,
			'response' => json_encode( $response ),
			'runtime' => $runtime,
			'date_added' => date('Y-m-d H:i:s'),
			'is_blocked' => 0                    
			);
		if( ! $wpdb->insert( $table_name, $http_api_call_data ) ){    
			$wpdb->print_error();
		}                
	}

	/**
	 * Update Satatus URL.
	 *
	 * @since    1.0.0
         *
	 */
	public function ets_inspect_http_requests_update_status_url( ) {
            
		global $wpdb;
		$table_name = $wpdb->prefix . 'ets_wp_outbound_http_requests';                
		if ( ! current_user_can( 'administrator' ) ) {
			wp_send_json_error( 'You do not have sufficient rights', 403 );
			exit();
		}
		// Check for nonce security
		if ( ! wp_verify_nonce( $_POST['ets_inspect_http_requests_nonce'], 'ets-inspect-http-requests-ajax-nonce' ) ) {
			wp_send_json_error( 'You do not have sufficient rights', 403 );
			exit();
		}
                
		if( $_POST['ets_checked'] == 'true'){
			$ets_checked =  1;
		} else {
			$ets_checked =  0;
		}
               
		$update_sql = $wpdb->prepare( " UPDATE `{$table_name}` SET `is_blocked` = %s WHERE `ID` =%d;" ,$ets_checked, $_POST['ets_url_id'] );
		if( $wpdb->query( $update_sql ) ){
			echo json_encode(['re' => 'yes']);
		} else {
			$wpdb->print_error();
		}                
		exit();                
//		$data = array(
//			'is_blocked' =>  $ets_checked
//                        );
//		$where = ['ID' => $_POST['ets_url_id'] ];
//                        
//		if( $wpdb->update( $table_name, $data, $where )){
//			echo json_encode(['re' => 'yes']);
//		} else {
//			$wpdb->print_error();
//		}                

	}
}        
