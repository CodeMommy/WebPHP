<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Controller;

use CodeMommy\ViewPHP\View;

/**
 * Class Index
 * @package Controller
 */
class Index
{
    /**
     * Index constructor.
     */
    public function __construct()
    {
    }

    /**
     * Index
     * @return bool
     */
    public function index()
    {
        $data = array();
        $data['title'] = 'Hello World';
        return View::render('index', $data);
    }
}
