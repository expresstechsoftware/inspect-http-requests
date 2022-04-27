<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.expresstechsoftwares.com
 * @since      1.0.0
 *
 * @package    Inspect_Http_Requests
 * @subpackage Inspect_Http_Requests/admin/partials
 */
?>
<div class="wrap ets-inspect-http-requests">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'List all the HTTP Requests', 'inspect-http-requests' ) ?></h1
	<hr class="wp-header-end">
	<h2 class="screen-reader-text"><?php esc_html_e( 'Filter HTTP Requests', 'inspect-http-requests' ) ?></h2>
	<div class="tablenav top">
	<br class="clear">
	</div>
	<table class="wp-list-table widefat fixed striped table-view-list posts"> 
	<thead> 
	<tr> 
		<th scope="col" class="manage-column "></th> 
		<th scope="col" class="manage-column "><?php esc_html_e( 'URL', 'inspect-http-requests' ) ?></th>         
		<th scope="col" class="manage-column "><?php esc_html_e( 'Request args', 'inspect-http-requests' ) ?></th> 
		<th scope="col"  class="manage-column "><?php esc_html_e( 'Response', 'inspect-http-requests' ) ?></th> 
		<th scope="col"  class="manage-column "><?php esc_html_e( 'Runtime', 'inspect-http-requests' ) ?></th> 
		<th scope="col"  class="manage-column "><?php esc_html_e( 'Date', 'inspect-http-requests' ) ?></th> 
	</tr>         
	</thead>
	<?php echo ets_inspect_http_request_get_data()?>
</div>

