<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

use LuckyPHP\Controller;
use LuckyPHP\View;

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
            View::showPage('index/index.html', $data);
        } else {
            $data = array();
            View::showPage('index/start.html', $data);
        }
    }

}