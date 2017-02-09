<?php

/**
 * CodeMommy Web for PHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Web;

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