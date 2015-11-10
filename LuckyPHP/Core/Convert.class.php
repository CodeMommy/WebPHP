<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP\Core;

class Convert
{
    public static function arrayToJSON($array)
	{
		return json_encode($array);
	}
}