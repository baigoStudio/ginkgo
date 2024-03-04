## ginkgo\session\Driver

会话驱动抽象类，无法直接实例化

----------

### 类摘要

```php
namespace ginkgo\session;

abstract class Driver {
  // 属性
  public $config = array();

  protected static $instance;

  private $configThis = array(
    'life_time' => 1200,
  );

  // 方法
  public static instance( [ array $config ] ) : object
  public config( array $config )
  public open( string $save_path, string $session_name ) : bool
  public close() : bool
  public read( string $session_id ) : mixed
  public write( string $session_id, mixed $session_data ) : bool
  public destroy( string $session_id ) : bool
  public gc( int $ssin_max_lifetime ) : bool

  protected __construct( [ array $config ] ) : object
  protected __clone()
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array | 配置 |
| `$instance` | protected | object static | 本类的实例 |
| [`$configThis`](#$config) | private | array | 默认配置 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化方法 |
| [config()](#config()) | public | | 配置 |
| [open()](#open()) | public | | 开启会话 |
| [close()](#close()) | public | | 关闭会话 |
| [read()](#read()) | public | | 读取会话 |
| [write()](#write()) | public | | 写入会话 |
| [destroy()](#destroy()) | public | | 销毁会话 |
| [gc()](#gc()) | public | | 清理会话 |
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
| life_time | int | 24小时 | 有效期 |
| prefix | string | ginkgo | 前缀 |

----------

<span id="instance()"></span>

#### `instance()` 实例化

``` php
public static function instance( [ array $config ] ) : object
```

参数

* [`config`](#$config) 配置参数

返回

* 本类实例

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

<span id="open()"></span>

#### `open()` 开启会话

``` php
public function open( string $save_path, string $session_name ) : bool
```

参数

* `save_path` 会话保存路径
* `session_name` 会话名称

返回

* 布尔值

----------

<span id="close()"></span>

#### `close()` 关闭会话

``` php
public function close() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="read()"></span>

#### `read()` 读取会话

``` php
public function read( string $session_id ) : mixed
```

参数

* `session_id` 会话 ID

返回

* 会话数据

----------

<span id="write()"></span>

#### `write()` 写入会话

``` php
public function write( string $session_id, mixed $session_data ) : bool
```

参数

* `session_id` 会话 ID
* `session_data` 会话数据

返回

* 布尔值

----------

<span id="destroy()"></span>

#### `destroy()` 销毁会话

``` php
public function destroy( string $session_id ) : bool
```

参数

* `session_id` 会话 ID

返回

* 布尔值

----------

<span id="gc()"></span>

#### `gc()` 清理会话

``` php
public function gc( int $ssin_max_lifetime ) : bool
```

参数

* `ssin_max_lifetime` 会话最长生命周期

返回

* 布尔值
