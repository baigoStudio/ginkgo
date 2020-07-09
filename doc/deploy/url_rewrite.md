## URL 重写

可以通过URL重写隐藏应用的入口文件 `index.php`，下面是相关服务器的配置参考：

----------

##### Apache

1. httpd.conf 配置文件中加载了 mod_rewrite.so 模块
2. AllowOverride None 将 None 改为 All
3. 把下面的内容保存为 .htaccess 文件放到应用入口文件的同级目录下

``` clike
<IfModule mod_rewrite.c>
    Options +FollowSymlinks -Multiviews
    RewriteEngine on
    
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
</IfModule>
```

----------

##### IIS

如果你的服务器环境支持 ISAPI_Rewrite 的话，可以配置 httpd.ini 文件，添加下面的内容：

`0.1.1` 新增

``` clike
RewriteRule (.*)$ /index\.php\?pathname=$1 [I]
```

在 IIS 的高版本下面可以配置 web.Config，在中间添加 rewrite 节点：

``` markup
<rewrite>
    <rules>
        <rule name="OrgPage" stopProcessing="true">
            <match url="^(.*)$" />
            <conditions logicalGrouping="MatchAll">
                <add input="{HTTP_HOST}" pattern="^(.*)$" />
                <add input="{REQUEST_FILENAME}" matchType="IsFile" negate="true" />
                <add input="{REQUEST_FILENAME}" matchType="IsDirectory" negate="true" />
            </conditions>
            <action type="Rewrite" url="index.php/{R:1}" />
        </rule>
    </rules>
</rewrite>
```

----------

##### Nginx

在 Nginx 低版本中，是不支持 PATHINFO 的，但是可以通过在 Nginx.conf 中配置转发规则实现：

`0.1.1` 新增

``` clike
location / { // …..省略部分代码
    if (!-e $request_filename) {
        rewrite  ^(.*)$  /index.php?pathname=/$1  last;
        break;
    }
}
```

其实内部是转发到了 ginkgo 提供的兼容 URL，利用这种方式，可以解决其他不支持 PATHINFO 的 WEB 服务器环境。

如果你的应用安装在二级目录，Nginx 的伪静态方法设置如下，其中 youdomain 是所在的目录名称。

``` clike
location /youdomain/ {
    if (!-e $request_filename){
        rewrite  ^/youdomain/(.*)$  /youdomain/index.php?pathname=/$1  last;
    }
}
```

原来的访问 URL：

``` markup
http://server/index.php/模块/控制器/动作/参数-1/值-1/参数-2/值-2...
```

设置后，我们可以采用下面的方式访问：

``` markup
http://server/模块/控制器/动作/参数-1/值-1/参数-2/值-2...
```

如果你没有修改服务器的权限，可以在 index.php 入口文件做修改，这不是正确的做法，并且不一定成功，视服务器而定，只是在框架执行前补全 `$_SERVER['PATH_INFO']` 参数

``` php
$_SERVER['PATH_INFO'] = $_SERVER['REQUEST_URI'];
```
