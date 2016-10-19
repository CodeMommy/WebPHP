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
        $protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $phpSelf = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relateURL = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $phpSelf . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : $pathInfo);
        $serverName = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
        return $protocal . $serverName . $relateURL;
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