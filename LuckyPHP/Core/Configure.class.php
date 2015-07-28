<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

class Configure
{
    public static function get($key, $default = null)
	{
		$configure = require_once(APPLICATION_ROOT . '/Configure/configure.php');
		if(isset($configure[$key])){
			return $configure[$key];
		}else{
			return $default;
		}
	}
}