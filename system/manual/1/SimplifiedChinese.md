# CodeMommy WebPHP V1 开发手册

关于CodeMommy WebPHP的说明、QA等信息，请访问[官方网站](http://www.codemommy.com/)。

## 安装

在PHP5.5.9及以上版本的环境下，安装CodeMommy WebPHP有两种方式：

### Composer安装方式（推荐）

CodeMommy WebPHP使用Composer进行包管理，此安装方法需要您了解Composer，您只需要执行下面的命令即可。

```bash
composer create-project codemommy/webphp
```

### 压缩包安装方式

直接访问[此链接](https://github.com/CodeMommy/WebPHP/releases)下载相应版本的压缩包，然后解压缩。

通过上述方式安装后，您将看到如下目录：

| 目录         | 功能                                               |
| :---------- | :------------------------------------------------ |
| application | 项目目录，项目相关的控制器、模板等文件都放在此目录            |
| public      | 网站根目录，您需要把网站的根指向此目录                    |
| vendor      | Composer生成的包目录，您依然不需要手工更改此目录里的任何文件 |

> 访问项目public目录，您将看到“Hello World”字样，这说明CodeMommy WebPHP安装成功。

## 服务器配置

默认情况下，您可以通过类似“http://www.domain.com/index.php/hello”这样的URL访问，如果您想去掉URL中间的index.php，那么您需要对服务器进行配置。

### Apache

在CodeMommy WebPHP的public目录，已经包含相应的.htaccess文件。您可以对此文件进行修改。

```Apache
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
```

### NGINX

```Nginx
location / {
    index index.html index.htm index.php;
    if (!-e $request_filename){
        rewrite ^/(.*)$ /index.php/$1 last;
    }
}
location ~ \.php {
    fastcgi_pass unix:/var/run/php5-fpm.sock;
    fastcgi_index index.php;
    fastcgi_split_path_info ^(.+\.php)(.*)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}
```

## 基础

使用CodeMommy WebPHP开发，您只需要对public目录和application目录里的文件进行修改。

## 组件

### Cookie

### Is