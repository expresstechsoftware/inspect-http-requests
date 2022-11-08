=== Plugin Name ===
Contributors: expresstechsoftware
Donate link: https://paypal.me/supportets
Tags: log, wp_http, requests, update checks, api, http_api_debug, pre_http_request, http_request_args
Requires at least: 3.0.1
Tested up to: 6.1
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Log, view, and Block WP HTTP requests

== Description ==
** This plugin is inpired from the work of log-http-requests plugin ** 

Monitor all the HTTP Request being made via WP HTTP Methods i.e. wp_remote_get, wp_remote_post Block any request by just a click of button.
Track how much time a request like updating core/plugin/theme taking (may be useful for bandwidth consumption analysis), 

This plugin logs all WP_HTTP requests and displays them in a table listing for easy viewing. It also stores the runtime of each HTTP request.

= Available Hooks =
Don't log items from a specific hostname:

<pre>
add_filter( 'ets_inspect_http_requests_ignore_hostname', function( $data ) {
    if ( false !== strpos( $data['url'], 'wordpress.org' ) ) {
        return false;
    }
    return $data;
});
</pre>

= Important Links =
* [Github →](https://github.com/expresstechsoftware/inspect-http-requests)
* [Github →](https://github.com/FacetWP/log-http-requests)

== Installation ==

1. Download and activate the plugin.
2. Browse to `Tools > Inspect HTTP Requests` to view log entries.

== Screenshots ==
1. The plugin menu is Available inside tools


= 1.0.0 =
* Initial release
