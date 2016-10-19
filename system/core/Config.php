<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

class Config
{
    public static function get($key, $default = null)
    {
        $keys = explode('.', $key);
        $config = require(APPLICATION_ROOT . '/config/' . $keys[0] . '.php');
        foreach ($keys as $theKey => $value) {
            if ($theKey != 0) {
                if (isset($config[$value])) {
                    $config = $config[$value];
                } else {
                    return $default;
                }
            }
        }
        return $config;
    }
}