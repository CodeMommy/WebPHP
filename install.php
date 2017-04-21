<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

/**
 * @param $path
 */
function emptyDirectory($path)
{
    $directory = dir($path);
    while (($item = $directory->read()) != false) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        $file = $directory->path . '/' . $item;
        if (is_dir($file)) {
            emptyDirectory($file);
            rmdir($file);
        } else {
            unlink($file);
        }
    }
}

if (!file_exists('application/environment.yaml')) {
    copy('application/environment.example.yaml', 'application/environment.yaml');
}
unlink('composer.json');
copy('composer.example.json', 'composer.json');
unlink('composer.example.json');
unlink('install.php');
unlink('gulpfile.js');
unlink('package.json');
emptyDirectory('system');
rmdir('system');