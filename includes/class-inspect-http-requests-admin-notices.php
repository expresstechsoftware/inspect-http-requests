<?php



 defined( 'ABSPATH' ) || exit;

 /**
  * Inspect_Http_Requests_Admin_Notices
  *
  * @since 1.0.10
  */
class Inspect_Http_Requests_Admin_Notices {

	/**
	 * Static constructor
	 *
	 * @return void
	 */
	public static function init() {

		// add_action( 'admin_notices', array( __CLASS__, 'ets_inspect_http_requests_display_notification' ) );
	}

	/**
	 * Display the review notification
	 *
	 * @return void
	 */
	public static function ets_inspect_http_requests_display_notification() {

		$screen = get_current_screen();

		if ( $screen && $screen->id === 'tools_page_inspect-http-requests' ) {

			$dismissed = get_user_meta( get_current_user_id(), '_ets_inspect_http_requests_dismissed_notification', true );
			if ( ! $dismissed ) {
				ob_start();
				require_once INSPECT_HTTP_REQUESTS_PLUGIN_DIR_PATH . 'includes/template/notification/review/review.php';
				$notification_content = ob_get_clean();
				echo wp_kses( $notification_content, self::ets_inspect_http_requests_allowed_html() );
			}
		}
	}

	/**
	 * Get allowed_html
	 *
	 * @return ARRAY
	 */
	public static function ets_inspect_http_requests_allowed_html() {
		$allowed_html = array(
			'div' => array(
				'class' => array(),
			),
			'p'   => array(
				'class' => array(),
			),
			'a'   => array(
				'id'           => array(),
				'data-user-id' => array(),
				'href'         => array(),
				'class'        => array(),
				'style'        => array(),
			),

			'img' => array(
				'src'   => array(),
				'class' => array(),
			),
		);

		return $allowed_html;
	}

}

Inspect_Http_Requests_Admin_Notices::init();
