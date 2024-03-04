## ginkgo\session\driver\Db

ginkgo 内置的会话驱动类。

----------

### 类摘要

```php
namespace ginkgo\session\driver;
use ginkgo\session\Driver;

class Db extends Driver {
  // 属性
  private $obj_db;

  // 继承的属性
  public $config = array();

  protected static $instance;

  private $configThis = array(
    'life_time' => 1200,
  );

  // 方法
  public open( string $name [, bool $check_expire = false ] ) : bool
  public close( [ string $prefix ] ) : string
  public read( string $name ) : mixed
  public write( string $name, mixed $content [, int $life_time = 0 ] ) : int
  public destroy( string $name ) : bool
  public gc( string $name ) : bool

  protected __construct( [ array $config ] ) : object

  private readProcess( string $name ) : string
  private createTable( string $name ) : string
  private showTables( string $name ) : string

  // 继承的方法
  public static instance( [ array $config ] ) : object
  public config( array $config )

  protected __clone()
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$obj_db`](../db/index.md) | private | object | 数据库实例 |
| 继承的属性 | - | - | - |
| [`$config`](session_driver.md#$config) | public | array | 配置 |
| `$instance` | protected | object static | 本类的实例 |
| [`$configThis`](session_driver.#$config) | private | array | 默认配置 |
| 方法 | - | - | - |
| [open()](#open()) | public | | 开启会话 |
| [close()](#close()) | public | | 关闭会话 |
| [read()](#read()) | public | | 读取会话 |
| [write()](#write()) | public | | 写入会话 |
| [destroy()](#destroy()) | public | | 销毁会话 |
| [gc()](#gc()) | public | | 清理会话 |
| __construct() | protected | | 同 [instance()](session_driver.md#instance()) |
| [readProcess()](#readProcess()) | private | | 读取处理 |
| [createTable()](#createTable()) | private | | 创建数据表 |
| [showTables()](#showTables()) | private | | 显示数据表 |
| 继承的方法 | - | - | - |
| [instance()](session_driver.md#instance()) | public | static | 实例化方法 |
| [config()](session_driver.md#config()) | public | | 配置 |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |

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

----------

<span id="readProcess()"></span>

#### `readProcess()` 读取处理

``` php
private function readProcess( string $session_id [, int $expire = 0 ] ) : array
```

参数

* `name` 会话名称

返回

* 会话数据

----------

<span id="createTable()"></span>

#### `createTable()` 创建数据表

``` php
private function createTable()
```

参数

* 无

返回

* 无

----------

<span id="showTables()"></span>

#### `showTables()` 显示数据表

``` php
private function showTables() : array
```

参数

* 无

返回

* 数据表列表
