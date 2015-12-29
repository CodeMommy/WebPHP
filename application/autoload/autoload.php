<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

use LuckyPHP\Configure;

function autoloadLibrary($className)
{
    $className = str_replace('\\', '/', $className);
    $library = Configure::get('library', $className);
    if ($library) {
        require_once(APPLICATION_ROOT . '/library/' . $library);
        return;
    }
}

spl_autoload_register('autoloadLibrary');

function autoloadModel($className)
{
    $className = str_replace('\\', '/', $className);
    $className = strtolower($className);
    $file = APPLICATION_ROOT . '/' . $className . '.php';
    if (is_file($file)) {
        require_once($file);
        return;
    }
}

spl_autoload_register('autoloadModel');