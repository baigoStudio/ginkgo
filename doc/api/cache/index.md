## ginkgo\Cache

缓存功能由本类配合缓存驱动类一起完成，框架内置 File 缓存驱动。

----------

### 类摘要

```php
namespace ginkgo;

class Cache {
  // 属性
  public $config = array();

  protected static $instance;

  private $obj_driver;

  private $configThis = array(
    'type'      => 'file',
    'prefix'    => '',
    'life_time' => 1200,
  );

  // 方法
  public static instance( [ string $type = 'file' [, array $config ]] ) : object
  public driver( [ string $type = 'file' [, array $config ]] ) : object
  public read( string $name ) : mixed
  public write( string $name, mixed $content [, int $life_time = 0 ] ) : int
  public delete( string $name ) : bool
  public check( string $name [, bool $check_expire = false ] ) : bool
  public config( array $config )
  public prefix( [ string $prefix ] ) : string

  protected __construct( [ string $type = 'file' [, array $config ]] ) : object
  protected __clone()
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$obj_driver`](../cache/cache_file.md) | public | object | 驱动实例 |
| [`$config`](#$config) | public | array | 配置 |
| `$instance` | protected | object static | 本类的实例 |
| [`$configThis`](#$config) | private | array | 默认配置 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化方法 |
| [driver()](#driver()) | public | | 设置驱动 |
| [read()](#read()) | public | | 读取缓存 |
| [write()](#write()) | public | | 写入缓存 |
| [delete()](#delete()) | public | | 删除缓存 |
| [check()](#check()) | public | | 检查缓存是否存在 |
| [config()](#config()) | public | | 配置 |
| [prefix()](#prefix()) | public | | 设置、读取前缀 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

``` php
public $config;
private $configThis;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| type | string | file | 缓存类型，支持完整命名空间定义 |
| life_time | int | 24小时 | 有效期 |
| prefix | string | ginkgo | 前缀 |

----------

下列方法参数与返回值相同

<span id="instance()"></span>

#### `instance()` 实例化

``` php
public static function instance( [ string $type = 'file' [, array $config ]] ) : object
```

<span id="driver()"></span>

#### `driver()` 设置驱动

``` php
public function driver( [ string $type = 'file' [, array $config ]] ) : object
```

参数

* `type` 缓存类型（驱动），优先

  支持完整命名空间定义，默认采用 `ginkgo\cache\driver` 作为命名空间，如果使用自己扩展的缓存驱动，可以配置为：

  `org\cache\File`

  表示采用 `org\cache\File` 类作为驱动，而不是默认的 `ginkgo\cache\driver\file`。

* [`config`](#$config) 配置参数

返回

* 本类实例

----------

<span id="read()"></span>

#### `read()` 读取缓存

``` php
public function read( string $name ) : mixed
```

参数

* `name` 缓存名称

返回

* 缓存

----------

<span id="write()"></span>

#### `write()` 写入缓存

``` php
public function write( string $name, mixed $content [, int $life_time = 0 ] ) : int
```

参数

* `name` 缓存名称
* `content` 缓存内容，可以是字符串或数组
* `life_time` 有效期

返回

* 写入字节数

----------

<span id="delete()"></span>

#### `delete()` 删除缓存

``` php
public function delete( string $name ) : bool
```

参数

* `name` 缓存名称

返回

* 布尔值

----------

<span id="check()"></span>

#### `check()` 检查缓存是否存在

``` php
public function check( string $name [, bool $check_expire = false ] ) : bool
```

参数

* `name` 缓存名称
* `check_expire` 是否验证有效期

返回

* 布尔值

----------

<span id="config()"></span>

#### `config()` 配置

`0.2.0` 新增

``` php
public function config( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="prefix()"></span>

#### `prefix()` 设置、读取前缀

``` php
public function prefix( [ string $prefix ] ) : string
```

参数

* `prefix` 前缀，如此参数为空，则返回当前前缀

返回

* 前缀
