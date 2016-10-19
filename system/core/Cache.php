<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

use LuckyPHP\Config;
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
        $cacheType = strtolower(Config::get('cache.type'));
        if ($cacheType == 'apc') {
            $cacheDriver = new ApcCache();
            return $cacheDriver;
        }
        if ($cacheType == 'memcache') {
            $memcacheConfig = Config::get('cache.memcache');
            $memcache = new Memcache();
            $memcache->connect($memcacheConfig['host'], $memcacheConfig['port']);
            $cacheDriver = new MemcacheCache();
            $cacheDriver->setMemcache($memcache);
            return $cacheDriver;
        }
        if ($cacheType == 'xcache') {
            $cacheDriver = new XcacheCache();
            return $cacheDriver;
        }
        if ($cacheType == 'redis') {
            $redisConfig = Config::get('cache.redis');
            $redis = new Redis();
            $redis->connect($redisConfig['host'], $redisConfig['port']);
            $cacheDriver = new RedisCache();
            $cacheDriver->setRedis($redis);
            return $cacheDriver;
        }
        return null;
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
        }
        return $default;
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