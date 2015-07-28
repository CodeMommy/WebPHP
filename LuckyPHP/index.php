<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

// function __autoload($className)
// {
//     $frameworkRoot = dirname(__FILE__);
//     $classNames = array();
//     array_push($classNames, $frameworkRoot . '/Core/' . $className . '.php');
//     array_push($classNames, $frameworkRoot . '/Library/' . $className . '/'.$className.'.class.php');
//     foreach ($classNames as $class) {
//         $require = @require_once($class);
//         if (!empty($require)) {
//             break;
//         }
//     }
// }

define('FRAMEWORK_ROOT', dirname(__FILE__));

require_once(FRAMEWORK_ROOT . '/Core/Router.php');
require_once(FRAMEWORK_ROOT . '/Core/Session.php');
require_once(FRAMEWORK_ROOT . '/Core/Cookie.php');
require_once(FRAMEWORK_ROOT . '/Core/Controller.php');
require_once(FRAMEWORK_ROOT . '/Core/View.php');
require_once(FRAMEWORK_ROOT . '/Core/Input.php');
require_once(FRAMEWORK_ROOT . '/Core/Debug.php');
require_once(FRAMEWORK_ROOT . '/Core/Configure.php');
require_once(FRAMEWORK_ROOT . '/Core/Client.php');
require_once(FRAMEWORK_ROOT . '/Core/Validate.php');
require_once(FRAMEWORK_ROOT . '/Core/Convert.php');
require_once(FRAMEWORK_ROOT . '/Core/Image.php');
require_once(FRAMEWORK_ROOT . '/Core/Weixin.php');
require_once(FRAMEWORK_ROOT . '/Core/Log.php');

require_once(FRAMEWORK_ROOT . '/Library/Smarty/Smarty.class.php');

Router::init();