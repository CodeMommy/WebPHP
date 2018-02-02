<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP\Script;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\FileSystem;

/**
 * Class Clean
 * @package CodeMommy\WebPHP\Script
 */
class Clean
{
    /**
     * Clean constructor.
     */
    public function __construct()
    {
    }

    /**
     * Workbench
     */
    public static function workbench()
    {
        $removeList = array(
            'application/_runtime',
            'test_case/_runtime',
            'workbench'
        );
        $result = FileSystem::remove($removeList);
        if ($result) {
            Console::printLine('Clean Finished.', 'success');
            return;
        }
        Console::printLine('Clean Error.', 'error');
        return;
    }

    /**
     * PHPUnit
     */
    public static function phpUnit()
    {
        PHPUnit::clean();
    }

    /**
     * All
     */
    public static function all()
    {
        self::workbench();
        self::phpUnit();
    }
}
