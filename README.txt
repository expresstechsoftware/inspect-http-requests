=== Plugin Name ===
Contributors: expresstechsoftware, webbdeveloper, sunnysoni, vanbom
Donate link: https://paypal.me/supportets
Tags: log, wp_http, requests, update checks, api, http_api_debug, pre_http_request, http_request_args
Requires at least: 3.0.1
Tested up to: 6.2
Stable tag: 1.0.3
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

== Checkout Our Other Plugins ==
1. [Connect MemberPress and Discord](https://wordpress.org/plugins/expresstechsoftwares-memberpress-discord-add-on/)
2. [Connect PaidmembershipPro and Discord](https://wordpress.org/plugins/pmpro-discord-add-on/)
3. [Connect LearnPress and Discord](https://wordpress.org/plugins/connect-learnpress-discord-add-on/)
4. [Connect GamiPress and Discord](https://wordpress.org/plugins/connect-gamipress-and-discord/)
5. [Connect LifterLMS and Discord](https://wordpress.org/plugins/connect-lifterlms-to-discord/)
6. [Webhook For WCFM Vendors](https://wordpress.org/plugins/webhook-for-wcfm-vendors/)
7. [Connect LearnDash and Discord](https://wordpress.org/plugins/connect-learndash-and-discord/)
8. [Product Questions & Answers for WooCommerce](https://wordpress.org/plugins/product-questions-answers-for-woocommerce/)
9. [Connect Ultimate Member and Discord](https://wordpress.org/plugins/ultimate-member-discord-add-on/)
10. [Connect BadgeOS and Discord](https://wordpress.org/plugins/connect-badgeos-to-discord/)
11. [connect Eduma Theme and Discord](https://wordpress.org/plugins/connect-eduma-theme-to-discord/)

== Screenshots ==
1. The plugin menu is Available inside tools

= 1.0.3 =
* Support WordPress 6.2
= 1.0.2 =
* Fixe bug
= 1.0.0 =
* Initial release
