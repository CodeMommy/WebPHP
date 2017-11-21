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
     * @param string $path
     */
    private static function deleteDirectory($path = '')
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
     * Remove
     * @param string $file
     */
    private static function remove($file = '')
    {
        if (is_dir($file)) {
            self::deleteDirectory($file);
        }
        if (is_file($file)) {
            unlink($file);
        }
    }

    /**
     * Start
     */
    public static function start()
    {
        $removeList = array(
            'system',
            'test',
            '.travis.yml',
            'phpunit.xml'
        );
        foreach ($removeList as $file) {
            self::remove($file);
        }
        copy('application/environment.example.yaml', 'application/environment.yaml');
        // Composer
        $file = 'composer.json';
        $composer = file_get_contents($file);
        $composer = json_decode($composer, true);
        $version = $composer['version'];
        $version = explode('.', $version);
        $versionComposer = sprintf('%s.%s.*', $version[0], $version[1]);
        $data = array(
            'require' => array(
                'codemommy/webphp' => $versionComposer
            )
        );
        $composerJSON = json_encode($data, JSON_PRETTY_PRINT);
        $composerJSON = str_replace('\\', '', $composerJSON);
        file_put_contents('composer.json', $composerJSON);
    }
}

Install::start();
