<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

class Me
{
    public static function root()
    {
        $filePath = strtolower($_SERVER['SCRIPT_NAME']);
        $filePathArray = explode('/', $filePath);
        $fileName = end($filePathArray);
        $urlFull = substr($filePath, 0, strlen($filePath) - strlen($fileName) - 1);
        $urlFull = $urlFull . '/';
        return $urlFull;
    }

    public static function url()
    {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal . (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '') . $relate_url;
//        return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
    }

    public static function domain()
    {
        $url = parse_url(self::url());
        return isset($url['host']) ? $url['host'] : null;
    }

    public static function scheme()
    {
        $url = parse_url(self::url());
        return isset($url['scheme']) ? $url['scheme'] : null;
    }

    public static function query()
    {
        $url = parse_url(self::url());
        return isset($url['query']) ? $url['query'] : null;
    }

    public static function path()
    {
        $url = parse_url(self::url());
        return isset($url['path']) ? $url['path'] : null;
    }

}