<?php

$configure = array();

$configure['type'] = 'custom'; // pathinfo or custom

$configure['route']['any']['/'] = 'IndexController.index';
$configure['route']['get']['test'] = 'TestController.test';

return $configure;