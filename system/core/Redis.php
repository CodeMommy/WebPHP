<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

use LuckyPHP\Configure;
use Redis as Re;

class Redis extends Re
{
    public function __construct()
    {
        parent::__construct();
        $redisHost = Configure::get('redis','host');
        $redisPort = Configure::get('redis','port');
        $this->connect($redisHost, $redisPort);
    }
}