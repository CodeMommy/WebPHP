<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

if (!class_exists('autoloadDirectory')) {
    /**
     * Autoload Directory
     * @param string $directory
     * @param string $namespaceRoot
     */
    function autoloadDirectory($directory = '.', $namespaceRoot = '')
    {
        spl_autoload_register(function ($className) use ($directory, $namespaceRoot) {
            $directory = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $directory);
            $directory = rtrim($directory, '/\\');
            $namespaceRoot = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $namespaceRoot);
            $namespaceRoot = trim($namespaceRoot, '/\\');
            $className = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $className);
            $className = trim($className, '/\\');
            if (substr($className, 0, strlen($namespaceRoot)) == $namespaceRoot) {
                $className = substr($className, strlen($namespaceRoot));
                $className = ltrim($className, '/\\');
            }
            $extensionList = array('php', 'class.php');
            foreach ($extensionList as $extension) {
                $file = $directory . DIRECTORY_SEPARATOR . $className . '.' . $extension;
                if (is_file($file) && is_readable($file)) {
                    require_once($file);
                }
            }
        });
    }
}

autoloadDirectory(sprintf('%s%ssystem', __DIR__, DIRECTORY_SEPARATOR), 'CodeMommy\\WebPHP');
