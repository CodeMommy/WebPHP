<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use Whoops\Util\Misc;

/**
 * Class Debug
 * @package CodeMommy\WebPHP
 */
class Debug
{
    /**
     * Debug constructor.
     */
    public function __construct()
    {
    }

    /**
     * Show
     * @param null $data
     * @param bool $isExit
     *
     * @return bool
     */
    public static function show($data = null, $isExit = false)
    {
        if (Misc::isAjaxRequest()) {
            var_dump($data);
        } else {
            dump($data);
        }
        if ($isExit) {
            exit();
        }
        return true;
    }
}
