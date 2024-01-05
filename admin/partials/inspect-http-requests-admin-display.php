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

<div class="ets-doc-links">
	<ul>
		<li>
			<a href="https://www.expresstechsoftwares.com/step-by-step-guide-for-inspect-http-requests-wordpress-plugin/" target="_blank">
				<?php esc_html_e( 'Step-by-Step Guide for Inspect HTTP Requests WordPress Plugin', 'inspect-http-requests' ); ?>
			</a>
		</li>
		<li>
			<a href="https://www.expresstechsoftwares.com/discord-add-ons-documentation/" target="_blank">
				<?php esc_html_e( 'Discord Add-ons Documentation', 'inspect-http-requests' ); ?>
			</a>
		</li>
	</ul>
</div>
	</div>
	
	<h1 class="wp-heading-inline"><?php esc_html_e( 'List all the HTTP Requests', 'inspect-http-requests' ); ?></h1
	<hr class="wp-header-end">
	<h2 class="screen-reader-text"><?php esc_html_e( 'Filter HTTP Requests', 'inspect-http-requests' ); ?></h2>
	<div class="tablenav top">
		<div class="alignleft">
			<label class="screen-reader-text" for="ets-inspect-http-requests-valid-url"><?php esc_html_e( 'Add validation for Valid URL', 'inspect-http-requests' ); ?></label>
						<input type="url" name="ets-valid-url" id="ets-inspect-http-requests-valid-url" placeholder="<?php esc_html_e( 'Valid URL', 'inspect-http-requests' ); ?>" value="">
			<input type="submit"  class="button action" id="ets-inspect-http-requests-valid-url-submit" value="<?php esc_html_e( 'Add', 'inspect-http-requests' ); ?>">
						<span class="spinner"></span>
		</div>
		<p class="search-box">
					<span class="spinner"></span>
			<label class="screen-reader-text" for="ets-inspect-http-requests-search-input"><?php esc_html_e( 'Search URL, Request args and Response', 'inspect-http-requests' ); ?></label>			
			<input type="search" id="ets-inspect-http-requests-search-input" name="s" value="">
			<input type="submit" id="ets-inspect-http-requestssearch-submit" class="button" value="<?php esc_html_e( 'Search URL, Request args and Response', 'inspect-http-requests' ); ?>">
		</p>
	<br class="clear">
	</div>
	<table class="wp-list-table widefat fixed striped table-view-list posts"> 
	<thead> 
	<tr> 
		<th scope="col" class="manage-column "><?php esc_html_e( 'ID', 'inspect-http-requests' ); ?></th> 
		<th scope="col" class="manage-column "><?php esc_html_e( 'Block Request', 'inspect-http-requests' ); ?></th> 
		<th scope="col" class="manage-column "><?php esc_html_e( 'URL', 'inspect-http-requests' ); ?></th>         
		<th scope="col" class="manage-column "><?php esc_html_e( 'Request args', 'inspect-http-requests' ); ?></th> 
		<th scope="col"  class="manage-column "><?php esc_html_e( 'Response', 'inspect-http-requests' ); ?></th> 
		<th scope="col"  class="manage-column "><?php esc_html_e( 'Transport', 'inspect-http-requests' ); ?></th>                 
		<th scope="col"  class="manage-column "><?php esc_html_e( 'Runtime', 'inspect-http-requests' ); ?></th> 
		<th scope="col"  class="manage-column "><?php esc_html_e( 'Date', 'inspect-http-requests' ); ?></th> 
		<th scope="col"  class="manage-column "><?php esc_html_e( 'Delete', 'inspect-http-requests' ); ?></th>                 
	</tr>         
	</thead>
	<tbody id="ets-inspect-http-requests-list">
	<?php echo ets_inspect_http_request_get_data(); ?>
		</tbody>
	<table>
</div>

