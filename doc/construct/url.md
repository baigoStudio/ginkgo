## URL 访问

**URL 一律小写**

ginkgo 采用 PATH_INFO 访问地址，典型的 URL 访问规则如下

``` markup
http://server/index.php/模块/控制器/动作/参数-1/值-1/参数-2/值-2...
```

必要的时候，可以通过某种方式，省略 URL 里面的模块和控制器。

----------

##### 隐藏入口文件

出于优化的 URL 访问原则，还支持通过 URL 重写隐藏入口文件，下面以 Apache 为例说明隐藏入口文件 index.php 的设置。

下面是 Apache 的配置过程，可以参考下：

1. httpd.conf 配置文件中加载了 mod_rewrite.so 模块
2. AllowOverride None 将 None 改为 All
3. 在入口文件所在目录添加 .htaccess 文件，内容如下：

``` clike
<IfModule mod_rewrite.c>
    Options +FollowSymlinks -Multiviews
    RewriteEngine on
    
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
</IfModule>
```