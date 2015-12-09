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

    public static function start()
    {
        Router::init();
    }
}