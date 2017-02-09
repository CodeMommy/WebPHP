<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

class Convert
{
    public static function arrayToJSON($array)
    {
        return json_encode($array);
    }
}