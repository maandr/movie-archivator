<?php
class HTTP
{
	public static function get($uri)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => $uri,
				CURLOPT_USERAGENT => 'cURL-Agent'
		));
		$response = curl_exec($curl);
		curl_close($curl);
	
		return json_decode($response);
	}
}
?>