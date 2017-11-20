<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Controller;

use CodeMommy\WebPHP\Controller;
use CodeMommy\WebPHP\View;

/**
 * Class IndexController
 * @package Controller
 */
class IndexController extends Controller
{
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