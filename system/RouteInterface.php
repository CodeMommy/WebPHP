<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

/**
 * Interface RouteInterface
 * @package CodeMommy\WebPHP
 */
interface RouteInterface
{
    /**
     * RouteInterface constructor.
     */
    public function __construct();

    /**
     * Start
     * @return mixed
     */
    public static function start();
}
