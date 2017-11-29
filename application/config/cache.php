<?php

use CodeMommy\ConfigPHP\Config;

return array(
    'driver'   => 'Redis', // Redis, Memcached, APC, XCache
    'server'   => Config::get('environment.cache.redis.server', 'localhost'),
    'port'     => Config::get('environment.cache.redis.port', 6379),
    'password' => Config::get('environment.cache.redis.password', ''),
    'database' => Config::get('environment.cache.redis.database', 0),
    'prefix'   => Config::get('environment.cache.redis.prefix', '')
);
