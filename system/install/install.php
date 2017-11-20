<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

/**
 * @param $path
 */
function deleteDirectory($path)
{
    $directory = dir($path);
    while (($item = $directory->read()) !== false) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        $file = $directory->path . '/' . $item;
        if (is_dir($file)) {
            deleteDirectory($file);
        } else {
            unlink($file);
        }
    }
    $directory->close();
    rmdir($path);
}

copy('application/environment.example.yaml', 'application/environment.yaml');
file_put_contents('composer.json', '{}');
unlink('.travis.yml');
unlink('phpunit.xml');
unlink('task.php');
unlink('run.bat');
unlink('test.bat');
deleteDirectory('system');
deleteDirectory('test');