<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

function autoloadLibrary($className)
{
    $className = str_replace('\\', '/', $className);
    $library = require_once(dirname(__FILE__) . '/configure.php');
    if (isset($library[$className])) {
        require_once(dirname(__FILE__) . '/' . $library[$className]);
        return;
    }
}

spl_autoload_register('autoloadLibrary');