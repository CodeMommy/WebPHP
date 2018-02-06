<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Library\Demo;

use CodeMommy\DebugPHP\Debug;
use CodeMommy\ConfigPHP\Config;

/**
 * Class ConfigPHP
 * @package Library\Demo
 */
class ConfigPHP
{
    /**
     * ConfigPHP constructor.
     */
    public function __construct()
    {
    }

    /**
     * Clear Cache
     */
    public function clearCache()
    {
        Config::clearCache();
        echo('ConfigPHP->clearCache');
    }

    /**
     * Add Directory
     */
    public function addDirectory()
    {
        Config::addDirectory(sprintf('%s/../../config', __DIR__));
        echo('ConfigPHP->addDirectory');
    }

    /**
     * Get
     */
    public function get()
    {
        Config::addDirectory(sprintf('%s/../../config', __DIR__));
        $config = Config::get('database.type');
        echo $config;
    }
}
