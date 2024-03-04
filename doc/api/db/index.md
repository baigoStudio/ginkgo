## ginkgo\Db

数据库类

----------

### 类摘要

```php
namespace ginkgo;

class Db {
  // 属性
  public static $config;

  protected static $instance;

  private static $configThis = array(
    'type'      => 'mysql',
    'host'      => '',
    'name'      => '', // 自 v0.3.0 改为 dbname
    'dbname'    => '', // v0.3.0 新增
    'user'      => '',
    'pass'      => '',
    'charset'   => 'utf8',
    'prefix'    => 'ginkgo_',
    'debug'     => false,
    'port'      => 3306,
  );
  private static $init;

  // 方法
  public static connect( [ array $config ] ) : object
  public static config( [ array $config ] )
  public static __callStatic( string $method, mixed $params ) : object
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array static | 配置 |
| `$instance` | protected | object static | 本类的实例 |
| [`$configThis`](#$config) | private | array static | 默认配置 |
| `$init` | private | bool static | 是否初始化 |
| 方法 | - | - | - |
| [__callStatic()](#__callStatic()) | public | static | 魔术方法 |
| [connect()](#connect()) | public | static | 连接数据库 |
| [config()](#config()) | public | static | 配置数据库 |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

``` php
public static $config;
private static $configThis;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| type | string | mysql | 数据库类型 |
| host | string | | 服务器 自 `v0.3.0` 起支持用数组配置 |
| name | string | | 数据库名 自 `v0.3.0` 起改为 `dbname`，支持用数组配置 |
| dbname | string | | 数据库名 `v0.3.0` 新增，支持用数组配置 |
| user | string | | 用户名 自 `v0.3.0` 起支持用数组配置 |
| pass | string | | 密码 自 `v0.3.0` 起支持用数组配置 |
| charset | string | utf8 | 字符编码 自 `v0.3.0` 起支持用数组配置 |
| prefix | string | ginkgo_ | 表名前缀 |
| debug | bool | false | 是否打开数据库调试 |
| port | int | 3306 | 端口 |

----------

<span id="__callStatic()"></span>

#### `__callStatic()` 魔术方法

自动调用 [ginkgo\db\connector\Mysql](db_connector_mysql.md) 的方法

``` php
public static function __callStatic( string $method, mixed $params ) : object
```

参数

* [`method`](../db/db_connector_mysql.md) 方法名，必须为数据库连接器支持的方法
* `params` 参数

返回

* [ginkgo\db\connector\Mysql 实例](db_connector_mysql.md)

----------

<span id="connect()"></span>

#### `connect()` 初始化

``` php
public static function connect( [ array $config ] ) : object
```

参数

* [`config`](#$config) 配置参数

返回

* 数据库实例

----------

<span id="config()"></span>

#### `config()` 配置数据库

``` php
public static function config( [ array $config ] )
```

参数

* [`config`](#$config) 配置参数

返回

* 无
