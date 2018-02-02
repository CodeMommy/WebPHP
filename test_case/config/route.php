<?php

use CodeMommy\RoutePHP\RouteType;
use CodeMommy\RoutePHP\RouteMethod;

return array(
    // Route Type: normal, pathinfo, map or symfony
    'type' => RouteType::SYMFONY,
    // Route Configure
    'rule' => array(
        array('', 'Demo.index', RouteMethod::ANY),
        array('{action}', 'Demo.index', RouteMethod::ANY),
        array('test/symfony/{name}', 'Test.symfony', RouteMethod::ANY)
    )
);
