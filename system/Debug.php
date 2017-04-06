<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

class Debug
{
    public static function show($data = null, $isExit = false)
    {
        dump($data);
        if ($isExit) {
            exit();
        }
        return true;
    }
}