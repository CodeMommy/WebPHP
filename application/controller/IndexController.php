<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Controller;

use CodeMommy\ViewPHP\View;

/**
 * Class IndexController
 * @package Controller
 */
class IndexController
{
    /**
     * IndexController constructor.
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
