<?php

/**
 * CodeMommy Web for PHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Web;

class Convert
{
    public static function arrayToJSON($array)
    {
        return json_encode($array);
    }
}