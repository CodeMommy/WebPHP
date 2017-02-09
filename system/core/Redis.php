<?php

/**
 * CodeMommy Web for PHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Web;

use CodeMommy\Web\Config;
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