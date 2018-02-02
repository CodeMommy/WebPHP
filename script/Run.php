<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP\Script;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\PHP;

/**
 * Class Run
 * @package CodeMommy\WebPHP\Script
 */
class Run
{
    /**
     * Run constructor.
     */
    public function __construct()
    {
    }

    /**
     * Start
     */
    public static function start()
    {
        Clean::start();
        Console::printLine('Visit http://localhost', 'information');
        PHP::run('public');
    }
}
