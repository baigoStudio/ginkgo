## ginkgo\db\Connector

数据库连接抽象类，无法直接实例化

----------

### 类摘要

```php
namespace ginkgo\db;

abstract class Connector {
  // 属性
  public $config = array();
  public $obj_builder;
  public $obj_pdo;
  public $obj_result;

  protected static $instance = array(); // 自 v0.3.0 起改为数组
  protected $isConnect;
  protected $mid;
  protected $optDebugDump = false;
  protected $paramType = array(
    'bool'  => PDO::PARAM_BOOL,
    'int'   => PDO::PARAM_INT,
    'str'   => PDO::PARAM_STR,
  );

  protected $_table       = array();
  protected $_tableTemp   = array();
  protected $_pk          = array();
  protected $_force       = '';
  protected $_distinct    = false;
  protected $_join        = '';
  protected $_where       = '';
  protected $_whereOr     = array();
  protected $_whereAnd    = array();
  protected $_paginate    = array();
  protected $_group       = '';
  protected $_order       = '';
  protected $_limit       = '';
  protected $_bind        = array();
  protected $_fetchSql    = false;

  // 自 v0.3.0 废弃
  private static $configThis = array(
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
  public static instance( [ array $config ] ) : object
  public config( [ array $config ] ) // 自 v0.3.0 起改为 init()
  public init( [ array $config ] ) // v0.3.0 新增
  public connect( [ array $config ] )
  public exec( string $sql ) : int
  public query( string $sql ) : object
  public lastInsertId() : int
  public prepare( string $sql [, mixed $bind [, mixed $value [, string $type ]]] ) : object
  public execute( [ mixed $bind [, mixed $value [, string $type [, bool $reset = true ]]]] ) : object
  public distinct( [ bool $bool = true ] ) : object
  public paginate( [ int $perpage = 0 [, mixed $current = 'get' [, string $pageparam = 'page' [, int $pergroup = 0 ]]]] ) : object
  public fetchSql( [ bool $bool = true ] ) : object
  public getRowCount() : int
  public getRow() : mixed
  public getResult( [ bool $all = true [, int $type = PDO::FETCH_ASSOC ]] ) : mixed
  public setModel( string $model )
  public setTable( string $table )
  public getTable() : string
  public setPk( string $pk )
  public getPk() : string
  public bind( mixed $bind [, mixed $value [, string $type ]] ) : object
  public resetSql()

  protected __construct( [ array $config ] ) : object
  protected __clone()
  protected fetchBind( string $sql, mixed $bind [, mixed $value [, string $type ]] ) : string

  private bindProcess( scalar $param, scalar $value, [ string $type ] ) : bool
  private fetchBindProcess( scalar $param, scalar $value, [ string $type ] ) : bool
  private getType( scalar $value, [ string $type ] ) : string
  private dsnProcess() : string // 自 v0.3.0 起改为 configProcess()
  private configProcess() : string // v0.3.0 新增
  private paramProcess( [ int $host_no = 0 ] ) : string // v0.3.0 新增
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](../db.md#$config) | public | array | 配置 |
| [`$obj_builder`](db_builder_mysql.md) | public | object | 语句构造器实例 |
| [`$obj_pdo`](https://www.php.net/manual/zh/class.pdo.php) | public | object | PDO 实例 |
| [`$obj_result`](https://www.php.net/manual/zh/class.pdostatement.php) | public | object | PDOStatement 对象 |
| `$instance` | protected | object static | 本类的实例 |
| `$isConnect` | protected | bool | 是否连接标记 |
| `$mid` | protected | string | 模型 ID |
| `$optDebugDump` | protected | mixed | 调试配置 |
| `$_table` | protected | string | 数据表名 |
| `$_tableTemp` | protected | array | 临时数据表名（切换操作的数据表、对多表进行操作） |
| `$_pk` | protected | string | 主键 `0.2.2` 新增 |
| `$_force` | protected | string | 强制使用索引名 |
| `$_distinct` | protected | mixed | 是否不重复 |
| `$_join` | protected | string | join 语句 |
| `$_where` | protected | string | where 条件语句 |
| `$_whereOr` | protected | array | whereOr 语句数组 |
| `$_whereAnd` | protected | array | whereAnd 语句数组 |
| `$_paginate` | protected | array | 分页参数 |
| `$_group` | protected | string | group 语句 |
| `$_order` | protected | string | order 语句 |
| `$_limit` | protected | string | limit 语句 |
| `$_bind` | protected | array | 绑定参数数组 |
| `$_fetchSql` | protected | bool | 是否获取 sql 语句 |
| [`$paramType`](#$paramType) | protected | array | 默认参数类型 |
| [`$configThis`](../db.md#$config) | private | array | 默认配置 自 `v0.3.0` 废弃 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化方法 |
| [config()](#init()) | public | | 配置数据库 自 `v0.3.0` 起改为 `init()` |
| [init()](#init()) | public | | 初始化数据库 `v0.3.0` 新增 |
| [connect()](#connect()) | public | | 连接数据库 |
| [exec()](#exec()) | public | | 执行原生 SQL（一般用于 插入、更新 或者 删除） |
| [query()](#query()) | public | | 执行原生 SQL（一般用于 查询） |
| [lastInsertId()](#lastInsertId()) | public | | 取得新插入的 ID |
| [prepare()](#prepare()) | public | | 预处理 SQL 语句 |
| [execute()](#execute()) | public | | 执行预处理 SQL 语句 |
| [distinct()](#distinct()) | public | | 是否查询不重复的记录 |
| [paginate()](#paginate()) | public | | 分页 |
| [fetchSql()](#fetchSql()) | public | | 是否获取 SQL 语句 |
| [getRowCount()](#getRowCount()) | public | | 取得影响行数 |
| [getRow()](#getRow()) | public | | 取得当前行数据 |
| [getResult()](#getResult()) | public | | 取得结果 |
| [setModel()](#setModel()) | public | | 设置模型名 |
| [setTable()](#setTable()) | public | | 设置数据表名 |
| [getTable()](#getTable()) | public | | 取得当前数据表名 |
| [setPk()](#setPk()) | public | | 设置主键 `0.2.2` 新增 |
| [getPk()](#getPk()) | public | | 取得当前主键名 `0.2.2` 新增 |
| [bind()](#bind()) | public | | 绑定参数 |
| [resetSql()](#resetSql()) | public | | 重置 SQL |
| [fetchBind()](#fetchBind()) | public | | 取得绑定后 SQL（配合 `fetchSql()` 方法） |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [bindProcess()](#bindProcess()) | private | | 绑定处理 |
| [fetchBindProcess()](#bindProcess()) | private | | 绑定处理（配合 `fetchSql()` 方法） |
| [getType()](#getType()) | private | | 取得类型 |
| [dsnProcess()](#dsnProcess()) | private | | 根据配置进行 DSN 处理 自 `v0.3.0` 起改为 `configProcess()` |
| [configProcess()](#configProcess()) | private | | 配置处理 `v0.3.0` 新增 |
| [paramProcess()](#paramProcess()) | private | | 参数处理 `v0.3.0` 新增 |

----------

<span id="$paramType"></span>

#### `$paramType` 默认参数类型

``` php
protected $paramType;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| bool | PDO 类预定义常量 | PDO::PARAM_BOOL | 布尔值 |
| int | PDO 类预定义常量 | PDO::PARAM_INT | 整数 |
| str | PDO 类预定义常量 | PDO::PARAM_STR | 字符串 |

----------

<span id="instance()"></span>

#### `instance()` 实例化方法

``` php
public static function instance( [ array $config ] ) : object
```

参数

* [`config`](#$config) 配置参数

返回

* 数据库连接实例

----------

<span id="init()"></span>

#### `config()` 配置数据库
#### `init()` 初始化数据库

自 `v0.3.0` 起改为 `init()`

``` php
public function config( [ array $config ] )
public function init( [ array $config ] )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="connect()"></span>

#### `connect()` 连接数据库

``` php
public function connect( [ array $config ] )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="exec()"></span>

#### `exec()` 执行原生 SQL（一般用于 插入、更新 或者 删除）

``` php
public function exec( string $sql ) : int
```

参数

* `sql` SQL 语句

返回

* 受修改或删除 SQL 语句影响的行数

----------

<span id="query()"></span>

#### `query()` 执行原生 SQL（一般用于 插入、更新 或者 删除）

``` php
public function query( string $sql ) : object
```

参数

* `sql` SQL 语句

返回

* [PDOStatement 对象](https://www.php.net/manual/zh/class.pdostatement.php)

----------

<span id="lastInsertId()"></span>

#### `lastInsertId()` 取得新插入的 ID

``` php
public function lastInsertId() : int
```

参数

* 无

返回

* 新插入的 ID

----------

<span id="prepare()"></span>

#### `prepare()` 预处理 SQL 语句

``` php
public function prepare( string $sql [, mixed $bind [, mixed $value [, string $type ]]] ) : object
```

参数

* `sql` 预处理 SQL 语句
* [`bind`](#bind) 绑定名称
* [`value`](#bind) 绑定值
* [`type`](#bind) 参数类型

返回

* [PDOStatement 对象](https://www.php.net/manual/zh/class.pdostatement.php)

----------

<span id="execute()"></span>

#### `execute()` 执行预处理 SQL 语句

``` php
public function execute( [ mixed $bind [, mixed $value [, string $type [, bool $reset = true ]]]] ) : object
```

参数

* [`bind`](#bind) 绑定名称
* [`value`](#bind) 绑定值
* [`type`](#bind) 参数类型
* `reset` 是否重置 SQL，如为 true，所有 `$_名称` 类型的属性都将被重置

返回

* [PDOStatement 对象](https://www.php.net/manual/zh/class.pdostatement.php)

----------

<span id="distinct()"></span>

#### `distinct()` 是否查询不重复的记录

``` php
public function distinct( [ bool $bool = true ] ) : object
```

参数

* `bool` 是否查询不重复的记录

返回

* 本类的实例

----------

<span id="paginate()"></span>

#### `paginate()` 分页

``` php
public function paginate( [ int $perpage = 0 [, mixed $current = 'get' [, string $pageparam = 'page' [, int $pergroup = 0 ]]]] ) : object
```

参数

* `perpage` 每页记录数：

  数值型，为 0 表示采用系统默认设置

* `current` 当前页码：

  混合型，默认为 get

  可能的值

  | 值 | 描述 |
  | - | - |
  | get | 用 get 方法获取页码 |
  | post | 用 post 方法获取页码 |
  | 整数 | 当前页码 |

* `pageparam` 分页参数名：

  字符型

* `pergroup` 每组页数

  数值型

返回

* 本类的实例

----------

<span id="fetchSql()"></span>

#### `fetchSql()` 是否获取 SQL 语句

``` php
public function fetchSql( [ bool $bool = true ] ) : object
```

参数

* `bool` 是否获取 SQL 语句

返回

* 本类的实例

----------

<span id="getRowCount()"></span>

#### `getRowCount()` 取得影响行数

``` php
public function getRowCount() : int
```

参数

* 无

返回

* 影响行数

----------

<span id="getRow()"></span>

#### `getRow()` 取得当前行数据

``` php
public function getRow() : mixed
```

参数

* 无

返回

* 当前行数据

----------

<span id="getResult()"></span>

#### `getResult()` 取得结果

``` php
public function getResult( [ bool $all = true [, int $type = PDO::FETCH_ASSOC ]] ) : mixed
```

参数

* `all` 是否获取全部数据
* `type` 取得类型

  可能的值

  | 值 | 描述 |
  | - | - |
  | PDO::FETCH_ASSOC | 返回一个索引为结果集列名的数组 |
  | PDO::FETCH_BOTH | 返回一个索引为结果集列名和以 0 开始的列号的数组 |
  | PDO::FETCH_BOUND | 返回 true，并分配结果集中的列值给 PDOStatement::bindColumn() 方法绑定的 PHP 变量。 |
  | PDO::FETCH_CLASS | 返回一个请求类的新实例，映射结果集中的列名到类中对应的属性名。 |
  | PDO::FETCH_INT | 更新一个被请求类已存在的实例，映射结果集中的列到类中命名的属性 |
  | PDO::FETCH_LAZ | 结合使用 PDO::FETCH_BOTH 和 PDO::FETCH_OBJ，创建供用来访问的对象变量名 |
  | PDO::FETCH_NUM | 返回一个索引为以0开始的结果集列号的数组 |
  | PDO::FETCH_OBJ | 返回一个属性名对应结果集列名的匿名对象 |

返回

* 返回的值依赖于 `type` 参数

----------

<span id="setModel()"></span>

#### `setModel()` 设置模型名

``` php
public function setModel( string $model )
```

参数

* `model` 模型名

返回

* 无

----------

<span id="setTable()"></span>

#### `setTable()` 设置数据表名

``` php
public function setTable( string $table )
```

参数

* `table` 数据表名

返回

* 无

----------

<span id="getTable()"></span>

#### `getTable()` 取得当前数据表名

``` php
public function getTable() : string
```

参数

* 无

返回

* 当前数据表名

----------

<span id="setPk()"></span>

#### `setPk()` 设置主键

`0.2.2` 新增

``` php
public function setPk( string $pk )
```

参数

* `pk` 主键名

返回

* 无

----------

<span id="getPk()"></span>

#### `getPk()` 取得当前主键

`0.2.2` 新增

``` php
public function getPk() : string
```

参数

* 无

返回

* 当前数据表名

----------

<span id="bind()"></span>

#### `bind()` 绑定参数

``` php
public function bind( mixed $bind [, mixed $value [, string $type ]] ) : object
```

参数

* [`bind`](#bind) 绑定名称
* [`value`](#bind) 绑定值
* [`type`](#bind) 参数类型

返回

* 本类的实例

----------

<span id="resetSql()"></span>

#### `resetSql()` 重置 SQL，所有 `$_名称` 类型的属性都将被重置

``` php
public function resetSql()
```

参数

* 无

返回

* 无

----------

<span id="fetchBind()"></span>

#### `fetchBind()` 绑定处理

``` php
protected function fetchBind( string $sql, mixed $bind [, mixed $value [, string $type ]] ) : string
```

参数

* `sql` 预处理 SQL 语句
* [`bind`](#bind) 绑定名称
* [`value`](#bind) 绑定值
* [`type`](#bind) 参数类型

返回

* 真实 SQL 语句

----------

<span id="bindProcess()"></span>

#### `bindProcess()` 绑定处理

``` php
private function bindProcess( scalar $param, scalar $value, [ string $type ] ) : bool
```

#### `fetchBindProcess()` 绑定处理（配合 `fetchSql()` 方法）

``` php
private function fetchBindProcess( scalar $param, scalar $value, [ string $type ] ) : bool
```

参数

* `param` 参数名称，必须为标量
* `value` 绑定值
* `type` 类型

  可能的值

  | 值 | 描述 |
  | - | - |
  | str（默认） | 字符串 |
  | int | 整数 |
  | float | 浮点数 |
  | double | 数字 |
  | bool | 布尔值 |

返回

* 布尔值

----------

<span id="getType()"></span>

#### `getType()` 绑定处理（配合 `fetchSql()` 方法）

``` php
private function getType( scalar $value, [ string $type ] ) : string
```

参数

* `value` 绑定值
* `type` 类型

  可能的值

  | 值 | 描述 |
  | - | - |
  | str（默认） | 字符串 |
  | int | 整数 |
  | float | 浮点数 |
  | double | 数字 |
  | bool | 布尔值 |

返回

* 类型

----------

<span id="configProcess()"></span>

#### `dsnProcess()` 根据配置进行 DSN 处理
#### `configProcess()` 配置处理

自 `v0.3.0` 起改为 `configProcess()`

``` php
private function configProcess() : string
```

参数

* 无

返回

* DSN 字符串

----------

<span id="paramProcess()"></span>

#### `paramProcess()` 配置处理

`v0.3.0` 新增

``` php
private function paramProcess( [ int $param_no = 0 ] ) : array
```

参数

* param_no 参数序号

返回

* 参数

----------

<span id="bind"></span>

#### 绑定参数

* `bind` 绑定名称

  支持两种类型：为字符串时表示占位符，为数组时表示批量绑定

* `value` 绑定值

  当 `bind` 为字符串时为必须，当 `bind` 为数组时自动忽略。

* `type` 参数类型

  为空时自动识别类型，当 `bind` 为数组时自动忽略。

  可能的值

  | 值 | 描述 |
  | - | - |
  | str（默认） | 字符串 |
  | int | 整数 |
  | float | 浮点数 |
  | double | 数字 |
  | bool | 布尔值 |
