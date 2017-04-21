<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

/**
 * Class Debug
 * @package CodeMommy\WebPHP
 */
class Debug
{
    /**
     * @param null $data
     * @param bool $isExit
     *
     * @return bool
     */
    public static function show($data = null, $isExit = false)
    {
        dump($data);
        if ($isExit) {
            exit();
        }
        return true;
    }
}