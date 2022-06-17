<?php
/*
* common functions file.
*/

function ets_inspect_http_request_get_data( $search = false ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'ets_wp_outbound_http_requests';
	if ( $search === false ) {
		$sql = "SELECT * FROM {$table_name} ORDER BY `ID` ASC ;";
	} else {
		$sql = "SELECT * FROM {$table_name} WHERE `URL` LIKE '%$search%' OR `request_args` LIKE '%$search%' OR `response` LIKE '%$search%'  ORDER BY `ID` ASC ;";
	}
	$list_urls       = $wpdb->get_results( $sql, ARRAY_A );
	$table_list_urls = '';
	foreach ( $list_urls as $list_url ) {
		( $list_url['is_blocked'] ) ? $cheked = "checked" : $cheked = '' ;
		$table_list_urls .= '<tr>';  
		$table_list_urls .= '<td>' . $list_url['ID'] . '</td>';
		$table_list_urls .= '<td><label class="ets-switch"> <input ' . $cheked . ' name="ets-block-button" type="checkbox" data-id="' . $list_url['ID'] . '"  /><span class="ets-slider round"></span></label><span class="spinner"></span></td>';
		$table_list_urls .= '<td>' . $list_url['URL'] . '</td>';
		$table_list_urls .= '<td class="ets-request-args">' .  ets_format_json_request_args ( $list_url['request_args'] ) . '</td>';
		$table_list_urls .= '<td class="ets-response-args">' . ets_format_json_response ( $list_url['response'] ) . '</td>';
		$table_list_urls .= '<td>' . $list_url['transport'] . '</td>';
		$table_list_urls .= '<td>' . round ( (float)$list_url['runtime'] , 4 ) . '</td>';        
		$table_list_urls .= '<td>' . get_date_from_gmt( $list_url['date_added'] , 'Y-m-d H:i:s' ) . '</td>';                        
 		$table_list_urls .= '<td><span data-id="' . $list_url['ID'] . '" class="delete-url  dashicons dashicons-editor-removeformatting"></span><span class="spinner"></span></td>';                                       
		$table_list_urls .= '</tr>';
	}

	return $table_list_urls;
}

function ets_inspect_http_request_check_duplicate_url( $url ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'ets_wp_outbound_http_requests';

	$sql_query = "SELECT count(`ID`) AS c FROM `{$table_name}` WHERE LOWER(`URL`) = '" . strtolower( trim( $url ) ) . "' ;";

	$result = $wpdb->get_results( $sql_query, ARRAY_A );

	if ( is_array( $result ) && isset( $result[0]['c'] ) && $result[0]['c'] >= 1 ) {
		return true;
	} else {
		return false;
	}

}

function ets_inspect_http_request_log_blocked_url( $url ) {
	if ( true === WP_DEBUG ) {
		error_log( $url );
	}
}

function ets_inspect_http_request_get_blocked_url( $id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'ets_wp_outbound_http_requests';
	$url_sql = "SELECT `URL` AS url FROM `{$table_name}`  WHERE `ID` =" . $id . ";";
	$the_url = $wpdb->get_results( $url_sql , ARRAY_A );
	if( is_array( $the_url ) && isset( $the_url[0]['url'] ) ){
		return $the_url[0]['url'];
	} else {
		return false;
	}     
}
function ets_format_json_request_args ( $request_args ){
    
	$request_args = json_decode( $request_args );
	if( ! is_object ( $request_args ) ) {
		return;
	}
//        foreach ($request_args->headers as $key => $value) {
//echo '<pre>';
//
//echo $key .' =>' . $value;
//}
//echo '</pre>';
	$reject_unsafe_urls = ( $request_args->reject_unsafe_urls ) ? 'true' : 'false';
	$blocking = ( $request_args->blocking ) ? 'true' : 'false';        
	$request_args_html = '<ul>';
	$request_args_html .= '<li><span>"method":"' . $request_args->method . '"</span></li>';
	$request_args_html .= '<li><span>"timeout":"' . $request_args->timeout . '"</span></li>';    
	$request_args_html .= '<li><span>"redirection":"' . $request_args->redirection . '"</span></li>';        
	$request_args_html .= '<li><span>"httpversion":"' . $request_args->httpversion . '"</span></li>';            
	$request_args_html .= '<li><span>"user-agent":"' . $request_args->{'user-agent'} . '"</span></li>';                
	$request_args_html .= '<li><span>"reject_unsafe_urls":"' . $reject_unsafe_urls . '"</span>';                
	$request_args_html .= '<li><span>"blocking":"' . $blocking . '"</span>';  
	if( is_object( $request_args->headers ) ){
		$request_args_html .= '<li><span>"headers":'; 
		foreach ($request_args->headers as $key => $value) {
			$request_args_html .= '<span>"'.$key.'":"'.$value.'"</span><br>';    
		}
		$request_args_html .= '"</span></li>';
	}
	if( is_array( $request_args->cookies ) ){    
		$request_args_html .= '<li><span>"cookies":';
		foreach ( $request_args->cookies as $key => $value )  {
			$request_args_html .= '<span>"'.$key.'":"'.$value.'"</span><br>';    
		}
		$request_args_html .= '"</span></li>';
	}        
	$request_args_html .= '</ul>';
	
	return $request_args_html;
    
    
}
function ets_format_json_response ( $response ){
//    echo '<pre>';
//    var_dump(json_decode($response));
//    echo '</pre>';
    return;
    $response = json_decode($response);
    if (is_object( $response )){
        
        foreach ( $response as $key => $value) {
            if (is_object($value) || is_array ($value)){
                foreach ($value as $k => $v) {
                    if (is_object($v) || is_array ($v)){
                        foreach ($v as $ki => $va) {
                            return $ki . '"=>"' . $va . '<br>';
                        }
                    } else{
                     return $k . '"=>"' . $v . '<br>';
                    }
                }
            } else{
                 return $key . '"=>"' . $value . '<br>';
            }
           
        }
    }
}

