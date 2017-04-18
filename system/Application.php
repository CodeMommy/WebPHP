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
use CodeMommy\WebPHP\Debug;

class Application
{
    public static function start($path)
    {
        define('APPLICATION_ROOT', $path);
        Config::setRoot(APPLICATION_ROOT . '/config');
        // Debug
        error_reporting(0);
        ini_set('display_errors', 'Off');
        $isDebug = Config::get('application.debug', false);
        if ($isDebug) {
            register_shutdown_function(function () {
                $error = error_get_last();
                if (is_array($error)) {
                    Debug::show(error_get_last());
                }
            });
        }
        // Load Library
        $library = Config::get('library', array());
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