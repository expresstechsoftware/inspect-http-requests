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
<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'List all the HTTP Requests', 'inspect-http-requests' ) ?></h1
    <hr class="wp-header-end">
    <h2 class="screen-reader-text"><?php esc_html_e( 'Filter HTTP Requests', 'inspect-http-requests' ) ?></h2>
    <div class="tablenav top">
        <div class="alignleft actions bulkactions">
            <label for="" class="screen-reader-text"><?php esc_html_e( 'Select bulk action', 'inspect-http-requests' ) ?></label>
            <select name="action" id="">
                <option value="-1">Bulk actions</option>
                <option value="----">----</option>
                <option value="----">----</option>
            </select>
            <input type="submit" id="doaction" class="button action" value="Apply">
        </div>
        <div class="alignleft actions">
            <label for="filter-by-date" class="screen-reader-text"><?php esc_html_e( 'Filter by date', 'inspect-http-requests' ) ?></label>
            <select name="m" id="filter-by-date">
                <option selected="selected" value="0">All dates</option>
		<option value="----">---</option>
                <option value="---">---</option>
		</select>
		<label class="screen-reader-text" for="cat"><?php esc_html_e( 'Filter by URL', 'inspect-http-requests' ) ?></label>
                <select name="url" id="url" class="postform">
                    <option value="0"><?php esc_html_e( 'All URLs', 'inspect-http-requests' ) ?></option>
                    <option class="level-" value="">----</option>
                </select>
                <input type="submit" name="" id="" class="button" value="<?php esc_html_e( 'Filter', 'inspect-http-requests' ) ?>">		
        </div>
        <br class="clear">
	</div>
	 <table class="wp-list-table widefat fixed striped table-view-list posts"> 
	 <thead> 
	 <tr> 
             <th scope="col" class="manage-column "><?php esc_html_e( 'ID', 'inspect-http-requests' ) ?></th> 
             <th scope="col" class="manage-column "><?php esc_html_e( 'URL', 'inspect-http-requests' ) ?></th>         
             <th scope="col" class="manage-column "><?php esc_html_e( 'Request args', 'inspect-http-requests' ) ?></th> 
             <th scope="col"  class="manage-column "><?php esc_html_e( 'Response', 'inspect-http-requests' ) ?></th> 
             <th scope="col"  class="manage-column "><?php esc_html_e( 'Runtime', 'inspect-http-requests' ) ?></th> 
             <th scope="col"  class="manage-column "><?php esc_html_e( 'Date', 'inspect-http-requests' ) ?></th> 
	 </tr>         
	 </thead>
         <?php echo ets_inspect_http_request_get_data()?>
</div>

