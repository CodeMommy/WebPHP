<?php

/**
 * CodeMommy Web for PHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Web;

use CodeMommy\Web\Route;

class Server
{
    
    public static function start($path)
    {
        define('APPLICATION_ROOT', $path);
        Route::init();
        return true;
    }
}