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
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'LuckyPHP';
        View::showPage('index/index.html', $data);
    }

}