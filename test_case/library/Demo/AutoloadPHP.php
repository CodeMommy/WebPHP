<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Library\Demo;

use CodeMommy\AutoloadPHP\Autoload;

/**
 * Class AutoloadPHP
 * @package Library\Demo
 */
class AutoloadPHP
{
    /**
     * AutoloadPHP constructor.
     */
    public function __construct()
    {
    }

    /**
     * File
     */
    public function file()
    {
        Autoload::file('AutoloadPHP.php');
        echo('AutoloadPHP->file');
    }

    /**
     * Directory
     */
    public function directory()
    {
        Autoload::directory(__DIR__, '\\Library\\Demo');
        echo('AutoloadPHP->directory');
    }
}
