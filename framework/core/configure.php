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
        $keys = explode('.', $key);
        $keyNew = array_pop($keys);
        if ($keys) {
            $path = '';
            foreach ($keys as $value) {
                $path = $path . '/' . $value;
            }
        } else {
            $path = '/application';
        }
        $configure = require(APPLICATION_ROOT . '/configure' . $path . '.php');
        if (isset($configure[$keyNew])) {
            return $configure[$keyNew];
        } else {
            return $default;
        }
    }
}