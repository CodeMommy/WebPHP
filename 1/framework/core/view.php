<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

use Smarty;

class View
{
    public static function showPage($view, $data = null)
    {
        $smarty = new Smarty(); // 建立smarty实例对象$smarty
        $smarty->setTemplateDir(APPLICATION_ROOT . "/view/"); // 设置模板目录
        $smarty->setCompileDir(APPLICATION_ROOT . "/runtime/SmartyTemplate/"); // 设置编译目录
        $smarty->setCacheDir(APPLICATION_ROOT . "/runtime/SmartyCache/"); // 缓存目录
        $smarty->debugging = false; // 缓存方式
        $smarty->left_delimiter = '{% ';
        $smarty->right_delimiter = ' %}';
        if ($data) {
            foreach ($data as $key => $value) {
                $smarty->assign($key, $value);
            }
        }
        $smarty->display($view);
    }

    public static function showJSON($data)
    {
        echo json_encode($data);
    }
}