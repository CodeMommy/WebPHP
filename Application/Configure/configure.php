<?php
	
$configure = array();

$configure['hello'] = 'world';

$configure['database']['type'] = 'mysql';
$configure['database']['host'] = 'localhost';
$configure['database']['port'] = '3306';
$configure['database']['databasename'] = 'luckyphp';
$configure['database']['account'] = 'root';
$configure['database']['password'] = '';

return $configure;