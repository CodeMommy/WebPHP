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
     * Symfony
     * @return string
     */
    public function symfony()
    {
        return isset($_GET['name']) ? $_GET['name'] : null;
    }
}
