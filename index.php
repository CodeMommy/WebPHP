<?php
// Define
define('APPLICATION_ROOT', dirname(__FILE__));

// Autoload
require_once(APPLICATION_ROOT . '/vendor/autoload.php');
require_once(APPLICATION_ROOT . '/framework/autoload.php');
require_once(APPLICATION_ROOT . '/library/autoload.php');

// Server Start
use LuckyPHP\Server;

Server::start();