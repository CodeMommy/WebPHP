<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

class Configure
{
    public static function get($file, $key, $default = null)
    {
        $configure = require(APPLICATION_ROOT . '/configure/' . $file . '.php');
        $keys = explode('.', $key);
        foreach ($keys as $value) {
            if (isset($configure[$value])) {
                $configure = $configure[$value];
            } else {
                return $default;
            }
        }
        return $configure;
    }
}