<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use Carbon\Carbon;

/**
 * Class DateTime
 * @package CodeMommy\WebPHP
 */
class DateTime extends Carbon
{
    /**
     * DateTime constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}