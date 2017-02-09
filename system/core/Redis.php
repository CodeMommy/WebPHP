<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\WebPHP\Config;
use Redis as Re;

class Redis extends Re
{
    public function __construct()
    {
        parent::__construct();
        $redisHost = Config::get('redis.host');
        $redisPort = Config::get('redis.port');
        $this->connect($redisHost, $redisPort);
    }
}