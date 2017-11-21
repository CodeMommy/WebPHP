<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP\Script;

/**
 * Class Install
 * @package CodeMommy\WebPHP\Script
 */
class Install
{
    /**
     * Delete Directory
     * @param $path
     */
    private static function deleteDirectory($path)
    {
        $directory = dir($path);
        while (($item = $directory->read()) !== false) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            $file = $directory->path . '/' . $item;
            if (is_dir($file)) {
                self::deleteDirectory($file);
            } else {
                unlink($file);
            }
        }
        $directory->close();
        rmdir($path);
    }

    /**
     * Start
     */
    public static function start()
    {
        copy('application/environment.example.yaml', 'application/environment.yaml');
        file_put_contents('composer.json', '{}');
        unlink('.travis.yml');
        unlink('phpunit.xml');
        unlink('task.php');
        deleteDirectory('system');
        deleteDirectory('test');
    }
}
