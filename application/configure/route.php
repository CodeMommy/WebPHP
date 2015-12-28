<?php

$configure = array();

$configure['type'] = 'symfony'; // pathinfo or custom or symfony

$configure['route']['any']['/'] = 'IndexController.index';
$configure['route']['get']['test'] = 'TestController.test';
$configure['route']['get']['blog/{id}'] = 'TestController.blog';

return $configure;