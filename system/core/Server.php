<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

use LuckyPHP\Router;

class Server
{
    public function __construct()
    {

    }

    public static function start($path)
    {
        define('APPLICATION_ROOT', $path);
        Router::init();
    }
}