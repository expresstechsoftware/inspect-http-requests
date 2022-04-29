<?php
/*
* common functions file.
*/

function ets_inspect_http_request_get_data ( $search = false ){
	global $wpdb;
	$table_name = $wpdb->prefix . 'ets_wp_outbound_http_requests';
        if( $search === false  ){
		$sql = "SELECT * FROM {$table_name} ORDER BY `ID` ASC ;";
	} else {
		$sql = "SELECT * FROM {$table_name} WHERE `URL` LIKE '%$search%' OR `request_args` LIKE '%$search%' OR `response` LIKE '%$search%'  ORDER BY `ID` ASC ;";            
	}
	$list_urls = $wpdb->get_results( $sql , ARRAY_A );
	$table_list_urls = ''; 
	foreach ( $list_urls as $list_url ) {
		( $list_url['is_blocked'] ) ? $cheked = "checked" : $cheked = '' ;
		$table_list_urls .= '<tr>';  
                $table_list_urls .= '<td>' . $list_url['ID'] . '</td>';
		$table_list_urls .= '<td><label class="ets-switch"> <input ' . $cheked . ' name="ets-block-button" type="checkbox" data-id="' . $list_url['ID'] . '"  /><span class="ets-slider round"></span></label><span class="spinner"></span></td>';
		$table_list_urls .= '<td>' . $list_url['URL'] . '</td>';
		$table_list_urls .= '<td>' .  $list_url['request_args']  . '</td>';
		$table_list_urls .= '<td>' . $list_url['response'] . '</td>';
		$table_list_urls .= '<td>' . $list_url['transport'] . '</td>';                
		$table_list_urls .= '<td>' . round ( $list_url['runtime'] , 4 ) . '</td>';        
		$table_list_urls .= '<td>' . get_date_from_gmt( $list_url['date_added'] , 'Y-m-d H:i:s' ) . '</td>';                        
		$table_list_urls .= '</tr>';
	}
        
    
	return $table_list_urls;
}
