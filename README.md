<p>=== Plugin Name ===<br>
Contributors: expresstechsoftware, webbdeveloper, sunnysoni, vanbom, eilandert<br>
Donate link: <a href="https://paypal.me/supportets">https://paypal.me/supportets</a><br>
Tags: log, wp_http, requests, update checks, api, http_api_debug, pre_http_request, http_request_args<br>
Requires at least: 3.0.1 Tested up to: 6.3 Stable tag: 1.0.5 License: GPLv2 or later License<br>
URI: <a href="http://www.gnu.org/licenses/gpl-2.0.html">http://www.gnu.org/licenses/gpl-2.0.html</a></p>
<p>Log, view, and Block WP HTTP requests</p>
<p>== Description ==<br>
** This plugin is inpired from the work of log-http-requests plugin **</p>
<p>Monitor all the HTTP Request being made via WP HTTP Methods i.e. wp_remote_get, wp_remote_post Block any request by just a click of button. Track how much time a request like updating core/plugin/theme taking (may be useful for bandwidth consumption analysis),</p>
<p>This plugin logs all WP_HTTP requests and displays them in a table listing for easy viewing. It also stores the runtime of each HTTP request.</p>
<p>If you add a base-url manually (e.g. <a href="https://api.woocommerce.com">https://api.woocommerce.com</a>) there will be no more entries stored for that host.</p>
<p>= Available Hooks =</p>
<p>Add the following to wp-config.php:</p>
<p>define( ‘inspect-http-requests-ignored-urls’, [<br>
‘<a href="http://wordpress.org">wordpress.org</a>’,<br>
‘<a href="http://wordpress.com">wordpress.com</a>’,<br>
‘<a href="http://wp-rocket.me">wp-rocket.me</a>’,<br>
‘<a href="http://rankmath.com">rankmath.com</a>’,<br>
‘api’,<br>
]);</p>
<p>= Important Links =</p>
<ul>
<li><a href="https://github.com/expresstechsoftware/inspect-http-requests">Github →</a></li>
<li><a href="https://github.com/FacetWP/log-http-requests">Github →</a></li>
</ul>
<p>== Installation ==</p>
<ol>
<li>Download and activate the plugin.</li>
<li>Browse to <code>Tools &gt; Inspect HTTP Requests</code> to view log entries.</li>
</ol>
<p>== Checkout Our Other Plugins ==</p>
<ol>
<li><a href="https://wordpress.org/plugins/expresstechsoftwares-memberpress-discord-add-on/">Connect MemberPress and Discord</a></li>
<li><a href="https://wordpress.org/plugins/pmpro-discord-add-on/">Connect PaidmembershipPro and Discord</a></li>
<li><a href="https://wordpress.org/plugins/connect-learnpress-discord-add-on/">Connect LearnPress and Discord</a></li>
<li><a href="https://wordpress.org/plugins/connect-gamipress-and-discord/">Connect GamiPress and Discord</a></li>
<li><a href="https://wordpress.org/plugins/connect-lifterlms-to-discord/">Connect LifterLMS and Discord</a></li>
<li><a href="https://wordpress.org/plugins/webhook-for-wcfm-vendors/">Webhook For WCFM Vendors</a></li>
<li><a href="https://wordpress.org/plugins/connect-learndash-and-discord/">Connect LearnDash and Discord</a></li>
<li><a href="https://wordpress.org/plugins/product-questions-answers-for-woocommerce/">Product Questions &amp; Answers for WooCommerce</a></li>
<li><a href="https://wordpress.org/plugins/ultimate-member-discord-add-on/">Connect Ultimate Member and Discord</a></li>
<li><a href="https://wordpress.org/plugins/connect-badgeos-to-discord/">Connect BadgeOS and Discord</a></li>
<li><a href="https://wordpress.org/plugins/connect-eduma-theme-to-discord/">connect Eduma Theme and Discord</a></li>
</ol>
<p>== Screenshots ==</p>
<ol>
<li>The plugin menu is Available inside tools</li>
</ol>
<p>= 1.0.4 =</p>
<ul>
<li>Support WordPress 6.3</li>
</ul>
<p>= 1.0.3 =</p>
<ul>
<li>Support WordPress 6.2 = 1.0.2 =</li>
<li>Fixe bug = 1.0.0 =</li>
<li>Initial release</li>
</ul>

