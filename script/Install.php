<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Script;

/**
 * Class Install
 */
class Install
{
    /**
     * Install constructor.
     */
    public function __construct()
    {
    }

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
                continue;
            }
            unlink($file);
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
     * @param $version
     */
    public static function start($version = '*')
    {
        // Remove
        $removeList = array(
            'manual',
            'script',
            'system',
            'test',
            'test_case',
            '.coveralls.yml',
            '.develop.json',
            '.travis.yml',
            'autoload.php',
            'phpunit.xml'
        );
        foreach ($removeList as $file) {
            self::remove($file);
        }
        // Copy
        copy('application/config/environment.example.yaml', 'application/config/environment.yaml');
        // Composer
        $composerFile = 'composer.json';
        $composerData = file_get_contents($composerFile);
        $composerData = json_decode($composerData, true);
        $packageName = isset($composerData['name']) ? $composerData['name'] : 'codemommy/webphp';
        $packageName = strtolower($packageName);
        $data = array(
            'require' => array(
                $packageName => $version
            )
        );
        $composerJSON = json_encode($data, JSON_PRETTY_PRINT);
        $composerJSON = str_replace('\\', '', $composerJSON);
        file_put_contents($composerFile, $composerJSON);
        system('composer update', $returnCode);
        $installedVersion = $version;
        $composerLockFile = 'composer.lock';
        $composerLockContent = file_get_contents($composerLockFile);
        $composerLockArray = json_decode($composerLockContent, true);
        $packages = isset($composerLockArray['packages']) ? $composerLockArray['packages'] : array();
        foreach ($packages as $package) {
            if (strtolower($package['name']) == $packageName) {
                $installedVersion = $package['version'];
                break;
            }
        }
        if (intval($returnCode) == 0) {
            echo(sprintf('CodeMommy WebPHP %s has been installed successfully', $installedVersion));
        }
    }
}
