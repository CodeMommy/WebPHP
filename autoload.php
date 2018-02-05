<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */
require_once('system/library/Autoload.php');

use CodeMommy\WebPHP\Library\Autoload;

$autoloaDirectory = array(
    'system' => 'CodeMommy\\WebPHP',
    'system/interface' => 'CodeMommy\\WebPHP',
    'system/library' => 'CodeMommy\\WebPHP\\Library\\'
);

Autoload::directory($autoloaDirectory);
