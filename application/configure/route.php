<?php

$configure = array();

// Route Type: pathinfo, map or symfony
$configure['type'] = 'symfony';

// Route Configure
// any, get, post...
$configure['get']['/'] = 'IndexController.index';
$configure['get']['test/{action}'] = 'TestController.index';

return $configure;