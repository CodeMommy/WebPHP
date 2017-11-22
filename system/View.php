<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\ConfigPHP\Config;
use Smarty;

/**
 * Class View
 * @package CodeMommy\WebPHP
 */
class View
{
    /**
     * View constructor.
     */
    public function __construct()
    {
    }

    /**
     * Render
     * @param string $view
     * @param array $data
     *
     * @return null
     */
    public static function render($view = '', $data = array())
    {
        $smarty = new Smarty();
        $smarty->setTemplateDir(Application::getPath('view'));
        $smarty->setCompileDir(Application::getPath('_runtime/view_template'));
        $smarty->setCacheDir(Application::getPath('_runtime/view_cache'));
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
