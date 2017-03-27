<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\AutoloadPHP\Autoload;
use CodeMommy\CachePHP\Cache;
use CodeMommy\ConfigPHP\Config;
use CodeMommy\WebPHP\Route;

class Server
{

    public static function start($path)
    {
        define('APPLICATION_ROOT', $path);
        Config::setRoot(APPLICATION_ROOT . '/config');
        $library = Config::get('library');
        if (is_array($library)) {
            foreach ($library as $key => $value) {
                $file = APPLICATION_ROOT . '/library/' . $value;
                Autoload::file($file, $key);
            }
        }
        Autoload::load(APPLICATION_ROOT, '');
        Cache::setConfig(Config::get('cache'));
        Route::init();
        return true;
    }
}