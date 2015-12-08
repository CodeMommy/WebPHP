<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

class Debug
{
    public static function show($data, $isExit = false)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        if ($isExit) {
            exit();
        }
    }
}