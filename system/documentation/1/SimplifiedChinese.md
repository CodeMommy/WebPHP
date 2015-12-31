# LuckyPHP V1 开发手册

## 一、安装

您有两种安装LuckyPHP的方法

### 方式一：Composer安装方式（推荐）

LuckyPHP使用Composer进行包管理，此安装方法需要您了解Composer，您只需要执行下面的命令即可。

```Linux
composer create-project shareany/luckyphp
```

### 方式二：下载安装包

直接访问[此链接](https://github.com/ShareAny/LuckyPHP/releases)下载相应版本的压缩包，然后解压缩。

## 二、成功安装

在PHP的环境下，访问项目public目录，您将看到“Hello World”字样，这说明LuckyPHP安装成功。

## 三、服务器配置

默认情况下，您可以通过访问“http://www.domain.com/public/index.php/hello”这样的网址访问，如果您想去掉中间的public和index.php，那么您需要对服务器进行配置。

### Apache

默认情况下，在LuckyPHP的public目录，已经包含相应的.htaccess文件。您可以对此文件进行修改。

```Apache
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
```

### Nginx

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

## 四、目录说明

| 目录         | 功能           |
| :---------- | :----------------- |
| application | 项目目录，项目相关的控制器、模板等文件都放在此处            |
| public      | 网站根目录，您需要把网站的根指向此目录                    |
| system      | LuckyPHP的目录，您不需要对此目录里的文件做任何更改         |
| vendor      | Composer生成的包目录，您依然不需要手工更改此目录里的任何文件 |