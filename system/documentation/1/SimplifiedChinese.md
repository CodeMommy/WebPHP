# LuckyPHP V1 开发手册

## Composer Install

```Composer
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:ShareAny/LuckyPHP.git"
        },
        {
            "type": "composer",
            "url": "http://packagist.phpcomposer.com"
        },
        {
            "packagist": false
        }
    ],
    "require": {
        "shareany/luckyphp": "dev-master"
    }
}
```

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

| Folder      | Function           |
| :---------- | :----------------- |
| application | Application        |
| public      | Public File        |
| system      | LuckyPHP Framework |
| vendor      | Vendor by Composer |