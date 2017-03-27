<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\ConfigPHP\Config;
use Smarty;

class Output
{
    public static function template($view, $data = null)
    {
        $smarty = new Smarty();
        $smarty->setTemplateDir(APPLICATION_ROOT . '/view/');
        $smarty->setCompileDir(APPLICATION_ROOT . '/cache/smarty_template/');
        $smarty->setCacheDir(APPLICATION_ROOT . '/cache/smarty_cache/');
        $smarty->left_delimiter = '{';
        $smarty->right_delimiter = '}';
        $isDebug = Config::get('application.debug');
        $smarty->debugging = false;
        if ($isDebug == true) {
            $smarty->caching = false;
            $smarty->clearAllCache();
            $smarty->clearCompiledTemplate($view);
        } else {
            $smarty->caching = true;
        }
        if ($data) {
            foreach ($data as $key => $value) {
                $smarty->assign($key, $value);
            }
        }
        $view .= '.tpl';
        $smarty->display($view);
        return true;
    }

    public static function json($data)
    {
        echo json_encode($data);
        return true;
    }

    public static function text($data)
    {
        echo $data;
        return true;
    }

    public static function redirect($url)
    {
        header('Location:' . $url);
        return true;
    }
}