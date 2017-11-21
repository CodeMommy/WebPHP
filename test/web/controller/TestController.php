<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Controller;

use CodeMommy\RequestPHP\Request;
use CodeMommy\WebPHP\Controller;
use CodeMommy\WebPHP\View;
use Test;

/**
 * Class TestController
 * @package Controller
 */
class TestController extends Controller
{
    /**
     * Index
     * @return mixed
     */
    public function index()
    {
        $data = array();
        // Test List
        $test = get_class_methods('Test');
        sort($test);
        $noTest = array();
        foreach ($test as $key => $value) {
            if (in_array($value, $noTest)) {
                unset($test[$key]);
            }
        }
        $data['testList'] = $test;
        // Title
        $data['title'] = 'CodeMommy WebPHP Test';
        $action = Request::inputGet('action', '');
        $data['action'] = $action;
        if (!empty($action)) {
            $data['title'] = sprintf('%s: %s', $data['title'], $action);
            $testClass = new Test();
            $testClass->$action();
        }
        // Render
        $data['root'] = Request::root();
        return View::render(__FUNCTION__, $data);
    }
}
