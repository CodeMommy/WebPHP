<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP\Script;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\PHP;

/**
 * Class Demo
 * @package CodeMommy\WebPHP\Script
 */
class Demo
{
    /**
     * Demo constructor.
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
        PHP::run('test_case/public');
    }
}
