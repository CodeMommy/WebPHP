<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Controller;

/**
 * Class TestController
 * @package Controller
 */
class TestController
{
    /**
     * TestController constructor.
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
        return 'pathinfo';
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
        return 'symfony';
    }
}
