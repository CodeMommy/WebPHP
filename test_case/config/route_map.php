<?php

use CodeMommy\RoutePHP\RouteType;
use CodeMommy\RoutePHP\RouteMethod;

return array(
    // Route Type: normal, pathinfo, map or symfony
    'type' => RouteType::MAP,
    // Route Configure
    'rule' => array(
        array('test/map', 'Test.map', RouteMethod::ANY)
    )
);
