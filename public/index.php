<?php
// Define
define('APPLICATION_ROOT', '../application');
// Autoload
@include_once('../system/autoload.php');
require_once('../vendor/autoload.php');
require_once(APPLICATION_ROOT . '/library/autoload.php');
// Server Start
use LuckyPHP\Server;
Server::start();