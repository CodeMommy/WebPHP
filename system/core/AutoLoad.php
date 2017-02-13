<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

class AutoLoad
{
    protected static function application($className)
    {
        $className = str_replace('\\', '/', $className);
        $file = APPLICATION_ROOT . '/' . $className . '.php';
        if (is_file($file)) {
            require_once($file);
            return;
        }
    }

    protected static function library($className)
    {
        $className = str_replace('\\', '/', $className);
        $library = Config::get('library.' . $className);
        $file = APPLICATION_ROOT . '/library/' . $library;
        if (is_file($file)) {
            require_once($file);
            return;
        }
    }

    public static function init()
    {
        spl_autoload_register(__NAMESPACE__ . '\AutoLoad::application');
        spl_autoload_register(__NAMESPACE__ . '\AutoLoad::library');
    }
}