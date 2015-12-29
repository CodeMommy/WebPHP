<?php

$configure = array();

// Route Type: pathinfo, map or symfony
$configure['type'] = 'symfony';

// Route Configure
$configure['any']['/'] = 'IndexController.index';
$configure['get']['test'] = 'TestController.test';
$configure['get']['blog/{id}'] = 'TestController.blog';

return $configure;