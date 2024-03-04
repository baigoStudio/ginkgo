## ginkgo\session

本目录保存会话驱动及其相关的类。

#### 目录结构

```
project 应用部署目录
+-- ginkgo                         框架系统目录
|   +-- session                    会话相关目录
|   |   +-- driver                 会话驱动
|   |   |   +-- db.class.php       db 类型驱动
|   |   |   +--  ...               可扩展
|   |   |
|   |   +--  ...
|   |
|   +--  driver.class.php          驱动基类
|   +--  ...
|
+--  ...
```

#### 扩展会话驱动

Session 会在第一次调用 `Session` 类的时候按照配置参数自动初始化：

``` php
'session' => array(
  'autostart'     => true, //自动开始
  'name'          => '', //Session ID 名称
  'type'          => 'file', //类型 (可选 db,file)
  'path'          => '', //保存路径 (默认为 /runtime/session)
  'prefix'        => 'ginkgo_', //前缀
  'cookie_domain' => '',
  'life_time'     => 1200, // session 生存时间
),
```

如果使用上述配置参数，无需任何操作就可以直接调用 `Session` 类的相关方法，例如：

或者调用 `init()` 方法进行初始化：

``` php
$config = array(
  'autostart'     => true, //自动开始
  'name'          => '', //Session ID 名称
  'type'          => 'file', //类型 (可选 db,file)
  'path'          => '', //保存路径 (默认为 /runtime/session)
  'prefix'        => 'ginkgo_', //前缀
  'cookie_domain' => '',
  'life_time'     => 1200, // session 生存时间
),

Session::init($config);
```

还可以调用 `config()` 方法改变配置：

``` php
Session::config($config);
```

`type` 参数支持完整命名空间定义，默认采用 `ginkgo\session\driver` 作为命名空间，如果使用自己扩展的驱动，可以配置为：

扩展的会话驱动必须继承 `ginkgo/session/Driver` 类

``` php
'session' => array(
  'type'   => 'org\session\File',
  ...
);
```

表示采用 `org\session\File` 类作为驱动，而不是默认的 `ginkgo\session\driver\file`。

> 如果做了 Session 驱动扩展，可能有些参数不一定有效。
