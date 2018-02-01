<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Controller;

/**
 * Class Test
 * @package Controller
 */
class Test
{
    /**
     * Test constructor.
     */
    public function __construct()
    {
    }

    /**
     * PathInfo
     * @return string
     */
    public function pathInfo()
    {
        return isset($_GET['name']) ? $_GET['name'] : null;
    }

    /**
     * Map
     * @return string
     */
    public function map()
    {
        return 'map';
    }

    /**
     * Symfony
     * @return string
     */
    public function symfony()
    {
        return isset($_GET['name']) ? $_GET['name'] : null;
    }
}
