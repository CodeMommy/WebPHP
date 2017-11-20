<?php

use CodeMommy\WebPHP\Environment;

return array(
    'type'  => 'mysql',
    'mysql' => array(
        'host'      => Environment::get('database.mysql.host', 'localhost'),
        'database'  => Environment::get('database.mysql.database', ''),
        'username'  => Environment::get('database.mysql.username', ''),
        'password'  => Environment::get('database.mysql.password', ''),
        'prefix'    => Environment::get('database.mysql.prefix', ''),
        'collation' => Environment::get('database.mysql.collation', 'utf8_unicode_ci'),
        'charset'   => Environment::get('database.mysql.charset', 'utf8')
    )
);