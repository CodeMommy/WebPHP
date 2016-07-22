<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

use Illuminate\Database\Capsule\Manager;

class Database extends Manager
{
    public function __construct()
    {
        parent::__construct();
        $databaseType = Configure::get('database', 'type');
        $database = Configure::get('database', $databaseType);
        $database['driver'] = $databaseType;
        $this->addConnection($database);
        $this->setAsGlobal();
        $this->bootEloquent();
    }
}

//use RedBeanPHP\R;
//class Database extends R
//{
//    public static function init()
//    {
//        $databaseType = Configure::get('database', 'type');
//        if ($databaseType == 'mysql') {
//            $databaseConfigure = Configure::get('database', 'mysql');
//            self::setup('mysql:host=' . $databaseConfigure['host'] . ';dbname=' . $databaseConfigure['databasename'], $databaseConfigure['account'], $databaseConfigure['password']); //for both mysql or mariaDB
//        } else {
//            self::setup();
//        }
//    }
//}