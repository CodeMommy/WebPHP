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

    /**
     * Get Route Config
     * @return array
     */
    private static function getRouteConfig()
    {
        $requestMethod = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : '';
        $routeConfigureAny = Config::get('route.any', array());
        $routeConfigureCustom = Config::get('route.' . $requestMethod, array());
        $routeConfig = array_merge($routeConfigureAny, $routeConfigureCustom);
        return $routeConfig;
    }

    /**
     * Render
     * @param string $route
     *
     * @return bool
     */
    private static function render($route = '')
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
     * Type Path Info
     * @return bool
     */
    private static function typePathInfo()
    {
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
        $route = $controllerName . '.' . $actionName;
        return self::render($route);
    }

    /**
     * Type Map
     * @return bool
     */
    private static function typeMap()
    {
        $request = Request::createFromGlobals();
        $pathInfo = $request->getPathInfo();
        $pathInfo = trim($pathInfo, '/');
        $routeConfigure = self::getRouteConfig();
        foreach ($routeConfigure as $key => $value) {
            if ($pathInfo == trim($key, '/')) {
                return self::render($value);
            }
        }
        return self::render('');
    }

    /**
     * Type Symfony
     * @return bool
     */
    private static function typeSymfony()
    {
        $routeConfigure = self::getRouteConfig();
        $routes = new RouteCollection();
        foreach ($routeConfigure as $key => $value) {
            $routes->add($key, new Routes($key));
        }
        $request = Request::createFromGlobals();
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
        return self::render($route);
    }

    /**
     * Start
     * @return bool|void
     */
    public static function start()
    {
        $routeType = Config::get('route.type');
        if ($routeType == 'symfony') {
            self::typeSymfony();
        } else if ($routeType == 'map') {
            self::typeMap();
        } else {
            self::typePathInfo();
        }
    }
}
