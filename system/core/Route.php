<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route as Routes;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use CodeMommy\ConfigPHP\Config;

/**
 * Class Route
 * @package CodeMommy\WebPHP
 */
class Route
{
    /**
     * @return bool|string
     */
    private static function urlFull()
    {
        $filePath = strtolower($_SERVER['SCRIPT_NAME']);
        $fileURL = strtolower($_SERVER['REQUEST_URI']);
        // Delete index.php in path
        $filePathArray = explode('/', $filePath);
        $fileName = end($filePathArray);
        $fileDes = strpos($fileURL, $fileName);
        if ($fileDes === false) {
            $s1 = substr($filePath, 0, strlen($filePath) - strlen($fileName) - 1);
            $urlFull = substr($fileURL, strlen($s1));
        } else {
            $urlFull = substr($fileURL, strlen($filePath));
        }
        // Remove interference of question mark
        $url = strpos($urlFull, "?");
        if (!$url === false) {
            $urlFull = substr($urlFull, 0, $url);
        }
        // Route
        if (substr($urlFull, 0, 1) == '/') {
            $urlFull = substr($urlFull, 1);
        }
        if (substr($urlFull, -1, 1) == '/') {
            $urlFull = substr($urlFull, 0, strlen($urlFull) - 1);
        }
        return $urlFull;
    }

    /**
     * @return array
     */
    private static function routeConfig()
    {
        $routeConfig = array();
        $routeConfigureAny = Config::get('route.any');
        if ($routeConfigureAny) {
            $routeConfig = array_merge($routeConfig, $routeConfigureAny);
        }
        $routeConfigureCustom = Config::get('route.' . strtolower($_SERVER['REQUEST_METHOD']));
        if ($routeConfigureCustom) {
            $routeConfig = array_merge($routeConfig, $routeConfigureCustom);
        }
        return $routeConfig;
    }

    /**
     * @param $route
     *
     * @return bool
     */
    private static function route($route)
    {
        if ($route) {
            $path = explode('.', $route);
            $actionName = array_pop($path);
            $controllerName = array_pop($path);
// 已经autoload，不需要重新require
//            $pathNew = implode('/', $path);
//            if (!empty($pathNew)) {
//                $pathNew .= '/';
//            }
//            $file = APPLICATION_ROOT . '/Controller/' . $pathNew . $controllerName . '.php';
//            if (is_file($file)) {
//                require_once($file);
//                $namespace = implode('\\', $path);
//                if (!empty($namespace)) {
//                    $namespace .= '\\';
//                }
//                $namespace = '\\Controller\\' . $namespace . $controllerName;
//                $urlArray = new $namespace();
//                $urlArray->$actionName();
//                return true;
//            } else {
//                return false;
//            }
            $namespace = implode('\\', $path);
            if (!empty($namespace)) {
                $namespace .= '\\';
            }
            $namespace = '\\Controller\\' . $namespace . $controllerName;
            $urlArray = new $namespace();
            $result = $urlArray->$actionName();
            $type = gettype($result);
            $array = array('string', 'integer', 'double', 'boolean', 'array', 'object');
            if (in_array($type, $array)) {
                echo $result;
            }
            return true;
        }
        return false;
    }

    /**
     *
     */
    private static function pathInfo()
    {
        $urlFull = self::urlFull();
        $urlFull = '/' . $urlFull;
        // Set Controller and Action
        $urlArray = explode('/', $urlFull);
        $controllerName = 'index';
        if (!empty($urlArray[1])) {
            $controllerName = $urlArray[1];
        }
        $controllerName = ucfirst(strtolower($controllerName));
        $actionName = 'index';
        if (!empty($urlArray[2])) {
            $actionName = $urlArray[2];
        }
        // Parameter
        $urlList = array(0, 1, 2);
        foreach ($urlArray as $key => $value) {
            if (!in_array($key, $urlList)) {
                if ($key % 2 == 0) {
                    if (!empty($value)) {
                        $_GET[$urlArray[$key - 1]] = $value;
                    }
                }
            }
        }
        $route = $controllerName . 'Controller.' . $actionName;
        self::route($route);
    }

    /**
     *
     */
    private static function map()
    {
        $urlFull = self::urlFull();
        $routeConfigure = self::routeConfig();
        $route = null;
        $route = isset($routeConfigure[$urlFull]) ? $routeConfigure[$urlFull] : $route;
        $route = isset($routeConfigure['/' . $urlFull]) ? $routeConfigure['/' . $urlFull] : $route;
        $route = isset($routeConfigure[$urlFull . '/']) ? $routeConfigure[$urlFull . '/'] : $route;
        $route = isset($routeConfigure['/' . $urlFull . '/']) ? $routeConfigure['/' . $urlFull . '/'] : $route;
        self::route($route);
    }

    /**
     *
     */
    private static function symfony()
    {
        $routeConfigure = self::routeConfig();
        $routes = new RouteCollection();
        foreach ($routeConfigure as $key => $value) {
//            $keyName = str_replace('/', 'love', $key);
//            $keyName = str_replace('{', 'love', $keyName);
//            $keyName = str_replace('}', 'love', $keyName);
//            $keyName = 'route' . $keyName;
            $keyName = 'route' . $key;
            $routeConfigure[$keyName] = $value;
            $routes->add($keyName, new Routes($key));
        }
        $requestURI = $_SERVER['REQUEST_URI'];
        $_SERVER['REQUEST_URI'] = '/' . self::urlFull();
        $request = Request::createFromGlobals();
        $_SERVER['REQUEST_URI'] = $requestURI;
        $context = new RequestContext();
        $context->fromRequest($request);
        $matcher = new UrlMatcher($routes, $context);
        $pathInfo = $request->getPathInfo();
        $attributes = $matcher->match($pathInfo);
        foreach ($attributes as $key => $value) {
            if ($key != '_route') {
                $_GET[$key] = $value;
            }
        }
        $route = $attributes['_route'];
        $route = $routeConfigure[$route];
        self::route($route);
    }

    /**
     *
     */
    public static function start()
    {
        $routeType = Config::get('route.type');
        if ($routeType == 'symfony') {
            self::symfony();
        } else if ($routeType == 'map') {
            self::map();
        } else {
            self::pathInfo();
        }
    }
}