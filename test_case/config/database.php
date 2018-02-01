<?php

use CodeMommy\ConfigPHP\Config;

return array(
    'type'  => 'mysql',
    'mysql' => array(
        'host'      => Config::get('environment.database.mysql.host', 'localhost'),
        'database'  => Config::get('environment.database.mysql.database', ''),
        'username'  => Config::get('environment.database.mysql.username', ''),
        'password'  => Config::get('environment.database.mysql.password', ''),
        'prefix'    => Config::get('environment.database.mysql.prefix', ''),
        'collation' => Config::get('environment.database.mysql.collation', 'utf8_unicode_ci'),
        'charset'   => Config::get('environment.database.mysql.charset', 'utf8')
    )
);
