<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP\Script;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\FileSystem;

/**
 * Class PHPUnit
 * @package CodeMommy\WebPHP\Script
 */
class PHPUnit
{
    const BASE_PATH_NAME = 'PHPUnit';

    /**
     * PHPUnit constructor.
     */
    public function __construct()
    {
    }

    /**
     * Get Base Path
     * @return string
     */
    private static function getBasePath()
    {
        return sprintf('%s%s%s', sys_get_temp_dir(), DIRECTORY_SEPARATOR, self::BASE_PATH_NAME);
    }

    /**
     * Clean
     * @return bool
     */
    public static function clean()
    {
        $removeList = array(
            self::getBasePath()
        );
        $result = FileSystem::remove($removeList);
        if ($result) {
            Console::printLine('Clean PHPUnit Report Finished.', 'success');
            return true;
        }
        Console::printLine('Clean PHPUnit Report Error.', 'error');
        return false;
    }

    /**
     * Start
     */
    public static function start()
    {
        $reportPath = sprintf('%s%s%s', self::getBasePath(), DIRECTORY_SEPARATOR, time());
        $reportFile = sprintf('%s%sindex.html', $reportPath, DIRECTORY_SEPARATOR);
        $cloverFile = sprintf('%s%sclover.xml', $reportPath, DIRECTORY_SEPARATOR);
        $command = sprintf('"vendor/bin/phpunit" -v --coverage-html="%s" --coverage-clover="%s"', $reportPath, $cloverFile);
        system($command);
        if (is_file($reportFile)) {
            system(sprintf('start %s', $reportFile));
            return;
        }
        Console::printLine('No Report.', 'information');
    }
}
