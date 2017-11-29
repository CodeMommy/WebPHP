<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP\Script;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\FileSystem;
use CodeMommy\TaskPHP\Composer;
use CodeMommy\TaskPHP\PHP;

/**
 * Class Command
 * @package CodeMommy\WebPHP\Script
 */
class Command
{
    /**
     * Command constructor.
     */
    public function __construct()
    {
    }

    /**
     * Clean
     */
    public static function clean()
    {
        $removeList = array(
            'application/_runtime',
            'demo/_runtime',
            '.report'
        );
        $result = FileSystem::remove($removeList);
        if ($result) {
            Console::printLine('Clean Finished.', 'success');
        } else {
            Console::printLine('Error.', 'error');
        }
    }

    /**
     * Clean Report
     */
    public static function cleanReport()
    {
        $removeList = array(
            '.report'
        );
        $result = FileSystem::remove($removeList);
        if ($result) {
            Console::printLine('Clean Report Finished.', 'success');
        } else {
            Console::printLine('Error.', 'error');
        }
    }

    /**
     * Run
     */
    public static function run()
    {
        Console::printLine('Visit http://localhost', 'information');
        PHP::run('public');
    }

    /**
     * Demo
     */
    public static function demo()
    {
        Console::printLine('Visit http://localhost', 'information');
        PHP::run('demo/public');
    }
}
