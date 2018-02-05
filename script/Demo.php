<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Script;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\PHP;
use CodeMommy\DevelopPHP\Clean;

/**
 * Class Demo
 * @package CodeMommy\Script
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
        Clean::workbench();
        Console::printLine('Visit http://localhost', 'information');
        PHP::run('test_case/public');
    }
}
