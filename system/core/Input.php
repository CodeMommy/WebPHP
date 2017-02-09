<?php

/**
 * CodeMommy Web for PHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Web;

class Input
{
    public static function get($key, $default = null)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
        return $default;
    }

    public static function post($key, $default = null)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
        return $default;
    }

    public static function any($key, $default = null)
    {
        if (isset($_REQUEST[$key])) {
            return $_REQUEST[$key];
        }
        return $default;
    }

    public static function raw()
    {
        if (isset($GLOBALS['HTTP_RAW_POST_DATA'])) {
            return $GLOBALS['HTTP_RAW_POST_DATA'];
        }
        return file_get_contents('php://input');
    }

    public static function file($formname, $path, $rename = null)
    {
        if ($_FILES[$formname]['name'] != '') {
            if ($_FILES[$formname]['error'] > 0) {
                return false;
            } else {
                $fileOld = pathinfo($_FILES[$formname]['name']);
                $fileOldExtension = $fileOld['extension'];
                if ($rename) {
                    $filenameNew = $rename . '.' . $fileOldExtension;
                } else {
                    $filenameNew = $_FILES[$formname]['name'];
                }
                $filenameNew = $path . $filenameNew;
                if (move_uploaded_file($_FILES[$formname]['tmp_name'], $filenameNew)) {
                    return $filenameNew;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}