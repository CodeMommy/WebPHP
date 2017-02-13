<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\WebPHP\Route;
use CodeMommy\WebPHP\AutoLoad;

class Server
{
    
    public static function start($path)
    {
        define('APPLICATION_ROOT', $path);
        AutoLoad::init();
        Route::init();
        return true;
    }
}