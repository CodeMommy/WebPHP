<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

use RedBeanPHP\R;

class Database extends R
{
    public static function init()
    {
        $databaseConfigure = Configure::get('database');
        if ($databaseConfigure['type'] == 'mysql') {
            self::setup('mysql:host=' . $databaseConfigure['host'] . ';dbname=' . $databaseConfigure['databasename'], $databaseConfigure['account'], $databaseConfigure['password']); //for both mysql or mariaDB
        } else {
            self::setup();
        }
    }
}