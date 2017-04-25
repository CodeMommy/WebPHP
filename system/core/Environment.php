<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use Noodlehaus\Config;

/**
 * Class Environment
 * @package CodeMommy\WebPHP
 */
class Environment
{
    /**
     * @param $key
     * @param null $default
     *
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $file = APPLICATION_ROOT . '/environment.yaml';
        if (!is_file($file)) {
            return $default;
        }
        $config = Config::load($file);
        $result = $config->get($key, $default);
        if (is_null($result)) {
            return $default;
        }
        return $result;
    }
}