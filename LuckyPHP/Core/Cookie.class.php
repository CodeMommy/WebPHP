<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP\Core;

class Cookie
{
    public static function get($key, $default = null)
    {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        } else {
            return $default;
        }
    }

    public static function set($key, $value)
    {
        setcookie($key, $value);
        return true;
    }

    public static function delete($key)
    {
        setcookie($key, '', time() - 3600);
        return true;
    }

    public static function isExist($key)
    {
        $value = self::get($key);
        if ($value == null) {
            return false;
        } else {
            return true;
        }
    }

    public static function clear()
    {
        if ($_COOKIE) {
            foreach ($_COOKIE as $key => $value) {
                self::delete($key);
            }
        }
        return true;
    }
}