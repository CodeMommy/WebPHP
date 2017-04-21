<?php

use CodeMommy\WebPHP\Environment;

return array(
    'driver'   => 'Redis', // Redis, Memcached, APC, XCache
    'server'   => Environment::get('cache.redis.server', 'localhost'),
    'port'     => Environment::get('cache.redis.port', 6379),
    'password' => Environment::get('cache.redis.password', ''),
    'database' => Environment::get('cache.redis.database', 0),
    'prefix'   => Environment::get('cache.redis.prefix', '')
);