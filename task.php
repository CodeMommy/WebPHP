<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

require_once(__DIR__ . '/vendor/autoload.php');

use CodeMommy\TaskPHP\Task;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Task Update Version
 */
function taskUpdateVersion()
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

Task::add('update-version', 'Update Version', 'taskUpdateVersion');

/**
 * Task Clear
 */
function taskClear()
{
    $removeList = array();
    array_push($removeList, __DIR__ . '/application/_runtime');
    $fileSystem = new Filesystem();
    foreach ($removeList as $value) {
        $fileSystem->remove($value);
    }
    echo(sprintf('Clear Finished.'));
}

Task::add('clear', 'Clear', 'taskClear');

/**
 * Task Run
 */
function taskRun()
{
    $port = intval(Task::getParameter(0, 80));
    if ($port == 80) {
        echo(sprintf('Visit http://localhost%s', PHP_EOL));
    } else {
        echo(sprintf('Visit http://localhost:%s%s', $port, PHP_EOL));
    }
    system(sprintf('cd public && php -S 0.0.0.0:%s', $port));
}

Task::add('run', 'Run', 'taskRun');

/**
 * Task Update
 */
function taskUpdate()
{
    system('php -v');
    Task::line();
    system('git pull');
    Task::line();
    system('composer self-update');
    Task::line();
    system('composer update');
}

Task::add('update', 'Update Composer', 'taskUpdate');

/**
 * Task Test
 */
function taskTest()
{
    $test = Task::getParameter(0);
    $phpUnitPath = sprintf('%s/vendor/bin/phpunit', __DIR__);
    $phpUnitPath = str_replace('/', DIRECTORY_SEPARATOR, $phpUnitPath);
    if (empty($test)) {
        system($phpUnitPath);
    } else {
        system(sprintf('cd test && "%s" %sTest --repeat 100', $phpUnitPath, $test));
    }
}

Task::add('test', 'Test', 'taskTest');

/**
 * Start
 */
Task::config('CodeMommy WebPHP Task', '');
Task::run();