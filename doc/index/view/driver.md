## 视图驱动

关于 [模板](../template/index.md) 与 `视图` 之间的关系描述如下：

1. ginkgo 的输出依赖 [视图](../view/index.md) 以及 [视图驱动](../view/driver.md)，而非模板引擎，例如：[Smarty](https://www.smarty.net) 之类的。
2. `视图驱动` 是用来连接视图和模板引擎的桥梁，即本章节所表述的内容。
3. ginkgo 并未内置模板引擎，默认的 `视图驱动` 允许开发者直接使用 PHP 作为模板，这也就意味着在模板内可以完整的使用 PHP 语句。
4. 假如要使用第三方模板引擎，可以通过扩展视图驱动，根据 `ginkgo\view\Driver` 这个视图驱动基类进行扩展

默认情况下无需手动初始化视图驱动。可以通过下面的几种方式对视图驱动进行初始化。

在配置文件中的 `view` 参数中设置 `type` 参数即可，例如：

``` php
'view' => array(
  'type'   => 'Php', //默认驱动
  ...
);

// 0.2.0 之前为
'tpl' => array(
  'type'   => 'Php',
  ...
);
```

type 参数支持完整命名空间定义，默认采用 `ginkgo\view\driver` 作为命名空间，如果使用自己扩展的视图驱动，可以配置为：

``` php
'view' => array(
  'type'   => 'org\view\Tpl',
  ...
);

// 0.2.0 之前为
'tpl' => array(
  'type'   => 'org\view\Tpl',
  ...
);
```

表示采用 `org\view\Tpl` 类作为驱动，而不是默认的 `ginkgo\view\driver\Php`。

视图类也提供了 `driver()` 方法对视图驱动进行初始化或者切换，`driver()` 方法的参数同样支持完整命名空间定义，例如：

`0.2.0` 之前为 `engine()` 方法

``` php
$this->driver('php')->fetch();
$this->driver('org\view\Php')->fetch();

// 0.2.0 之前为
$this->engine('php')->fetch();
```

表示当前视图使用 `php` 驱动解析。
