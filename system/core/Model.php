<?php

/**
 * CodeMommy Web for PHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Web;

use  Illuminate\Database\Eloquent\Model as M;
use CodeMommy\Web\Database;

class Model extends M
{
    public function __construct()
    {
        parent::__construct();
        new Database();
    }
}