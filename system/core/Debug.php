<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\WebPHP\Output;

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