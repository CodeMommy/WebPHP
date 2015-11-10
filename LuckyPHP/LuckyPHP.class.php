<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

// Path
define('FRAMEWORK_ROOT', dirname(__FILE__));

// Autoload
function autoload($className)
{
    // Library
    $library = array();
    $library['Smarty'] = FRAMEWORK_ROOT . '/Library/Smarty/Smarty.class.php';
    $library['R'] = FRAMEWORK_ROOT . '/Library/RedBeanPHP/rb.php';
    if (isset($library[$className])) {
        require_once($library[$className]);
        return;
    }
    // Core
    $coreFile = dirname(FRAMEWORK_ROOT) . '/' . $className . '.class.php';
    if (is_file($coreFile)) {
        require_once($coreFile);
        return;
    }
}
spl_autoload_register('autoload');

// Init
use LuckyPHP\Core\Router;
Router::init();