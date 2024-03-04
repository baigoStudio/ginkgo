## ginkgo\view

本目录保存视图驱动及其相关的类。

关于 `模板` 与 [视图](../view/index.md) 之间的关系描述如下：

1. ginkgo 的输出依赖 [视图](../view/index.md) 以及 [视图驱动](../view/view_driver.md)，而非模板引擎，例如：[Smarty](https://www.smarty.net) 之类的。
2. [视图驱动](../view/view_driver_php.md) 是用来连接视图和模板引擎的桥梁。
3. ginkgo 并未内置模板引擎，默认的 `视图驱动` 允许开发者直接使用 PHP 作为模板，这也就意味着在模板内可以完整的使用 PHP 语句。
4. 假如要使用第三方模板引擎，可以通过扩展视图驱动，根据 [`ginkgo\view\Driver`](../view/view_driver.md) 这个视图驱动基类进行扩展。

#### 目录结构

```
project 应用部署目录
+-- ginkgo                     框架系统目录
|   +-- view                   视图相关目录
|   |   +-- driver             视图驱动
|   |   |   +-- php.class.php  内置驱动
|   |   |   +--  ...           可扩展
|   |   |
|   |   +--  ...
|   |
|   +--  driver.class.php      驱动基类
|   +--  ...
|
+--  ...
```

#### 扩展视图驱动

视图在使用之前，需要进行初始化。可以通过定义配置参数的方式，在配置文件中添加：

``` php
'view' => array(
  'type' => 'php', // 视图类型为 php
  ...
),
```

视图目前只支持 php 类型，开发者可以自行扩展，扩展的视图驱动文件请根据命名空间放置。

扩展的视图驱动必须继承 `ginkgo/view/Driver` 类

`driver` 参数支持完整命名空间定义，默认采用 `ginkgo\view\driver` 作为命名空间，如果使用自己扩展的视图驱动，可以配置为：

``` php
'view' => array(
  'type'   => 'org\view\Driver',
  ...
);
```

表示采用 `org\view\Driver` 类作为驱动，而不是默认的 `ginkgo\view\driver\Php`。

视图类也提供了 `driver()` 方法对视图驱动进行初始化或者切换，`driver()` 方法的参数同样支持完整命名空间定义，例如：

``` php
$view->driver('smarty');
```

表示当前视图使用 `smarty` 驱动。
