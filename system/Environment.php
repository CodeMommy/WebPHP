<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use Symfony\Component\Yaml\Yaml;

/**
 * Class Environment
 * @package CodeMommy\WebPHP
 */
class Environment
{
    /**
     * List
     * @var array
     */
    private static $list = array();

    /**
     * File
     * @var string
     */
    private static $file = '';

    /**
     * Environment constructor.
     */
    public function __construct()
    {
    }

    /**
     * Set File
     * @param string $file
     * @return bool
     */
    public static function setFile($file = '')
    {
        self::$file = $file;
        return true;
    }

    /**
     * Get
     * @param string $key
     * @param null $default
     *
     * @return mixed
     */
    public static function get($key = '', $default = null)
    {
        if (isset(self::$list[$key])) {
            return self::$list[$key];
        }
        if (!is_file(self::$file)) {
            return $default;
        }
        $config = Yaml::parse(file_get_contents(self::$file));
        $keys = explode('.', $key);
        $count = count($keys);
        for ($index = 0; $index < $count; $index++) {
            if (!isset($config[$keys[$index]])) {
                return $default;
            }
            $config = $config[$keys[$index]];
        }
        self::$list[$key] = $config;
        return $config;
    }
}
