<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

class Router
{
    public static function init()
    {
        $filePath = strtolower($_SERVER['SCRIPT_NAME']);
        $fileURL = strtolower($_SERVER['REQUEST_URI']);
        // Delete index.php in path
        $filePathArray = explode('/', $filePath);
        $fileName = end($filePathArray);
        $fileDes = strpos($fileURL, $fileName);
        if ($fileDes === false) {
            $s1 = substr($filePath, 0, strlen($filePath)-strlen($fileName)-1);
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
        require_once(APPLICATION_ROOT . '/Controller/' . $controllerName . '.class.php');
        $controller = $controllerName . 'Controller';
        $urlArray = new $controller();
        $urlArray->$actionName();
        return true;
    }

    public static function redirect($url)
    {
        header('Location:' . $url);
        return true;
    }
}