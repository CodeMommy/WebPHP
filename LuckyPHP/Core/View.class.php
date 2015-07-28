<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

class View
{
	public static function showPage($view, $data=null)
	{
		$smarty = new Smarty(); // 建立smarty实例对象$smarty 
        $smarty->setTemplateDir(APPLICATION_ROOT. "/View/"); // 设置模板目录 
        $smarty->setCompileDir(APPLICATION_ROOT. "/Runtime/SmaryTemplate/"); // 设置编译目录 
        $smarty->setCacheDir(APPLICATION_ROOT."/Runtime/SmaryCache/"); // 缓存目录 
        $smarty->debugging = false; // 缓存方式 
		foreach($data as $key => $value){
			$smarty->assign($key, $value);
		}
		$smarty->display($view);
	}
	
	public static function showJSON($data)
	{
		echo json_encode($data);
	}
}