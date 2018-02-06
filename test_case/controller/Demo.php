<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Controller;

use CodeMommy\RequestPHP\Request;
use CodeMommy\ViewPHP\View;
use CodeMommy\AutoloadPHP\Autoload;

/**
 * Class Demo
 * @package Controller
 */
class Demo
{
    /**
     * Demo constructor.
     */
    public function __construct()
    {
    }

    /**
     * Get Demo List
     * @param string $demoLibraryPath
     * @param string $demoLibraryNamespace
     * @return array
     */
    private function getDemoList($demoLibraryPath = '', $demoLibraryNamespace = '\\')
    {
        $demoMethods = array();
        $directory = dir($demoLibraryPath);
        while (($file = $directory->read()) !== false) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filePath = $directory->path . '/' . $file;
            if (!is_file($filePath)) {
                continue;
            }
            $fileName = explode('.', $file)[0];
            $demoMethod = get_class_methods($demoLibraryNamespace . '\\' . $fileName);
            if (!is_array($demoMethod)) {
                continue;
            }
            sort($demoMethod);
            foreach ($demoMethod as $method) {
                if ($method != '__construct') {
                    array_push($demoMethods, array($fileName, $method));
                }
            }
        }
        return $demoMethods;
    }

    /**
     * Index
     * @return mixed
     */
    public function index()
    {
        $demoLibraryPath = sprintf('%s/../library/Demo', __DIR__);
        $demoLibraryNamespace = 'Library\\Demo';
        Autoload::directory($demoLibraryPath, '\\' . $demoLibraryNamespace);
        $data = array();
        $data['demoList'] = $this->getDemoList($demoLibraryPath, $demoLibraryNamespace);
        // Title
        $title = 'CodeMommy WebPHP Demo';
        $controller = Request::inputGet('controller', '');
        $action = Request::inputGet('action', '');
        $data['title'] = $title;
        if (!empty($controller) && !empty($action)) {
            $data['title'] = sprintf('%s: %s->%s', $title, $controller, $action);
            $className = sprintf('\\%s\\%s', $demoLibraryNamespace, $controller);
            $class = new $className();
            $class->$action();
        }
        // Render
        $data['controller'] = $controller;
        $data['action'] = $action;
        $data['root'] = Request::root();
        return View::render('demo', $data);
    }
}
