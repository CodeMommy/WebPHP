<?php

$configure = array();

$configure['type'] = 'custom'; // pathinfo or custom

$configure['route']['/'] = 'IndexController.index';
$configure['route']['test'] = 'TestController.test';

return $configure;