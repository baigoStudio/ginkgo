## URL 访问

> URL 一律小写

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

> 更多其它环境的设置，请查看 [部署 -> URL 重写](../deploy/url_rewrite.md)。

----------

##### 特别注意

`0.1.1` 新增

根据 [概况 -> 开发规范](../index/spec.md) 的要求，ginkgo 采用了如下两种自动转换的策略：

* 文件夹和文件的命名使用使用小写和下划线，当路由中的模块与控制器为小写字母和横杠时，系统会将横杠 <kbd>-</kbd> 转换为下划线 <kbd>_</kbd>。

* 方法的命名使用驼峰法（首字母小写），但是路由都使用小写，当路由中的动作命名为小写字母和下划线或横杠时，系统会将动作自动转换为驼峰法（首字母小写）。

如果当前访问的地址是

> http://server/index.php/mod-index/ctrl-index/hello-world

或

> http://server/index.php/mod_index/ctrl_index/hello_world

控制器的实际位置是

> app/ctrl/mod_index/ctrl_index.ctrl.php

控制器类定义如下：

``` php
namespace app\ctrl\mod_index;

class Ctrl_Index {
  public function helloWorld() {
    return 'hello_world';
  }
}
```
