<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Library\Demo;

use Library\HelloWorld\HelloWorld;

/**
 * Class WebPHP
 * @package Library\Demo
 */
class WebPHP
{
    /**
     * WebPHP constructor.
     */
    public function __construct()
    {
    }

    /**
     * Load Library
     */
    public function loadLibrary()
    {
        HelloWorld::show();
    }
}
