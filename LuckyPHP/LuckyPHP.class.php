<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

// Path
define('FRAMEWORK_ROOT', dirname(__FILE__));

// Autoload
function libraryList()
{
    $library = array();
    $library['Smarty'] = 'Smarty/Smarty.class.php';
    $library['R'] = 'RedBeanPHP/rb.php';
    return $library;
}

function vendorList()
{
    $vendor = require_once(FRAMEWORK_ROOT . '/Vendor.class.php');
    return $vendor;
}

function autoload($className)
{
    $className = str_replace('\\', '/', $className);
    // Core
    $coreFile = dirname(FRAMEWORK_ROOT) . '/' . $className . '.class.php';
    if (is_file($coreFile)) {
        require_once($coreFile);
        return;
    }
    // Library
    $library = libraryList();
    if (isset($library[$className])) {
        require_once(FRAMEWORK_ROOT . '/Library/' . $library[$className]);
        return;
    }
    // Vendor
    $vendor = vendorList();
    if (isset($vendor[$className])) {
        require_once(FRAMEWORK_ROOT . '/Vendor/' . $vendor[$className]);
        return;
    }
}

spl_autoload_register('autoload');

// Init
use LuckyPHP\Core\Router;

Router::init();