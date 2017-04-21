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
     * @return mixed|null
     */
    public static function get($key, $default = null)
    {
        $file = APPLICATION_ROOT . '/environment.yaml';
        if (!is_file($file)) {
            return $default;
        }
        $config = Config::load(APPLICATION_ROOT . '/environment.yaml');
        $result = $config->get($key);
        if ($result == null) {
            return $default;
        }
        return $result;
    }
}