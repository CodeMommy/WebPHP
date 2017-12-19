<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP\Script;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\FileSystem;

/**
 * Class CleanReport
 * @package CodeMommy\WebPHP\Script
 */
class CleanReport
{
    /**
     * CleanReport constructor.
     */
    public function __construct()
    {
    }

    /**
     * Start
     */
    public static function start()
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
}
