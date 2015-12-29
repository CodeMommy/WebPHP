<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

use LuckyPHP\Route;

class Server
{

    public static function start($path)
    {
        define('APPLICATION_ROOT', $path);
        Route::init();
    }
}