<?php

return array(
    // Route Type: pathinfo, map or symfony
    'type' => 'symfony',
    // Route Configure
    // any, get, post...
    'any' => array(
        '' => 'DemoController.index',
        '{action}' => 'DemoController.index',
        'test/symfony/{name}' => 'TestController.symfony',
        'test/home' => 'Home.HomeController.index'
    )
);
