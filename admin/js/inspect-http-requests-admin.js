(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	if (etsInspectHttpRequestsParams.is_admin) {
		$(document).on('click', 'input[name="ets-block-button"]', function(){
                    var ets_checked = $(this).prop('checked');
                    var ets_url_id = $(this).data('id');
				$.ajax({
					url: etsInspectHttpRequestsParams.admin_ajax,
					type: "POST",
					context: this,
					data: { 'action': 'ets_inspect_http_requests_update_status_url', 'ets_url_id': ets_url_id , 'ets_checked' : ets_checked,  'ets_inspect_http_requests_nonce': etsInspectHttpRequestsParams.ets_inspect_http_requests_nonce },
					beforeSend: function () {                                              
						$(this).parent().next('span.spinner').addClass("ets-is-active").show();
					},
					success: function (data) { 
                                            console.log(data);                                              
					},
					error: function (response, textStatus, errorThrown ) {
						console.log( textStatus + " :  " + response.status + " : " + errorThrown );
					},
					complete: function () {
						$(this).parent().next('span.spinner').removeClass("ets-is-active").hide();
					}
				});                    
                    
		});
		$(document).on('click', '#ets-inspect-http-requestssearch-submit', function(){

                    var s = $("#ets-inspect-http-requests-search-input").val();

				$.ajax({
					url: etsInspectHttpRequestsParams.admin_ajax,
					type: "POST",
					context: this,
					data: { 'action': 'ets_inspect_http_requests_search', 's': s,  'ets_inspect_http_requests_nonce': etsInspectHttpRequestsParams.ets_inspect_http_requests_nonce },
					beforeSend: function () {                                              
						$(this).parent().find('span.spinner').addClass("ets-is-active").show();
                                                $('tbody#ets-inspect-http-requests-list').html("");
					},
					success: function (data) { 
                                            //console.log(data);
                                            $('tbody#ets-inspect-http-requests-list').html(data);
					},
					error: function (response, textStatus, errorThrown ) {
						console.log( textStatus + " :  " + response.status + " : " + errorThrown );
					},
					complete: function () {
						$(this).parent().find('span.spinner').removeClass("ets-is-active").hide();
					}
				});                    
                    
		});                 
	}

})( jQuery );
