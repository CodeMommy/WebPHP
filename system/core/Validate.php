<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

class Validate
{
    public static function email($email)
    {
        if (preg_match("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+", $email)) {
            return true;
        } else {
            return false;
        }
    }

    public static function mobilephone($number)
    {
        if (preg_match("/^1[34578]\d{9}$/", $number)) {
            return true;
        } else {
            return false;
        }
    }
}