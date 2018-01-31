<?php

use CodeMommy\RoutePHP\RouteType;

return array(
    // Route Type: normal, pathinfo, map or symfony
    'type' => RouteType::SYMFONY,
    // Route Configure
    'rule' => array(
        array('', 'Demo.index', 'any'),
        array('{action}', 'Demo.index', 'any'),
        array('test/symfony/{name}', 'Test.symfony', 'any'),
        array('test/home', 'Home.Home.index', 'any')
    )
);
