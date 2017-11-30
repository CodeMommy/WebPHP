<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Controller;

use CodeMommy\RequestPHP\Request;
use CodeMommy\ViewPHP\View;
use Library\Demo;

/**
 * Class IndexController
 * @package Controller
 */
class IndexController
{
    /**
     * Index
     * @return string
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Demo
     * @return mixed
     */
    public function demo()
    {
        $data = array();
        // Demo List
        $demoMethods = get_class_methods('Library\Demo');
        sort($demoMethods);
        $notShow = array();
        foreach ($demoMethods as $key => $value) {
            if (in_array($value, $notShow)) {
                unset($demoMethods[$key]);
            }
        }
        $data['demoList'] = $demoMethods;
        // Title
        $data['title'] = 'CodeMommy WebPHP Demo';
        $action = Request::inputGet('action', '');
        $data['action'] = $action;
        if (!empty($action)) {
            $data['title'] = sprintf('%s: %s', $data['title'], $action);
            Demo::$action();
        }
        // Render
        $data['root'] = Request::root();
        return View::render('index', $data);
    }
}
