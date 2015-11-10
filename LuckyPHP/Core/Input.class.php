<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP\Core;

class Input
{
    public static function get($key, $default=null)
	{
		if(isset($_GET[$key])){
			return $_GET[$key];
		}else{
			return $default;
		}
	}
	
	public static function post($key, $default=null)
	{
		if(isset($_POST[$key])){
			return $_POST[$key];
		}else{
			return $default;
		}
	}
	
	public static function any($key, $default=null)
	{
		if(isset($_REQUEST[$key])){
			return $_REQUEST[$key];
		}else{
			return $default;
		}
	}
	
	public static function raw()
	{
		// return $GLOBALS['HTTP_RAW_POST_DATA'];
		return file_get_contents('php://input');
	}
}