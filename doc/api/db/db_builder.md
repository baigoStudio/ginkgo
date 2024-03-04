## ginkgo\db\Builder

SQL 语句构造器抽象类，无法直接实例化

----------

### 类摘要

```php
namespace ginkgo\db;

abstract class Builder {
  // 属性
  public $config = array();

  protected static $instance;

  // 自 v0.3.0 废弃
  private $configThis = array(
    'type'      => 'mysql',
    'host'      => '',
    'name'      => '',
    'user'      => '',
    'pass'      => '',
    'charset'   => 'utf8',
    'prefix'    => 'ginkgo_',
    'debug'     => false,
    'port'      => 3306,
  );

  // 方法
  public instance( [ array $config ] ) : object
  public config( array $config )
  public table( string $table ) : string

  protected __construct()
  protected __clone()
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](../db.md#$config) | public | array | 配置 |
| `$instance` | protected | object static | 本类的实例 |
| [`$configThis`](../db.md#$config) | private | array | 默认配置 自 `v0.3.0` 废弃 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [config()](#config()) | public | | 设定配置 |
| [table()](#table()) | public | | 处理表名 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |

----------

<span id="instance()"></span>

#### `instance()` 实例化方法

``` php
public static function instance( [ array $config ] ) : object
```

参数

* [`config`](#$config) 配置参数

返回

* 本类的实例

----------

<span id="config()"></span>

#### `config()` 设定配置

``` php
public function config( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="table()"></span>

#### `table()` 处理表名

``` php
public function table( string $table ) : string
```

参数

* `table` 表名

返回

* 完整表名
