<?php
// Define
define('APPLICATION_ROOT', __DIR__);

// Autoload
require_once(APPLICATION_ROOT . '/vendor/autoload.php');
require_once(APPLICATION_ROOT . '/framework/autoload.php');
require_once(APPLICATION_ROOT . '/library/autoload.php');

// Server Start
use LuckyPHP\Server;

Server::start();