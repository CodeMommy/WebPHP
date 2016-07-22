<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

namespace LuckyPHP;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    private $logfile = null;
    private $logname = null;

    public function __construct($logname, $logfile)
    {
        $this->logfile = $logfile;
        $this->logname = $logname;
    }

    public function debug($message, $array = array())
    {
        $log = new Logger($this->logname);
        $log->pushHandler(new StreamHandler($this->logfile, Logger::DEBUG));
        $log->addDebug($message, $array);
    }

    public function info($message, $array = array())
    {
        $log = new Logger($this->logname);
        $log->pushHandler(new StreamHandler($this->logfile, Logger::INFO));
        $log->addInfo($message, $array);
    }

    public function notice($message, $array = array())
    {
        $log = new Logger($this->logname);
        $log->pushHandler(new StreamHandler($this->logfile, Logger::NOTICE));
        $log->addNotice($message, $array);
    }

    public function warning($message, $array = array())
    {
        $log = new Logger($this->logname);
        $log->pushHandler(new StreamHandler($this->logfile, Logger::WARNING));
        $log->addWarning($message, $array);
    }

    public function error($message, $array = array())
    {
        $log = new Logger($this->logname);
        $log->pushHandler(new StreamHandler($this->logfile, Logger::ERROR));
        $log->addError($message, $array);
    }

    public function critical($message, $array = array())
    {
        $log = new Logger($this->logname);
        $log->pushHandler(new StreamHandler($this->logfile, Logger::CRITICAL));
        $log->addCritical($message, $array);
    }

    public function alert($message, $array = array())
    {
        $log = new Logger($this->logname);
        $log->pushHandler(new StreamHandler($this->logfile, Logger::ALERT));
        $log->addAlert($message, $array);
    }

}