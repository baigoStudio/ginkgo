## ginkgo\Model

模型抽象类，无法直接实例化

----------

### 类摘要

```php
namespace ginkgo;

abstract class Model {
  // 属性
  protected $config = array();
  protected $obj_request;
  protected $obj_builder;
  protected $table;
  protected $className;
  protected $pk;

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

  private $obj_db;

  // 方法
  public __construct( [ array $config ] )
  public __call( string $method, mixed $params ) : mixed

  protected m_init()
  protected config( array $config )
  protected validate( mixed $data [, mixed $validate [, string $scene [, array $only [, array $remove [, array $append ]]]]] ) : mixed
  protected realClassProcess() : string
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$obj_request`](../request/index.md) | protected | object | 请求实例 |
| [`$obj_builder`](../db/db_builder_mysql.md) | protected | object | SQL 语句构造器实例 |
| `$table` | protected | string | 表名 |
| `$className` | protected | string | 类名 |
| [`$config`](#$config) | protected | array | 配置 |
| `$pk` | protected | string | 主键，`0.2.2` 新增 |
| [`$configThis`](#$config) | private | array | 默认配置 自 `v0.3.0` 废弃 |
| [`$obj_db`](../db/index.md) | private | object | 数据库实例 |
| 方法 | - | - | - |
| [__construct()](#__construct()) | public | | 构造函数 |
| [__call()](#__call()) | public | | 魔术调用 |
| [m_init()](#m_init()) | protected | | 模型初始化 |
| [config()](#config()) | protected | | 配置 |
| [validate()](#validate()) | protected | | 验证 |
| [realClassProcess()](#realClassProcess()) | protected | | 类名处理 |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

``` php
protected static $config;
private static $configThis; // 自 v0.3.0 废弃
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

<span id="__construct()"></span>

#### `__construct()` 构造函数

``` php
protected function __construct( [ array $config ] ) : object
```

参数

* [`config`](#$config) 配置参数

返回

* 本类实例

----------

<span id="__call()"></span>

#### `__call()` 魔术调用

自动调用 [ginkgo\Db](../db/index.md) 的方法

``` php
protected function __call( string $method, mixed $params ) : mixed
```

参数

* [`method`](../db/index.md) 方法名，必须为数据库实例支持的方法
* `params` 参数

返回

* [ginkgo\Db 实例](../db/index.md)

----------

<span id="m_init()"></span>

#### `m_init()` 模型初始化

``` php
protected function m_init()
```

参数

* 无

返回

* 无

----------

<span id="config()"></span>

#### `config()` 配置

``` php
protected function config( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="validate()"></span>

#### `validate()` 验证

``` php
protected function validate( mixed $data [, mixed $validate [, string $scene [, array $only [, array $remove [, array $append ]]]]] ) : mixed
```

参数

* `data` 待验证数据
* `validate` 验证器名称

  支持两种类型：为字符串时表示验证器名称，为数组时表示验证规则，为空时自动查找验证器

* `scene` 验证场景
* `only` 仅验证指定规则
* `remove` 移除指定规则
* `append` 追加验证规则

返回

* 验证结果

----------

<span id="realClassProcess()"></span>

#### `realClassProcess()` 类名处理

``` php
protected function realClassProcess() : string
```

参数

* 无

返回

* 类名
