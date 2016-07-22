<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

use LuckyPHP\Controller;
use LuckyPHP\Output;
use LuckyPHP\Me;

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
            $root = Me::root();
            $static = $root . 'static';
            $data['static'] = $static;
            return Output::template('index/index.html', $data);
        } else {
            $data = array();
            return Output::template('index/start.html', $data);
        }
    }

}