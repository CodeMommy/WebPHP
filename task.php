<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

require_once(__DIR__ . '/vendor/autoload.php');

use CodeMommy\TaskPHP\Task;
use Symfony\Component\Filesystem\Filesystem;

class TaskList
{
    /**
     * Task Update Version
     */
    public static function updateVersion()
    {
        $file = __DIR__ . '/composer.json';
        $composer = file_get_contents($file);
        $composer = json_decode($composer, true);
        $version = $composer['version'];
        $version = explode('.', $version);
        $version[2] = intval($version[2]) + 1;
        $version = implode('.', $version);
        $composer['version'] = $version;
        $composer = json_encode($composer, JSON_PRETTY_PRINT);
        $composer = str_replace('\\/', '/', $composer);
        file_put_contents($file, $composer);
        echo(sprintf('Updated version to %s.', $version));
    }


    /**
     * Task Clear
     */
    public static function clear()
    {
        $removeList = array();
        array_push($removeList, __DIR__ . '/application/_runtime');
        $fileSystem = new Filesystem();
        foreach ($removeList as $value) {
            $fileSystem->remove($value);
        }
        echo(sprintf('Clear Finished.'));
    }


    /**
     * Task Run
     */
    public static function run()
    {
        $port = intval(Task::getParameter(0, 80));
        if ($port == 80) {
            echo(sprintf('Visit http://localhost%s', PHP_EOL));
        } else {
            echo(sprintf('Visit http://localhost:%s%s', $port, PHP_EOL));
        }
        system(sprintf('php -S 0.0.0.0:%s -t public', $port));
    }


    /**
     * Task Web Test
     */
    public static function webTest()
    {
        $port = intval(Task::getParameter(0, 80));
        if ($port == 80) {
            echo(sprintf('Visit http://localhost%s', PHP_EOL));
        } else {
            echo(sprintf('Visit http://localhost:%s%s', $port, PHP_EOL));
        }
        system(sprintf('php -S 0.0.0.0:%s -t test/web/public', $port));
    }


    /**
     * Task Update
     */
    public static function update()
    {
        system('php -v');
        Task::line();
        system('git pull');
        Task::line();
        system('composer self-update');
        Task::line();
        system('composer update');
    }


    /**
     * Task Test
     */
    public static function test()
    {
        $test = Task::getParameter(0);
        $phpUnitPath = sprintf('%s/vendor/bin/phpunit', __DIR__);
        $phpUnitPath = str_replace('/', DIRECTORY_SEPARATOR, $phpUnitPath);
        if (empty($test)) {
            system($phpUnitPath);
        } else {
            system(sprintf('"%s" test%s%sTest --repeat 100', $phpUnitPath, DIRECTORY_SEPARATOR, $test));
        }
    }
}


/**
 * Start
 */
$file = __DIR__ . '/composer.json';
$composer = file_get_contents($file);
$composer = json_decode($composer, true);
$version = $composer['version'];
Task::config('CodeMommy WebPHP Task', $version);
$tasks = get_class_methods('TaskList');
foreach ($tasks as $task) {
    $functionName = sprintf('TaskList::%s', $task);
    Task::add($task, $task, $functionName);
}
Task::run();
