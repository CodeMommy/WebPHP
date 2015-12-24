<?php
// Define
define('APPLICATION_ROOT', '../application');
// Autoload
require_once('../vendor/autoload.php');
require_once('../framework/autoload.php');
require_once(APPLICATION_ROOT . '/library/autoload.php');
// Server Start
use LuckyPHP\Server;
Server::start();