<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

use LuckyPHP\Controller;
use LuckyPHP\View;
use LuckyPHP\URL;

class IndexController extends Controller
{
    public function index()
    {
        $domainHome = array();
        array_push($domainHome, 'www.luckyphp.com');
        array_push($domainHome, 'home.luckyphp.com');
        $domain = $_SERVER['SERVER_NAME'];
        if (in_array($domain, $domainHome)) {
            $data = array();
            $root = URL::root();
            $static = $root . '/static';
            $data['static'] = $static;
            View::showPage('index/index.html', $data);
        } else {
            $data = array();
            View::showPage('index/start.html', $data);
        }
    }

}