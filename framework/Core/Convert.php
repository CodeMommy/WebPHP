<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

class Convert
{
    public static function arrayToJSON($array)
    {
        return json_encode($array);
    }
}