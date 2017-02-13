<?php
// Application Path
$applicationPath = '../application';
// Autoload
$autoloadFile = array();
array_push($autoloadFile, '../system/autoload.php');
array_push($autoloadFile, '../vendor/autoload.php');
foreach ($autoloadFile as $file) {
    if (is_file($file)) {
        require_once($file);
    }
}
// Server Start
use CodeMommy\WebPHP\Server;

Server::start($applicationPath);