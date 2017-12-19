<?php

return array(
    // Route Type: pathinfo, map or symfony
    'type' => 'symfony',
    // Route Configure
    // any, get, post...
    'any' => array(
        '' => 'Demo.index',
        '{action}' => 'Demo.index',
        'test/symfony/{name}' => 'Test.symfony',
        'test/home' => 'Home.Home.index'
    )
);
