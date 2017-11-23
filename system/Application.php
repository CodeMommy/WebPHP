<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use Whoops\Run;
use Whoops\Util\Misc;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;
use CodeMommy\AutoloadPHP\Autoload;
use CodeMommy\CachePHP\Cache;
use CodeMommy\ConfigPHP\Config;

/**
 * Class Application
 * @package CodeMommy\WebPHP
 */
class Application
{
    /**
     * Application Root
     * @var string
     */
    private static $applicationRoot = '';

    /**
     * Application constructor.
     */
    public function __construct()
    {
    }

    /**
     * Get Path
     * @param string $path
     * @return string
     */
    public static function getPath($path = '')
    {
        $path = ltrim($path, '/\\');
        $path = sprintf('%s%s%s', self::$applicationRoot, DIRECTORY_SEPARATOR, $path);
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        return $path;
    }

    /**
     * Start
     * @param string $applicationRoot
     *
     * @return bool
     */
    public static function start($applicationRoot = '')
    {
        // Define Application Root
        $applicationRoot = rtrim($applicationRoot, '/\\');
        $applicationRoot = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $applicationRoot);
        self::$applicationRoot = $applicationRoot;
        // Config
        Config::setRoot(self::getPath('config'));
        // Debug
        $isDebug = Config::get('application.debug', false);
        if ($isDebug) {
            $whoops = new Run();
            if (Misc::isAjaxRequest()) {
                $whoops->pushHandler(new JsonResponseHandler());
            } else {
                $whoops->pushHandler(new PrettyPageHandler());
            }
            $whoops->register();
        }
        // Load Library
        $library = Config::get('library', array());
        if (is_array($library)) {
            foreach ($library as $key => $value) {
                $file = self::getPath('library/' . $value);
                Autoload::file($file, $key);
            }
        }
        // Other
        Autoload::directory(self::getPath('controller'), 'Controller');
        Autoload::directory(self::getPath('model'), 'Model');
        Autoload::directory(self::getPath(''), '');
        Cache::setConfig(Config::get('cache'));
        Route::start();
        return true;
    }
}
