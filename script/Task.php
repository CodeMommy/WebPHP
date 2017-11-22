<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP\Script;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Class Task
 * @package CodeMommy\WebPHP\Script
 */
class Task
{
    /**
     * Task constructor.
     */
    public function __construct()
    {
    }

    /**
     * Update Version
     */
    public static function updateVersion()
    {
        $file = 'composer.json';
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
     * Clean
     */
    public static function clean()
    {
        $removeList = array(
            'application/_runtime',
            'demo/_runtime'
        );
        $fileSystem = new Filesystem();
        foreach ($removeList as $value) {
            $fileSystem->remove($value);
        }
        echo(sprintf('Clean Finished.'));
    }

    /**
     * Run
     */
    public static function run()
    {
        echo(sprintf('Visit http://localhost%s', PHP_EOL));
        system(sprintf('php -S 0.0.0.0:80 -t public'));
    }

    /**
     * Demo
     */
    public static function demo()
    {
        echo(sprintf('Visit http://localhost%s', PHP_EOL));
        system(sprintf('php -S 0.0.0.0:80 -t demo/public'));
    }
}
