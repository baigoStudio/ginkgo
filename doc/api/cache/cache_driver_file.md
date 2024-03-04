## ginkgo\cache\driver\File

ginkgo 内置的缓存驱动类。

----------

### 类摘要

```php
namespace ginkgo\cache\driver;
use ginkgo\cache\Driver;

class File extends Driver {
  // 继承的属性
  public $config = array();

  protected static $instance;

  private $configThis = array(
    'prefix'    => '',
    'life_time' => 1200,
  );

  // 方法
  public read( string $name ) : mixed
  public write( string $name, mixed $content [, int $life_time = 0 ] ) : int
  public delete( string $name ) : bool
  public check( string $name [, bool $check_expire = false ] ) : bool

  protected __construct( [ array $config ] ) : object

  private getPath( string $name ) : string

  // 继承的方法
  public static instance( [ array $config ] ) : object
  public config( array $config )
  public prefix( [ string $prefix ] ) : string

  protected __clone()
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 继承的属性 | - | - | - |
| [`$config`](cache_driver.md#$config) | public | array | 配置 |
| `$instance` | protected | object static | 本类的实例 |
| [`$configThis`](cache_driver.md#$config) | private | array | 默认配置 |
| 方法 | - | - | - |
| [read()](#read()) | public | | 读取缓存 |
| [write()](#write()) | public | | 写入缓存 |
| [delete()](#delete()) | public | | 删除缓存 |
| [check()](#check()) | public | | 检查缓存是否存在 |
| __construct() | protected | | 同 [instance()](cache_driver.md#instance()) |
| [getPath()](#getPath()) | private | | 取得路径 |
| 继承的方法 | - | - | - |
| [instance()](cache_driver.md#instance()) | public | static | 实例化方法 |
| [prefix()](cache_driver.md#prefix()) | public | | 设置、读取前缀 |
| [config()](cache_driver.md#config()) | public | | 配置 |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |

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

#### `check()` 验证认证信息

``` php
public function check( string $name [, bool $check_expire = false ] ) : bool
```

参数

* `name` 缓存名称
* `check_expire` 是否验证有效期

返回

* 布尔值

----------

<span id="getPath()"></span>

#### `getPath()` 取得路径

``` php
private function getPath( string $name ) : string
```

参数

* `name` 缓存名称

返回

* 文件路径
