<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

use LuckyPHP\Output;

class Debug
{
    public static function show($data, $isExit = false)
    {
        Output::text('<pre>');
        var_dump($data);
        Output::text('</pre>');
        if ($isExit) {
            exit();
        }
        return true;
    }
}