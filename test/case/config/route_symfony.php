<?php

return array(
    // Route Type: pathinfo, map or symfony
    'type' => 'symfony',
    // Route Configure
    // any, get, post...
    'any' => array(
        'test/symfony' => 'TestController.symfony',
        '' => 'DemoController.index',
        '{action}' => 'DemoController.index'
    )
);
