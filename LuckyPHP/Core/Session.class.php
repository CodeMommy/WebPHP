<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP\Core;

class Session
{
    private static function init()
    {
        @session_start();
    }

    public static function get($key, $default = null)
    {
        self::init();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }

    public static function set($key, $value)
    {
        self::init();
        $_SESSION[$key] = $value;
        return true;
    }

    public static function delete($key)
    {
        self::init();
        unset($_SESSION[$key]);
        return true;
    }

    public static function isExist($key)
    {
        self::init();
        $value = self::get($key);
        if ($value == null) {
            return false;
        } else {
            return true;
        }
    }

    public static function clear()
    {
        self::init();
        session_destroy();
        return true;
    }
}