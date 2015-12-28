<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

class URL
{
    public static function root()
    {
        $filePath = strtolower($_SERVER['SCRIPT_NAME']);
        $filePathArray = explode('/', $filePath);
        $fileName = end($filePathArray);
        $urlFull = substr($filePath, 0, strlen($filePath) - strlen($fileName) - 1);
        return $urlFull;
    }
}