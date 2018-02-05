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
 * Class Run
 * @package CodeMommy\Script
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
        Clean::workbench();
        Console::printLine('Visit http://localhost', 'information');
        PHP::run('public');
    }
}
