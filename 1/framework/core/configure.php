<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

class Configure
{
    public static function get($key, $default = null)
    {
        $configure = require_once(APPLICATION_ROOT . '/configure/configure.php');
        if (isset($configure[$key])) {
            return $configure[$key];
        } else {
            return $default;
        }
    }
}