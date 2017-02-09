<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

class Is
{
    private static function show($status = true, $message = '')
    {
        $return = array();
        $return['status'] = $status;
        $return['message'] = $message;
        return $return;
    }

    public static function php()
    {
        return self::show(true, '');
    }

    public static function email($email)
    {
        if (preg_match('/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/', $email)) {
            return self::show(true, '');
        }
        return self::show(false, '');
    }

    public static function chinaMobilephoneNumber($number)
    {
        if (preg_match('/^1[34578]\d{9}$/', $number)) {
            return self::show(true, '');
        }
        return self::show(false, '');
    }
}