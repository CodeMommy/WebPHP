<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

use LuckyPHP\Route;

class Server
{
    public function __construct()
    {

    }

    public static function start()
    {
        Route::init();
    }
}