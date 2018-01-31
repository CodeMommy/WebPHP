<?php

use CodeMommy\RoutePHP\RouteType;
use CodeMommy\RoutePHP\RouteMethod;

return array(
    // Route Type: normal, pathinfo, map or symfony
    'type' => RouteType::SYMFONY,
    // Route Configure
    'rule' => array(
        array('/', 'Index.index', RouteMethod::GET)
    )
);
