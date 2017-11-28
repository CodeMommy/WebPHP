<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\AutoloadPHP\Autoload;
use CodeMommy\CachePHP\Cache;
use CodeMommy\ConfigPHP\Config;
use CodeMommy\DatabasePHP\Database;
use CodeMommy\DebugPHP\Debug;
use CodeMommy\ViewPHP\View;

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
     * Get Run Time Path
     * @param string $path
     * @return string
     */
    public static function getRunTimePath($path = '')
    {
        $runTimePath = '_runtime';
        $path = ltrim($path, '/\\');
        $path = sprintf('%s%s%s', $runTimePath, DIRECTORY_SEPARATOR, $path);
        return self::getPath($path);
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
        Environment::setFile(Application::getPath('config/environment.yaml'));
        Config::setRoot(self::getPath('config'));
        // Debug
        $isDebug = Config::get('application.debug', false);
        $isDebug ? Debug::on() : Debug::off();
        // Autoload
        Autoload::directory(self::getPath('controller'), 'Controller');
        Autoload::directory(self::getPath('model'), 'Model');
        Autoload::directory(self::getPath(''), '');
        // Load Library
        $library = Config::get('library', array());
        if (is_array($library)) {
            foreach ($library as $key => $value) {
                $file = self::getPath('library/' . $value);
                Autoload::file($file, $key);
            }
        }
        // Database
        $databaseType = Config::get('database.type');
        $databaseConfig = Config::get('database.' . $databaseType);
        $databaseConfig['driver'] = $databaseType;
        Database::setConfig($databaseConfig);
        Database::instance();
        // View
        View::setDebug($isDebug);
        View::setPath(self::getPath('view'));
        View::setCompilePath(self::getRunTimePath('view_template'));
        View::setCachePath(self::getRunTimePath('view_cache'));
        // Other
        Cache::setConfig(Config::get('cache'));
        Route::start();
        // Return
        return true;
    }
}
