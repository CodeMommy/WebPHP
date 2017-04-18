<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\ConfigPHP\Config;
use Smarty;

class View
{
    public static function render($view, $data = array())
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
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $smarty->assign($key, $value);
            }
        }
        $view .= '.tpl';
        $smarty->display($view);
        return null;
    }
}