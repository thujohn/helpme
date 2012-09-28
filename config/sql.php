<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ($_SERVER['SERVER_ADDR'] == '127.0.0.1'){
	define('__SQL_HOST__', 'localhost');
	define('__SQL_USER__', 'root');
	define('__SQL_PASS__', 'root');
	define('__SQL_DB__', 'helpme');
}else{
	define('__SQL_HOST__', '');
	define('__SQL_USER__', '');
	define('__SQL_PASS__', '');
	define('__SQL_DB__', '');
}

?>