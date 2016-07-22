<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

use  Illuminate\Database\Eloquent\Model as M;
use LuckyPHP\Database;

class Model extends M
{
    public function __construct()
    {
        parent::__construct();
        new Database();
    }
}