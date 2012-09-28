<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('site_url')) {
	function site_url($uri = '') {
		if( ! is_array($uri)) {
			$uri = func_get_args();
		}

		$CI =& get_instance();	

		return $CI->config->site_url($uri);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('base_url_orig')) {
	function base_url_orig($uri = '') {
		$CI =& get_instance();
		return $CI->config->base_url_orig($uri);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('url')) {
	function url($text, $uri = '') {
		if( ! is_array($uri)) {
			$uri = func_get_args();
			array_shift($uri);
		}

		echo '<a href="'.site_url($uri).'">'.htmlentities(utf8_decode($text)).'</a>';
		return '';
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('url_title')) {
	function url_title($str, $separator = 'dash', $lowercase = FALSE) {
		if ($separator == 'dash') {
			$search		= '_';
			$replace	= '-';
		}else{
			$search		= '-';
			$replace	= '_';
		}

		$trans = array(
						'&\#\d+?;'				=> '',
						'&\S+?;'				=> '',
						'\s+'					=> $replace,
						'[^a-z0-9\-\._]'		=> '',
						$replace.'+'			=> $replace,
						$replace.'$'			=> $replace,
						'^'.$replace			=> $replace,
						'\.+$'					=> ''
					);

		$str = replace_accents($str);
		$str = strip_tags($str);

		foreach ($trans as $key => $val) {
			$str = preg_replace("#".$key."#i", $val, $str);
		}

		if ($lowercase === TRUE) {
			$str = strtolower($str);
		}

		if (mb_substr($str, -1) == $replace) {
			$str = mb_substr($str, 0, -1);
		}

		return trim(stripslashes($str));
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('replace_accents')) {
	function replace_accents($uri) {
		$uri = htmlentities($uri, ENT_COMPAT, "UTF-8");
		$uri = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/','$1',$uri);
		return html_entity_decode(strtolower($uri));
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('anchor')) {
	function anchor($uri = '', $title = '', $attributes = '') {
		$title = (string) $title;

		if ($uri == 'javascript:;') {
			$site_url = $uri;
		}else if ( ! is_array($uri)) {
			$site_url = ( ! preg_match('!^\w+://! i', $uri)) ? site_url($uri) : $uri;
		}else{
			$site_url = site_url($uri);
		}

		if ($title == '') {
			$title = $site_url;
		}

		if ($attributes != '') {
			$attributes = _parse_attributes($attributes);
		}

		return '<a href="'.$site_url.'"'.$attributes.'>'.$title.'</a>';
	}
}