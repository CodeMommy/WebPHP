<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route as Routes;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;

class Route
{
    private static function pathInfo()
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
        // Do
        $file = APPLICATION_ROOT . '/controller/' . strtolower($controllerName) . '.php';
        if (is_file($file)) {
            require_once($file);
            $controller = $controllerName . 'Controller';
            $urlArray = new $controller();
            $urlArray->$actionName();
            return true;
        } else {
            return false;
        }
    }

    private static function custom()
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
        $routeConfigure = array();
        $routeConfigureAny = Configure::get('route', 'route.any');
        if ($routeConfigureAny) {
            $routeConfigure = array_merge($routeConfigure, $routeConfigureAny);
        }
        $routeConfigureCustom = Configure::get('route', 'route.' . strtolower($_SERVER['REQUEST_METHOD']));
        if ($routeConfigureCustom) {
            $routeConfigure = array_merge($routeConfigure, $routeConfigureCustom);
        }
        $route = null;
        $route = isset($routeConfigure[$urlFull]) ? $routeConfigure[$urlFull] : $route;
        $route = isset($routeConfigure['/' . $urlFull]) ? $routeConfigure['/' . $urlFull] : $route;
        $route = isset($routeConfigure[$urlFull . '/']) ? $routeConfigure[$urlFull . '/'] : $route;
        $route = isset($routeConfigure['/' . $urlFull . '/']) ? $routeConfigure['/' . $urlFull . '/'] : $route;
        if ($route) {
            $path = explode('.', $route);
            $actionName = array_pop($path);
            $controllerName = array_pop($path);
            $controllerFileName = substr($controllerName, 0, strlen($controllerName) - 10);
            $controllerFileName = strtolower($controllerFileName);
            $pathNew = '';
            foreach ($path as $value) {
                $pathNew = $pathNew . $value . '/';
            }
            $file = APPLICATION_ROOT . '/controller/' . $pathNew . $controllerFileName . '.php';
            if (is_file($file)) {
                require_once($file);
                $urlArray = new $controllerName();
                $urlArray->$actionName();
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public static function symfony()
    {
        $routeConfigure = array();
        $routeConfigureAny = Configure::get('route', 'route.any');
        if ($routeConfigureAny) {
            $routeConfigure = array_merge($routeConfigure, $routeConfigureAny);
        }
        $routeConfigureCustom = Configure::get('route', 'route.' . strtolower($_SERVER['REQUEST_METHOD']));
        if ($routeConfigureCustom) {
            $routeConfigure = array_merge($routeConfigure, $routeConfigureCustom);
        }
        $routes = new RouteCollection();
        foreach ($routeConfigure as $key => $value) {
            $keyName = str_replace('/', 'love', $key);
            $keyName = str_replace('{', 'love', $keyName);
            $keyName = str_replace('}', 'love', $keyName);
            $keyName = 'route' . $keyName;
            $routeConfigure[$keyName] = $value;
            $routes->add($keyName, new Routes($key));
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
        if ($route) {
            $path = explode('.', $route);
            $actionName = array_pop($path);
            $controllerName = array_pop($path);
            $controllerFileName = substr($controllerName, 0, strlen($controllerName) - 10);
            $controllerFileName = strtolower($controllerFileName);
            $pathNew = '';
            foreach ($path as $value) {
                $pathNew = $pathNew . $value . '/';
            }
            $file = APPLICATION_ROOT . '/controller/' . $pathNew . $controllerFileName . '.php';
            if (is_file($file)) {
                require_once($file);
                $urlArray = new $controllerName();
                $urlArray->$actionName();
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public static function init()
    {
        $routeType = Configure::get('route', 'type');
        if ($routeType == 'custom') {
            self::custom();
        } else if ($routeType == 'symfony') {
            self::symfony();
        } else {
            self::pathInfo();
        }
    }

    public static function redirect($url)
    {
        header('Location:' . $url);
        return true;
    }
}