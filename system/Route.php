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
     * Route constructor.
     */
    public function __construct()
    {
    }

//    /**
//     * Get Path
//     * @return string
//     */
//    private static function getPath()
//    {
//        $scriptName = $_SERVER['SCRIPT_NAME'];
//        $scriptName = str_replace(array('/', '\\'), '/', $scriptName);
//        $requestURI = $_SERVER['REQUEST_URI'];
//        $url = parse_url($requestURI);
//        $path = $url['path'];
//        if (substr($path, 0, strlen($scriptName)) == $scriptName) {
//            $path = substr($path, strlen($scriptName));
//        } else {
//            $pathRoot = explode('/', $scriptName);
//            array_pop($pathRoot);
//            array_shift($pathRoot);
//            $pathRoot = implode('/', $pathRoot);
//            $pathRoot = sprintf('/%s', $pathRoot);
//            if (substr($path, 0, strlen($pathRoot)) == $pathRoot) {
//                $path = substr($path, strlen($pathRoot));
//            }
//        }
//        $path = trim($path, '/');
//        return $path;
//    }

    /**
     * Get Route Config
     * @return array
     */
    private static function getRouteConfig()
    {
        $routeConfigureAny = Config::get('route.any', array());
        $routeConfigureCustom = Config::get('route.' . strtolower($_SERVER['REQUEST_METHOD']), array());
        $routeConfig = array_merge($routeConfigureAny, $routeConfigureCustom);
        return $routeConfig;
    }

    /**
     * Route
     * @param string $route
     *
     * @return bool
     */
    private static function route($route = '')
    {
        if ($route) {
            $path = explode('.', $route);
            $actionName = array_pop($path);
            $controllerName = array_pop($path);
            $namespace = implode('\\', $path);
            if (!empty($namespace)) {
                $namespace .= '\\';
            }
            $namespace = '\\Controller\\' . $namespace . $controllerName;
            $class = new $namespace();
            $result = $class->$actionName();
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
     * Path Info
     * @return bool
     */
    private static function pathInfo()
    {
//        $pathInfo = self::getPath();
//        $pathInfo = '/' . $pathInfo;
        $request = Request::createFromGlobals();
        $pathInfo = $request->getPathInfo();
        // Set Controller and Action
        $urlArray = explode('/', $pathInfo);
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
                    $_GET[$urlArray[$key - 1]] = empty($value) ? '' : $value;
                }
            }
        }
        $route = $controllerName . 'Controller.' . $actionName;
        return self::route($route);
    }

    /**
     * Map
     * @return bool
     */
    private static function map()
    {
//        $pathInfo = self::getPath();
        $request = Request::createFromGlobals();
        $pathInfo = $request->getPathInfo();
        $pathInfo = trim($pathInfo, '/');
        $routeConfigure = self::getRouteConfig();
        foreach ($routeConfigure as $key => $value) {
            if ($pathInfo == trim($key, '/')) {
                return self::route($value);
            }
        }
        return self::route('');
    }

    /**
     * Symfony
     * @return bool
     */
    private static function symfony()
    {
        $routeConfigure = self::getRouteConfig();
        $routes = new RouteCollection();
        foreach ($routeConfigure as $key => $value) {
            $routes->add($key, new Routes($key));
        }
//        $requestURI = $_SERVER['REQUEST_URI'];
//        $_SERVER['REQUEST_URI'] = '/' . self::getPath();
        $request = Request::createFromGlobals();
//        $_SERVER['REQUEST_URI'] = $requestURI;
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
        return self::route($route);
    }

    /**
     * Start
     * @return bool|void
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
