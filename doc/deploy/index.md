## 虚拟主机环境

ginkgo 支持各种灵活的部署方式，只要稍作调整便可适应各种要求

默认入口文件位于 `public/index.php`，内容如下：

``` php
// 加载框架引导文件
require(__DIR__ . '/../ginkgo/boot.php');
```

入口文件的位置是为了让应用更安全，`public` 目录为 Web 可访问目录，其他的文件都可以放到非 Web 访问目录下面。

也可以变更入口文件的位置和内容，例如：把入口文件改到根目录下

``` php
// 应用目录
define('GK_PATH_APP', __DIR__ . './apps/'); //应用目录

// 加载框架引导文件
require(__DIR__ . './ginkgo/boot.php');
```

如果只想变更应用目录的名称，也可以添加 `GK_NAME_APP` 常量定义，例如：

``` php
// 定义配置目录
define('GK_NAME_APP', 'application');
```

> 注意：所有路径的定义都支持相对路径和绝对路径，但结尾请勿添加 <kbd>/</kbd>。

如果调整了框架核心目录的位置或者目录名，只需要这样修改：

``` php
// 变更应用目录的名称
define('GK_PATH_APP', __DIR__ . '/apps/');

// 加载框架引导文件
require './ginkgo/boot.php';
```

这样最终的应用目录结构如下：

  +-- www  WEB部署目录（或者子目录）
  |   +-- index.php       应用入口文件
  |   +-- apps            应用目录
  |   +-- ginkgo          框架目录
  |
