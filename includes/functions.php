<?php
/*
* common functions file.
*/

function ets_inspect_http_request_get_data (){
	global $wpdb;
	$table_name = $wpdb->prefix . 'ets_wp_outbound_http_requests';
	$sql = "SELECT * FROM {$table_name} ORDER BY `ID` ASC ;";
	$list_urls = $wpdb->get_results( $sql , ARRAY_A );
	$table_list_urls = '<tbody id="the-list">'; 
	foreach ( $list_urls as $list_url ) {
                                    
		$table_list_urls .= '<tr>';  
		$table_list_urls .= '<td><label class="ets-switch"> <input type="checkbox" value="' . $list_url['ID'] . '" /><span class="ets-slider round"></span></label></td>';
		$table_list_urls .= '<td>' . $list_url['URL'] . '</td>';
		$table_list_urls .= '<td>' .  $list_url['request_args']  . '</td>';
		$table_list_urls .= '<td>' . $list_url['response'] . '</td>';
		$table_list_urls .= '<td>' . $list_url['runtime'] . '</td>';        
		$table_list_urls .= '<td>' . date_i18n( get_option( 'date_format' ), strtotime( $list_url['date_added'] ) ) . '</td>';                        
		$table_list_urls .= '</tr>';
	}
	$table_list_urls .= '</tbody>'; 
	$table_list_urls .= '</table>';         
    
	return $table_list_urls;
}
