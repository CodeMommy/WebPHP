<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

use CodeMommy\WebPHP\Config;

function autoloadLibrary($className)
{
    $className = str_replace('\\', '/', $className);
    $library = Config::get('library.' . $className);
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