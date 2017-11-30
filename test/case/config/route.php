<?php

return array(
    // Route Type: pathinfo, map or symfony
    'type' => 'symfony',
    // Route Configure
    // any, get, post...
    'any' => array(
        '{action}' => 'IndexController.demo',
        '' => 'IndexController.demo'
    )
);
