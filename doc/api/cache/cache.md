## ginkgo\cache

本目录保存缓存驱动及其相关的类。

#### 目录结构

```
project 应用部署目录
+-- ginkgo                         框架系统目录
|   +-- cache                      缓存相关目录
|   |   +-- driver                 缓存驱动
|   |   |   +-- file.class.php     file 类型驱动
|   |   |   +--  ...               可扩展
|   |   |
|   |   +--  ...
|   |
|   +--  driver.class.php          驱动基类
|   +--  ...
|
+--  ...
```

#### 扩展缓存驱动

缓存在使用之前，需要进行初始化。初始化时可以定义缓存驱动类。

``` php
$cache = Cache::instance('file');
```

或者通过定义配置参数的方式，在配置文件中添加：

``` php
'cache' => array(
  'type' => 'file', // 缓存类型为 file
  ...
),
```

缓存目前只支持 file 类型，开发者可以自行扩展，扩展的缓存驱动文件请根据命名空间放置。

扩展的缓存驱动必须继承 `ginkgo/cache/Driver` 类

`type` 参数支持完整命名空间定义，默认采用 `ginkgo\cache\driver` 作为命名空间，如果使用自己扩展的缓存驱动，可以配置为：

``` php
'cache' => array(
  'type'   => 'org\cache\File',
  ...
);
```

表示采用 `org\cache\File` 类作为驱动，而不是默认的 `ginkgo\cache\driver\file`。

缓存类也提供了 `driver()` 方法对缓存驱动进行初始化或者切换，`driver()` 方法的参数同样支持完整命名空间定义，例如：

``` php
$cache->driver('file')->read('name');
$cache->driver('org\cache\file')->read('name');
```

表示当前缓存使用 `file` 驱动。
