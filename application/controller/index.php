<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

use CodeMommy\WebPHP\Controller;
use CodeMommy\WebPHP\Output;
use CodeMommy\WebPHP\Me;

class IndexController extends Controller
{
    public function index()
    {
        $data = array();
        $data['root'] = Me::root();
        return Output::template('index/index.tpl', $data);
    }
}