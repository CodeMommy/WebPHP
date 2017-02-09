<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use  Illuminate\Database\Eloquent\Model as M;
use CodeMommy\WebPHP\Database;

class Model extends M
{
    public function __construct()
    {
        parent::__construct();
        new Database();
    }
}