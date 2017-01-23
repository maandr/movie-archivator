<?php
class Location {

	public static function serverUrl() {
		$httpProtocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
		return sprintf("%s://%s:%s", $httpProtocol, $_SERVER['SERVER_NAME'], PORT);
	}

	public static function baseUrl() {
		return sprintf("%s/%s", Location::serverUrl(), ROOT_DIR);
	}

	public static function requestUrl() {
		return sprintf("%s%s", Location::serverUrl(), $_SERVER['REQUEST_URI']);
	}

	public static function redirectTo($targetPath) {
		header('Location: '.Location::baseUrl().$targetPath);
		echo '<script type="text/javascript">';
		echo 'window.location = "'.Location::baseUrl().$targetPath.'"';
		echo '</script>';
	}
}
?>
