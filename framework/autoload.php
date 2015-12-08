<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

// Path
define('FRAMEWORK_ROOT', dirname(__FILE__));

// Autoload

function vendorList()
{
    $vendor = require_once(FRAMEWORK_ROOT . '/vendor.php');
    return $vendor;
}

function autoload($className)
{
    $className = str_replace('\\', '/', $className);
    // Core
    $classNameNew = str_replace('LuckyPHP', 'core', $className);
    $classNameNew = strtolower($classNameNew);
    $coreFile = FRAMEWORK_ROOT . '/' . $classNameNew . '.php';
    if (is_file($coreFile)) {
        require_once($coreFile);
        return;
    }
    // Vendor
    $vendor = vendorList();
    if (isset($vendor[$className])) {
        require_once(FRAMEWORK_ROOT . '/vendor/' . $vendor[$className]);
        return;
    }
}

spl_autoload_register('autoload');

// Init
use LuckyPHP\Router;

Router::init();