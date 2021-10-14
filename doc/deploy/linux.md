## Linux 主机环境

部分 Linux 主机由于设置了 `open_basedir` （可将用户访问文件的范围限制在指定区域，通常是入口文件根目录的路径），导致 ginkgo 访问白屏或报错。

如果把 ginkgo 部署在 LAMP / LNMP 环境下极有可能出现白屏，此时需要开启 php 错误提示来判断是否因为设置 `open_basedir` 而出错。

打开 `php.ini` 搜索 `display_errors`，把 Off 改为 On 开启 php 错误提示，访问之前白屏的页面会出现错误信息。

如果错误信息如下那么很有可能就是因为 `open_basedir` 的问题。

    Warning: require(): open_basedir restriction in effect. File(/home/wwwroot/ginkgo/boot.php) is not within the allowed path(s): (/home/wwwroot/public/:/tmp/:/proc/) in /home/wwwroot/public/index.php on line 20

    Warning: require(/home/wwwroot/ginkgo/boot.php): failed to open stream: Operation not permitted in /home/wwwroot/public/index.php on line 20

    Fatal error: require(): Failed opening required '/home/wwwroot/public/../ginkgo/boot.php' (include_path='.:/www/server/php/56/lib/php') in /home/wwwroot/public/index.php on line 20


----------

##### php.ini 修改方法

把权限作用域由入口文件目录修改为框架根目录，打开 `php.ini` 搜索 `open_basedir`，把

``` clike
open_basedir = "/home/wwwroot/ginkgo/public/:/tmp/:/var/tmp/:/proc/"
```

修改为

``` clike
open_basedir = "/home/wwwroot/ginkgo/:/tmp/:/var/tmp/:/proc/"
```

如果你的 php.ini 文件的 `open_basedir` 设置选项是被注释的或者为 none，那么你需要通过 Apache 或者 Nginx 来修改

php.ini 文件通常是在 `/usr/local/php/etc` 目录中，当然了这取决于你 LAMP 环境配置

----------

##### Apache 修改方法

Apache 需要修改 `httpd.conf` 或者同目录下的 `vhost` 目录下 `域名.conf` 文件，如果你的生产环境是 LAMP 一键安装包配置，那么多半就是直接修改 `域名.conf` 文件

    apache
    +-- vhost
    |   +-- www.baigo.net.conf
    |   +--  ...
    +-- httpd.conf

打开 `域名.conf` 文件，搜索 `open_basedir`,把

``` clike
php_admin_value open_basedir "/home/wwwroot/www.baigo.net/public/:/tmp/:/var/tmp/:/proc/"
```

修改为

``` clike
php_admin_value open_basedir "/home/wwwroot/www.baigo.net/:/tmp/:/var/tmp/:/proc/"
```

然后重新启动 apache 即可生效

`域名.conf` 文件通常是在 `/usr/local/apache/conf` 目录中，当然了这取决于你 LAMP 环境配置

----------

##### Nginx / Tengine 修改方法

Nginx 需要修改 `nginx.conf` 或者 `conf/vhost` 目录下 `域名.conf` 文件，如果你的生产环境是 LNMP / LTMP 一键安装包配置那么多半就是直接修改 `域名.conf` 文件

    nginx
    +-- conf
    |   +-- vhost
    |   |   +-- www.baigo.net.conf
    |   +-- nginx.conf
    |   +--  ...
    +-- nginx.conf

打开 `域名.conf` 文件，搜索 `open_basedir`，把

``` clike
fastcgi_param  PHP_VALUE  "open_basedir=/home/wwwroot/www.baigo.net/public/:/tmp/:/proc/";
```

修改为

``` clike
fastcgi_param  PHP_VALUE  "open_basedir=/home/wwwroot/www.baigo.net/:/tmp/:/proc/";
```

然后重新启动 Nginx 即可生效

`域名.conf` 文件通常是在 `/usr/local/nginx/conf/vhost` 目录中，当然了这取决于你 LNMP / LTMP 环境配置

----------

##### fpm / fastcgi 修改方法

打开项目根目录下找到 `user.ini` 文件，搜索 `open_basedir`，把

``` clike
open_basedir=/home/wwwroot/www.baigo.net/public/:/tmp/:/proc/
```

修改为

``` clike
open_basedir=/home/wwwroot/www.baigo.net/:/tmp/:/proc/
```

然后重新启动 Web 服务器，即可生效
