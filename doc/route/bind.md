## 路由绑定

如果想限制某个入口文件只能访问特定模块，可以在入口文件添加 `GK_BIND_MOD` 常量，例如：

``` php
// 绑定到index模块
define('GK_BIND_MOD', 'index');

// 加载框架引导文件
require(__DIR__ . '/../ginkgo/boot.php');
```

这种绑定方式的应用场景主要有如下几种：

1. 由于 ginkgo 的默认 URL 访问方式是多模块的，需要访问的模块必须在 URL 地址中指明，如果只有一个模块，可以进行模块绑定，以简化 URL；
2. 对于某些特殊情况下，出于保障应用安全，限制某个入口文件只能访问特定模块，比如 `public/admin.php` 只能访问后台管理模块。

这种方式绑定以后的示例：

``` php
// 绑定到index模块
define('GK_BIND_MOD', 'index');

// 加载框架引导文件
require(__DIR__ . '/../ginkgo/boot.php');
```

* 访问 __http://server/index.php/`article/show`__

    会自动路由到 __http://server/index.php/index/article/show__


* 访问 __http://server/index.php/`admin/article/show`__

    会自动路由到 __http://server/index.php/index/admin/article__
