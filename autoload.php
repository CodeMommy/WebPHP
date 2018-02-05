<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */
require_once('system/library/Autoload.php');

use CodeMommy\WebPHP\Library\Autoload;

$autoloaDirectory = array(
    'system/library' => 'CodeMommy\\WebPHP\\Library\\',
    'system/interface' => 'CodeMommy\\WebPHP',
    'system' => 'CodeMommy\\WebPHP'
);

Autoload::directory($autoloaDirectory);
