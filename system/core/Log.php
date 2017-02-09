<?php

/**
 * CodeMommy Web for PHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Web;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    private $logFile = null;
    private $logName = null;

    public function __construct($logName, $logFile)
    {
        $this->logFile = $logFile;
        $this->logName = $logName;
    }

    public function debug($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::DEBUG));
        $log->addDebug($message, $array);
    }

    public function info($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::INFO));
        $log->addInfo($message, $array);
    }

    public function notice($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::NOTICE));
        $log->addNotice($message, $array);
    }

    public function warning($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::WARNING));
        $log->addWarning($message, $array);
    }

    public function error($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::ERROR));
        $log->addError($message, $array);
    }

    public function critical($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::CRITICAL));
        $log->addCritical($message, $array);
    }

    public function alert($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::ALERT));
        $log->addAlert($message, $array);
    }
}