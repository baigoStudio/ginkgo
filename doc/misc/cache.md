## 缓存

缓存功能由 `ginkgo\Cache` 类配合缓存驱动类一起完成，内置 File 缓存驱动。

----------

#### 设置

缓存在使用之前，需要进行初始化。初始化时可以定义缓存参数。

``` php
$config = array(
    'type'      => 'file', // 缓存类型为 file
    'life_time' => 0, // 缓存生命周期为永久有效
    'prefix'    => 'ginkgo', //缓存前缀
);
$cache = Cache::instance('file', $config);
```

或者通过定义配置参数的方式，在配置文件中添加：

``` php
'cache' => array(
    'type'      => 'file', // 缓存类型为 file
    'life_time' => 0, // 缓存生命周期为永久有效
    'prefix'    => 'ginkgo', //缓存前缀
),
```

缓存目前只支持 file 类型，开发者可以自行扩展，扩展的缓存驱动文件请根据命名空间放置。

缓存参数根据不同的缓存方式会有所区别，通用的缓存参数如下：

| 参数 | 描述 | 默认 |
| - | - | - |
| type | 缓存类型 | file |
| life_time | 缓存有效期 （单位为 秒） | 86400 |
| prefix | 缓存前缀 | ginkgo |


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

----------

#### 基本操作

* 写入缓存

    ``` php
    $cache->write('name', $value);
    $cache->write('name', $value, 3600); // 有效期一个小时
    ```

    返回写入字节数

* 读取缓存

    ``` php
    $cache->read('name');
    ```

    如果 name 值不存在，则默认返回空。

* 删除缓存

    ``` php
    $cache->delete('name');
    ```

* 检测缓存

    ``` php
    $cache->check('name'); // 检测缓存是否存在
    $cache->check('name', true); // 检测缓存是否过期
    ```
