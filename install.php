<?php
if (!file_exists('application/environment.yaml')) {
    copy('application/environment.example.yaml', 'application/environment.yaml');
}
unlink('composer.json');
copy('composer.example.json', 'composer.json');
unlink('composer.example.json');
unlink('install.php');