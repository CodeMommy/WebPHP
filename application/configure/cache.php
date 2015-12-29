<?php

$configure = array();

//apc, memcache, xcache, redis
$configure['type'] = 'redis';

$configure['memcache']['host'] = 'localhost';
$configure['memcache']['port'] = 11211;

$configure['redis']['host'] = 'localhost';
$configure['redis']['port'] = 6379;

return $configure;