<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\AutoloadPHP\Autoload;
use CodeMommy\WebPHP\Route;

class Server
{

    public static function start($path)
    {
        define('APPLICATION_ROOT', $path);
        Autoload::load(APPLICATION_ROOT, '');
        $library = Config::get('library');
        if (is_array($library)) {
            foreach ($library as $key => $value) {
                $file = APPLICATION_ROOT . '/library/' . $value;
                Autoload::file($file, $key);
            }
        }
        Route::init();
        return true;
    }
}