<?php /* Smarty version 3.1.27, created on 2015-12-08 15:37:47
         compiled from "D:\Code\Product\LuckyPHP\view\Index\index.html" */ ?>
<?php
/*%%SmartyHeaderCode:240275666eb3becef35_45266593%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cee0ff12c8477e10f92637efe110e8f123a2120e' => 
    array (
      0 => 'D:\\Code\\Product\\LuckyPHP\\view\\Index\\index.html',
      1 => 1449583311,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '240275666eb3becef35_45266593',
  'variables' => 
  array (
    'world' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5666eb3bf3caa3_54326750',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5666eb3bf3caa3_54326750')) {
function content_5666eb3bf3caa3_54326750 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '240275666eb3becef35_45266593';
?>

<!DOCTYPE html>
<html>
<head>
    <title>LuckyPHP - a light and fast PHP framework</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0">
    <meta name="author" content="LuckyPHP.com">
    <meta name="keywords" content="LuckyPHP,light,fast,framework">
    <meta name="description" content="LuckyPHP is a light and fast PHP framework.">
    <link rel="stylesheet" href="http://www.bootcss.com/p/buttons/css/buttons.css">
    <style>
        *:focus { outline: none; }
        *{-webkit-tap-highlight-color:transparent; font-family: "Microsoft YaHei";}
        body {margin: 0px; background-color: #f6f6f6; }
        .container{width:100%; max-width: 640px; margin:auto;}
        h1{font-size: 30px; text-align: center; font-weight: bold;}
        .text{text-align: center;font-size: 14px;}
        .download{text-align: center;margin: 20px 0;}
        .github{text-align: center;margin: 20px 0;}
    </style>
</head>
<body>
<div class="container">
    <div>
        <h1><?php echo $_smarty_tpl->tpl_vars['world']->value;?>
</h1>
    </div>
    <div class="text">LuckyPHP is a light and fast PHP framework.</div>
    <div class="download"><a href="https://github.com/ShareAny/LuckyPHP/blob/master/Document/Download.md" target="_blank" class="button button-primary button-pill" title="Download">Download</a></div>
    <div class="github">
        <div class="github-card" data-github="ShareAny/LuckyPHP" data-width="400" data-height="" data-theme="default"></div>
        <?php echo '<script'; ?>
 src="//cdn.jsdelivr.net/github-cards/latest/widget.js"><?php echo '</script'; ?>
>
    </div>
</div>
</body></html><?php }
}
?>