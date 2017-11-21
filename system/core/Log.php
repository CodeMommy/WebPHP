<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class Log
 * @package CodeMommy\WebPHP
 */
class Log
{
    private $logFile = null;
    private $logName = null;

    /**
     * Log constructor.
     *
     * @param $logName
     * @param $logFile
     */
    public function __construct($logName, $logFile)
    {
        $this->logFile = $logFile;
        $this->logName = $logName;
    }

    /**
     * Debug
     * @param $message
     * @param array $array
     */
    public function debug($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::DEBUG));
        $log->addDebug($message, $array);
    }

    /**
     * Info
     * @param $message
     * @param array $array
     */
    public function info($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::INFO));
        $log->addInfo($message, $array);
    }

    /**
     * Notice
     * @param $message
     * @param array $array
     */
    public function notice($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::NOTICE));
        $log->addNotice($message, $array);
    }

    /**
     * Warning
     * @param $message
     * @param array $array
     */
    public function warning($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::WARNING));
        $log->addWarning($message, $array);
    }

    /**
     * Error
     * @param $message
     * @param array $array
     */
    public function error($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::ERROR));
        $log->addError($message, $array);
    }

    /**
     * Critical
     * @param $message
     * @param array $array
     */
    public function critical($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::CRITICAL));
        $log->addCritical($message, $array);
    }

    /**
     * Alert
     * @param $message
     * @param array $array
     */
    public function alert($message, $array = array())
    {
        $log = new Logger($this->logName);
        $log->pushHandler(new StreamHandler($this->logFile, Logger::ALERT));
        $log->addAlert($message, $array);
    }
}
