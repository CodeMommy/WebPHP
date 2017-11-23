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
    private static $list = array();

    /**
     * Environment constructor.
     */
    public function __construct()
    {
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
        $file = Application::getPath('config/environment.yaml');
        if (!is_file($file)) {
            return $default;
        }
        if (isset(self::$list[$key])) {
            return self::$list[$key];
        }
        $config = Yaml::parse(file_get_contents($file));
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
