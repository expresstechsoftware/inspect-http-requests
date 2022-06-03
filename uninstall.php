<?php

/**
 * Fired when the plugin is uninstalled.
 * @link       https://www.expresstechsoftwares.com
 * @since      1.0.0
 *
 * @package    Inspect_Http_Requests
 */

// If uninstall not called from WordPress, then exit.
if ( defined( 'WP_UNINSTALL_PLUGIN' )
		&& $_REQUEST['plugin'] == 'inspect-http-requests/inspect-http-requests.php'
		&& $_REQUEST['slug'] == 'inspect-http-requests'
	&& wp_verify_nonce( $_REQUEST['_ajax_nonce'], 'updates' )
  ) {
	global $wpdb;
  $table_name = $wpdb->prefix . 'ets_wp_outbound_http_requests';  
  $sql = "DROP TABLE IF EXISTS $table_name;";
  $wpdb->query($sql);
}


