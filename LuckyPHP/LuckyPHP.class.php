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

require_once(FRAMEWORK_ROOT . '/Core/Router.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Session.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Cookie.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Controller.class.php');
require_once(FRAMEWORK_ROOT . '/Core/View.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Input.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Debug.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Configure.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Client.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Validate.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Convert.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Image.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Weixin.class.php');
require_once(FRAMEWORK_ROOT . '/Core/Log.class.php');

require_once(FRAMEWORK_ROOT . '/Library/Smarty/Smarty.class.php');

Router::init();