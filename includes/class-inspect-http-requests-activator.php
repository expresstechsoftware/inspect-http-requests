<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Inspect_Http_Requests
 * @subpackage Inspect_Http_Requests/includes
 * @author     ExpressTech Softwares Solutions Pvt Ltd <contact@expresstechsoftwares.com>
 */
class Inspect_Http_Requests_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name = $wpdb->prefix . 'ets_wp_outbound_http_requests';  
		$outbound_http_requests_sql = "CREATE TABLE IF NOT EXISTS $table_name (
			ID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                        URL longtext,
                        request_args longtext,
                        response longtext,
                        transport longtext,
                        runtime longtext,
                        date_added datetime,
                        is_blocked tinyint(1),
			UNIQUE KEY id (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $outbound_http_requests_sql );
	}

}
