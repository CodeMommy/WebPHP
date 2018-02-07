<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Library\Demo;

use CodeMommy\LogPHP\Log;

/**
 * Class LogPHP
 * @package Library\Demo
 */
class LogPHP
{
    /**
     * LogPHP constructor.
     */
    public function __construct()
    {
    }

    /**
     * Add Config
     */
    public function addConfig()
    {
        Log::addConfig('log', 'log.log');
        echo('LogPHP->addConfig');
    }
}
