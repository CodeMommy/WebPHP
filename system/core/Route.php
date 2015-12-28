<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

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
        $routeConfigure = Configure::get('route', 'route');
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
    }

    public static function init()
    {
        $routeType = Configure::get('route', 'type');
        if ($routeType == 'custom') {
            self::custom();
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