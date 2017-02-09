<?php

/**
 * CodeMommy Web for PHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Web;

use CodeMommy\Web\Output;

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