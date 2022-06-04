## 注册插件

插件创建、编写完毕后，需要注册到系统才能正式运行。注册通过修改配置文件来实现，如：

``` php
'plugin' => array(
  'hello',
  'example',
),
```

也可以这样定义：

``` php
'plugin' => array(
  'hello' => 'hello',
  'example' => array(
    'dir' => 'example', // 目录名
  ),
),
```

另外还可以通过 `./app/config/plugin.inc.php` 文件来定义，系统会自动加载，此文件定义优先。

``` php
return array(
  'hello',
  'example',
);
```
