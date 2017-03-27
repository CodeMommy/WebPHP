<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

// Autoload
function autoloadFramework($className)
{
    $className = str_replace('\\', '/', $className);
    $className = str_replace('CodeMommy/WebPHP', 'core', $className);
//    $className = strtolower($className);
    $file = __DIR__ . '/' . $className . '.php';
    if (is_file($file)) {
        require_once($file);
        return;
    }
}

spl_autoload_register('autoloadFramework');