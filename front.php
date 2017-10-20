<?php

/**
 * Google Analytics - Front class
 *
 * @package Google Analytics
 * @subpackage Google Analytics Front
 */
class GASLBZ_Front {



	/**
	 * Show the GA code if it proceed
	 */
	public static function ga_code() {

		// Plugin options
		$settings = @json_decode(''.get_option('gaslbz_settings'), true);
		if (empty($settings) || !is_array($settings) || empty($settings['tracking-code']))
			return;

		// Check logged users tracking
		if (is_user_logged_in() && (empty($settings['track-logged']) || 'on' != $settings['track-logged']))
			return;

		// Check IP anonymization
		$anonymize_ip = (!empty($settings['anonymize-ip']) && 'on' == $settings['anonymize-ip'])? "\nga('set', 'anonymizeIp', true);" : '';

		// And show the code
		echo "\n\n<script type="text/javascript">
var clicky_site_ids = clicky_site_ids || [];
clicky_site_ids.push($settings['tracking-code']);
(function() {
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = '//static.getclicky.com/js';
  ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
})();
</script>\n\n";
	}



}
