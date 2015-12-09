# LuckyPHP

## Overview

LuckyPHP is a light and fast PHP framework. It helps you to build a website easily.

You can use Composer to update the vendor. Take it easy if do not know about Composer. It still work best without Composer. We normally provide the base vendor. Just download it.

Visit the [Project Homepage](http://www.LuckyPHP.com/) to get more information or QA on the forum.

## Download

| Version     | Update Time              |
| :--------- | :-------------------- |
| [Latest](https://github.com/ShareAny/LuckyPHP/archive/master.zip)  | Now |

## URL Rewrite

### Apache

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

## Folder

| Folder     | Function              |
| :--------- | :-------------------- |
| configure  | Application Configure |
| controller | Application Controller|
| framework  | LuckyPHP Framework    |
| library    | Library               |
| runtime    | Application Runtime   |
| static     | Static Files          |
| vendor     | Vendor by Composer    |
| view       | Application View      |

## Author

| Author            | Identity  | Social |
| :---------------- | :-------- | :----- |
| Candison November | Creator   |[Website](http://www.kandisheng.com/) [Github](https://github.com/KanDisheng)|

## Plan

* Http::Get
* Http::Post
* Mail
* Upload
* File
* Log
* Cache
* Redis
* Mongodb