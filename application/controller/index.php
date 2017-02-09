<?php

/**
 * CodeMommy Web for PHP
 * @author  Candison November <www.kandisheng.com>
 */

use CodeMommy\Web\Controller;
use CodeMommy\Web\Output;
use CodeMommy\Web\Me;

class IndexController extends Controller
{
    public function index()
    {
        $domainHome = array('www.luckyphp.com', 'home.luckyphp.com');
        $domain = Me::domain();
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