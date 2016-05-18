<?php
class CurlPost {

public function postData($url, $data)
{
	$ch = curl_init();
	$timeout = 3000; 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $url); 
	curl_setopt($ch, CURLOPT_POST, true); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$handles = curl_exec($ch); 
	curl_close($ch); 
	return $handles;

}

}
?>
