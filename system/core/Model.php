<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use Illuminate\Database\Eloquent\Model as M;
use CodeMommy\WebPHP\Database;

/**
 * Class Model
 * @package CodeMommy\WebPHP
 */
class Model extends M
{
    /**
     * Model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        new Database();
    }
}