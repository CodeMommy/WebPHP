<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

use LuckyPHP\Configure;
use Doctrine\Common\Cache\ApcCache;
use Doctrine\Common\Cache\MemcacheCache;
use Doctrine\Common\Cache\XcacheCache;
use Doctrine\Common\Cache\RedisCache;
use Memcache;
use Redis;

class Cache
{
    private static function driver()
    {
        $cacheType = strtolower(Configure::get('cache', 'type'));
        if ($cacheType == 'apc') {
            $cacheDriver = new ApcCache();
            return $cacheDriver;
        }
        if ($cacheType == 'memcache') {
            $redisConfigure = Configure::get('cache', 'memcache');
            $memcache = new Memcache();
            $memcache->connect($redisConfigure['host'], $redisConfigure['port']);
            $cacheDriver = new MemcacheCache();
            $cacheDriver->setMemcache($memcache);
            return $cacheDriver;
        }
        if ($cacheType == 'xcache') {
            $cacheDriver = new XcacheCache();
            return $cacheDriver;
        }
        if ($cacheType == 'redis') {
            $redisConfigure = Configure::get('cache', 'redis');
            $redis = new Redis();
            $redis->connect($redisConfigure['host'], $redisConfigure['port']);
            $cacheDriver = new RedisCache();
            $cacheDriver->setRedis($redis);
            return $cacheDriver;
        }
    }

    public static function set($key, $value, $timeout = 0)
    {
        $driver = self::driver();
        $result = $driver->save($key, $value, $timeout);
        return $result;
    }

    public static function get($key, $default = null)
    {
        $driver = self::driver();
        $result = $driver->fetch($key);
        if ($result) {
            return $result;
        } else {
            return $default;
        }
    }

    public static function delete($key)
    {
        $driver = self::driver();
        $result = $driver->delete($key);
        return $result;
    }

    public static function isExist($key)
    {
        $driver = self::driver();
        $result = $driver->contains($key);
        return $result;
    }
}