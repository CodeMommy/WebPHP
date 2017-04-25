<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

require_once(__DIR__ . '/vendor/autoload.php');

use Symfony\Component\Filesystem\Filesystem;

Task::start();

class Task
{
    /**
     * Get Parameter
     *
     * @param $number
     * @param string $default
     *
     * @return string
     */
    private static function getParameter($number, $default = '')
    {
        if (isset($_SERVER['argv'][$number])) {
            return $_SERVER['argv'][$number];
        }
        return $default;
    }

    /**
     * Line
     */
    private static function line()
    {
        echo(sprintf('--------------------%s', PHP_EOL));
    }

    /**
     * Start
     */
    public static function start()
    {
        $task = self::getParameter(1, 'Help');
        $task = sprintf('task%s', $task);
        self::$task();
    }

    /**
     * Default Task
     */
    protected static function taskHelp()
    {
        echo(sprintf('Tasks are:%s', PHP_EOL));
        self::line();
        $class = get_class_methods(__CLASS__);
        sort($class);
        foreach ($class as $key => $value) {
            if (substr($value, 0, 4) == 'task') {
                echo(sprintf('%s%s', substr($value, 4), PHP_EOL));
            }
        }
    }

    /**
     * Task Update Version
     */
    protected static function taskUpdateVersion()
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
    protected static function taskClear()
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
    protected static function taskRun()
    {
        $port = intval(self::getParameter(2, 80));
        if ($port == 80) {
            echo(sprintf('Visit http://localhost%s', PHP_EOL));
        } else {
            echo(sprintf('Visit http://localhost:%s%s', $port, PHP_EOL));
        }
        system(sprintf('cd public && php -S 0.0.0.0:%s', $port));
    }

    /**
     * Task Update
     */
    protected static function taskUpdate()
    {
        system('php -v');
        self::line();
        system('git pull');
        self::line();
        system('composer self-update');
        self::line();
        system('composer update');
    }

    /**
     * Task Test
     */
    protected static function taskTest()
    {
        $test = self::getParameter(2);
        if (empty($test)) {
            system('phpunit');
        } else {
            system(sprintf('cd test && phpunit %sTest --repeat 100', $test));
        }
    }
}