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
		$table_list_urls .= '<td class="ets-request-args">' . ets_format_json_request_args( $list_url['request_args'] )  . '</td>';
		$table_list_urls .= '<td class="ets-response-args">' . ets_format_json_response( $list_url['response'] ) . '</td>';
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
function ets_get_formatted_json( $request_args, &$html='' ) {

//		if( is_object( json_decode ( $request_args ) ) ){
//
//			foreach( json_decode( $request_args)  as $key => $value ) {
//				if ( is_object( $value ) ) {
//					ets_get_formatted_json( $value ,$html ); 
//            
//				} else { 
//					if( is_array( $value ) ){
//                                            //
//					} else{
//						$html .= '<div><b>' . $key . ':</b>' . $value.'</div>';
//					}
//				}
//			}
//		}
//	return $html;
}
function ets_format_json_request_args ( $request_args ){
    
	$request_args = json_decode( $request_args );
	if( ! is_object ( $request_args ) ) {
		return;
	}
	$reject_unsafe_urls = ( $request_args->reject_unsafe_urls ) ? 'true' : 'false';
	$blocking = ( $request_args->blocking ) ? 'true' : 'false'; 
	$compress = ( $request_args->compress ) ? 'true' : 'false'; 
	$decompress = ( $request_args->decompress ) ? 'true' : 'false';         
	$sslverify = ( $request_args->sslverify ) ? 'true' : 'false';                 
	$stream = ( $request_args->stream ) ? 'true' : 'false'; 
	$filename = ( is_null( $request_args->filename ) ) ? 'Null' : $request_args->filename;
	$limit_response_size = ( is_null( $request_args->limit_response_size ) ) ? 'Null' : $request_args->limit_response_size;         
	$_redirection = ( is_null( $request_args->_redirection ) ) ? 'Null' : $request_args->_redirection;                 
	
	$request_args_html = '<span class="ets-arrow dashicons dashicons-arrow-down"></span><div class="ets-pop"></div><ul style="display: none;">';
	$request_args_html .= '<li><b>method : </b>' . $request_args->method . '</li>';
	$request_args_html .= '<li><b>timeout : </b>' . $request_args->timeout . '</li>';    
	$request_args_html .= '<li><b>redirection : </b>' . $request_args->redirection . '</li>';        
	$request_args_html .= '<li><b>httpversion</b>' . $request_args->httpversion . '</li>';            
	$request_args_html .= '<li><b>user-agent : </b>' . $request_args->{'user-agent'} . '</li>';                
	$request_args_html .= '<li><b>reject_unsafe_urls : </b>' . $reject_unsafe_urls . '</li>';                
	$request_args_html .= '<li><b>blocking : </b>' . $blocking . '</li>';  
	if( is_object( $request_args->headers ) || is_array ( $request_args->headers ) ){
		$request_args_html .= '<li><b>headers : </b>'; 
		foreach ($request_args->headers as $key => $value) {
			$request_args_html .=  $key .' : ' . $value ;    
		}
		$request_args_html .= '"</b></li>';
	}
	if( is_array( $request_args->cookies ) || is_object( $request_args->cookies ) ){    
		$request_args_html .= '<li><b>cookies : </b>';
		foreach ( $request_args->cookies as $key => $value )  {
			$request_args_html .= $key.'  :  '.$value;    
		}
		$request_args_html .= '</li>';
	}
	if ( ! is_null( $request_args->body ) ){
		$request_args_html .= '<li><b>body : </b>';
		if ( is_object( $request_args->body ) ){
			foreach ( $request_args->body as $key => $value ) {
				$request_args_html .= $key .'  :  ' . $value;    
			}
		} else if( is_array( $request_args->body ) ) {
			foreach ( $request_args->body as $key => $value ) {
				$request_args_html .= $key .'  :  ' . $value;    
			}
		} else if ( is_object( json_decode( $request_args->body ) ) ){
			foreach ( json_decode( $request_args->body ) as $key => $value ) {
				$request_args_html .=  $key .' : ' . $value;    
			}              
		}
		$request_args_html .= '</li>'; 
	}
	$request_args_html .= '<li><b>compress : </b>' . $compress . '</li>';          
	$request_args_html .= '<li><b>decompress : </b>' . $decompress . '</li>';
	$request_args_html .= '<li><b>sslverify : </b>' . $sslverify . '</li>';
	$request_args_html .= '<li><b>stream : </b>' . $stream . '</li>'; 
	$request_args_html .= '<li><b>filename : </b>' . $filename . '</li>';
	$request_args_html .= '<li><b>limit_response_size : </b>' . $limit_response_size . '</li>';        
	$request_args_html .= '<li><b>_redirection : </b>' . $_redirection . '</li>';                
	$request_args_html .= '</ul>';
	
	return $request_args_html;

}
function ets_format_json_response ( $response ){
	if( ! is_object ( json_decode ( $response ) ) ) {
		return;
	}    
	return '<span class="ets-arrow-reponse dashicons dashicons-arrow-down"></span><div class="ets-pop"></div><textarea class="ets-response-json">'. $response . '</textarea><ul style="display: none;">' . $response . '</ul>';

}

