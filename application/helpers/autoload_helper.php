<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('mb_ucfirst')){
	function mb_ucfirst($chaine){
		$chaine = trim($chaine);
		$chaine = mb_strtolower($chaine);
		$first = mb_substr($chaine,0,1);
		$first = strtr($first, "äâàáåãéèëêòóôõöøìíîïùúûüýñçþÿæœðø","ÄÂÀÁÅÃÉÈËÊÒÓÔÕÖØÌÍÎÏÙÚÛÜÝÑÇÞÝÆŒÐØ");
		$first = strtoupper($first);
		$chaine = $first.mb_substr($chaine,1);
		return $chaine;
	}
}

if (!function_exists('keygen')){
	function keygen($long = 16){
		$key = '';
		$chars = "0123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ";
		$i = 0;
		while ($i < $long){
			$char = substr($chars, mt_rand(0, strlen($chars)-1), 1);
			if (!strstr($key, $char)) { 
				$key .= $char;
				$i++;
			}
		}
		return $key;
	}
}

if (!function_exists('gravatar')){
	function gravatar($email, $size = NULL, $rating = NULL, $default_image = NULL, $secure = NULL){
		$email = strtolower(trim($email));
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE){
			$hash = md5($email);
		}else{
			$hash = 'invalid_email';
		}
		$query_string = NULL;
		$options = array();
		if ($size !== NULL) {
			$options['s'] = $size;
		}else{
			$options['s'] = 80;
		}
		if ($rating !== NULL) {
			$options['r'] = $rating;
		}
		if ($default_image !== NULL) {
			$options['d'] = $default_image;
		}else{
			$options['d'] = 'mm';
		}
		if (count($options) > 0) {
			$query_string = '?'.http_build_query($options, '', '&amp;');
		}
		if ($secure !== NULL) {
			$base = 'https://secure.gravatar.com/';
		}else{
			$base = 'http://www.gravatar.com/';
		}
		return $base .'avatar/'. $hash . $query_string;
	}
}
?>