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
    $library = array();
    $library['Smarty'] = FRAMEWORK_ROOT . '/Library/Smarty/Smarty.class.php';
    $library['R'] = FRAMEWORK_ROOT . '/Library/RedBeanPHP/rb.php';
    if (isset($library[$className])) {
        require_once($library[$className]);
    }
    $classNames = array();
    array_push($classNames, FRAMEWORK_ROOT . '/Core/' . $className . '.class.php');
    foreach ($classNames as $class) {
        if (is_file($class)) {
            require_once($class);
        }
    }
}
spl_autoload_register('autoload');

// Init
Router::init();