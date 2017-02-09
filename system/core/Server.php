<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\WebPHP\Route;

class Server
{
    
    public static function start($path)
    {
        define('APPLICATION_ROOT', $path);
        Route::init();
        return true;
    }
}