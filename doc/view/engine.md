## 模板引擎

默认情况下无需手动初始化模板引擎。

可以通过下面的几种方式对模板引擎进行初始化。

配置文件

在配置文件中的 `tpl` 参数中设置 `type` 参数即可，例如：

``` php
'tpl' => array(
    'type'   => 'php', //默认引擎
    ...
);
```

type 参数支持完整命名空间定义，默认采用 `ginkgo\view\driver` 作为命名空间，如果使用自己扩展的模板引擎，可以配置为：

``` php
'tpl' => array(
    'type'   => 'org\view\Tpl',
    ...
);
```

表示采用 `org\view\Tpl` 类作为引擎，而不是默认的 `ginkgo\view\driver\php`。

视图类也提供了 `engine` 方法对模板引擎进行初始化或者切换，`engine` 方法的参数同样支持完整命名空间定义，例如：

``` php
$this->engine('php')->fetch();
$this->engine('org\view\php')->fetch();
```

表示当前视图使用 `php` 引擎解析。
