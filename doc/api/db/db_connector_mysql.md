## ginkgo\db\connector\Mysql

MySQL 数据库连接类，继承 `ginkgo\db\Connector`

----------

### 类摘要

```php
namespace ginkgo\db\connector;
use ginkgo\db\Connector;

class Mysql extends Connector {
  // 继承的属性
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

  // 方法
  public insertId() : int
  public table( string $table ) : object
  public force( string $index ) : object
  public join( string $table [, string $on [, string $type ]] ) : object
  public where( mixed $where [, string $exp [, string $value [, string $param [, string $type ]]]] ) : object
  public whereAnd( mixed $where [, string $exp [, string $value [, string $param [, string $type ]]]] ) : object
  public whereOr( mixed $where [, string $exp [, string $value [, string $param [, string $type ]]]] ) : object
  public group( mixed $field ) : object
  public order( mixed $field, [ string $type = 'ASC' ] ) : object
  public limit( [ int $limit = false [, int $length = false ]] ) : object
  public find( [ mixed $field ] ) : mixed
  public select( [ mixed $field [, bool $all = true ]] ) : mixed
  public insert( mixed $field [, string $value [, string $param [, string $type ]]] ) : int
  public update( mixed $field [, string $value [, string $param [, string $type ]]] ) : int
  public delete() : int
  public duplicate( [ mixed $field [, string $table ]] ) : int
  public pagination( [ int $perpage = 0 [, mixed $current = 'get' [, string $pageparam = 'page' [, int $pergroup = 0 [, bool $reset = true ]]]]] ) : array
  public count( [ mixed $field [, bool $reset = true ]] ) : int
  public max( [ mixed $field ] ) : mixed
  public min( [ mixed $field ] ) : mixed
  public avg( [ mixed $field ] ) : mixed
  public sum( [ mixed $field ] ) : mixed
  public buildSql() : string
  public getFields( [ string $type = '' [, string $table = '' ]] ) : array
  public getTableInfo( [ string $type = '' [, string $table = '' ]] ) : mixed
  public getTables( [ string $dbName = '' ] ) : array

  private aggProcess( string $type, mixed $field [, bool $reset = true ] ) : mixed
  private buildSelect( [ mixed $field ] ) : string
  private buildInsert( mixed $field [, string $value [, string $param [, string $type ]]] ) : string
  private buildUpdate( mixed $field [, string $value [, string $param [, string $type ]]] ) : string
  private buildDelete() : string
  private buildDuplicate( [ mixed $field [, string $table ]] ) : string
  private buildWhere( [ bool $add_where = true ] ) : string
  private buildAgg( string $type [, mixed $field ] ) : string

  // 继承的方法
  public static instance( [ array $config ] ) : object
  public config( [ array $config ] ) // 自 v0.3.0 起改为 init()
  public init( [ array $config ] ) // 自 v0.3.0 起
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

  protected __construct()
  protected __clone()
  protected fetchBind( string $sql, mixed $bind [, mixed $value [, string $type ]] ) : string
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 继承的属性 | - | - | - |
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
| [`$paramType`](db_connector.md#$paramType) | protected | array | 默认参数类型 |
| 方法 | - | - | - |
| [insertId()](#insertId()) | public | | 取得插入 ID |
| [table()](#table()) | public | | 切换数据表 |
| [force()](#force()) | public | | 强制使用索引 |
| [join()](#join()) | public | | join 语句处理 |
| [where()](#where()) | public | | where 语句处理 |
| [whereAnd()](#where()) | public | | whereAnd 语句处理 |
| [whereOr()](#where()) | public | | whereOr 语句处理 |
| [group()](#group()) | public | | group 语句处理 |
| [order()](#order()) | public | | order 语句处理 |
| [limit()](#limit()) | public | | limit 语句处理 |
| [find()](#find()) | public | | 读取一条记录 |
| [select()](#select()) | public | | 执行 select 查询 |
| [insert()](#insert()) | public | | 插入记录 |
| [update()](#update()) | public | | update 语句处理 |
| [delete()](#delete()) | public | | delete 语句处理 |
| [duplicate()](#duplicate()) | public | | 克隆数据 |
| [pagination()](#pagination()) | public | | 统计分页 |
| [count()](#count()) | public | | 记录数 |
| [max()](#max()) | public | | 最大值 |
| [min()](#min()) | public | | 最小值 |
| [avg()](#avg()) | public | | 平均值 |
| [sum()](#sum()) | public | | 计算和 |
| [buildSql()](#buildSql()) | public | | 构建 SQL 语句 |
| [getFields()](#getFields()) | public | | 取得字段，`0.2.2` 新增 |
| [getTableInfo()](#getTableInfo()) | public | | 取得表信息，`0.2.2` 新增 |
| [getTables()](#getTables()) | public | | 取得数据表列表，`0.2.2` 新增 |
| [aggProcess()](#aggProcess()) | private | | 聚合查询处理 |
| [buildSelect()](#buildSelect()) | private | | 构建 select 语句 |
| [buildInsert()](#buildInsert()) | private | | 构建 insert 语句 |
| [buildUpdate()](#buildUpdate()) | private | | 构建 update 语句 |
| [buildDelete()](#buildDelete()) | private | | 构建 delete 语句 |
| [buildDuplicate()](#buildDuplicate()) | private | | 构建克隆语句 |
| [buildWhere()](#buildWhere()) | private | | 构建 where 语句 |
| [buildAgg()](#buildAgg()) | private | | 构建聚语句 |
| 继承的方法 | - | - | - |
| [instance()](db_connector.md#instance()) | public | static | 实例化方法 |
| [config()](db_connector.md#init()) | public | | 配置数据库 自 `v0.3.0` 起改为 init() |
| [init()](db_connector.md#init()) | public | | 初始化数据库 `v0.3.0` 新增 |
| [connect()](db_connector.md#connect()) | public | | 连接数据库 |
| [exec()](db_connector.md#exec()) | public | | 执行原生 SQL（一般用于 插入、更新 或者 删除） |
| [query()](db_connector.md#query()) | public | | 执行原生 SQL（一般用于 查询） |
| [lastInsertId()](db_connector.md#lastInsertId()) | public | | 取得新插入的 ID |
| [prepare()](db_connector.md#prepare()) | public | | 预处理 SQL 语句 |
| [execute()](db_connector.md#execute()) | public | | 执行预处理 SQL 语句 |
| [distinct()](db_connector.md#distinct()) | public | | 是否查询不重复的记录 |
| [paginate()](db_connector.md#paginate()) | public | | 分页 |
| [fetchSql()](db_connector.md#fetchSql()) | public | | 是否获取 SQL 语句 |
| [getRowCount()](db_connector.md#getRowCount()) | public | | 取得影响行数 |
| [getRow()](db_connector.md#getRow()) | public | | 取得当前行数据 |
| [getResult()](db_connector.md#getResult()) | public | | 取得结果 |
| [setModel()](db_connector.md#setModel()) | public | | 设置模型名 |
| [setTable()](db_connector.md#setTable()) | public | | 设置数据表名 |
| [getTable()](db_connector.md#getTable()) | public | | 取得当前数据表名 |
| [setPk()](db_connector.md#setPk()) | public | | 设置主键 `0.2.2` 新增 |
| [getPk()](db_connector.md#getPk()) | public | | 取得当前主键名 `0.2.2` 新增 |
| [bind()](db_connector.md#bind()) | public | | 绑定参数 |
| [resetSql()](db_connector.md#resetSql()) | public | | 重置 SQL |
| [fetchBind()](db_connector.md#fetchBind()) | public | | 取得绑定后 SQL（配合 `fetchSql()` 方法） |
| __construct() | protected | | 同 [instance()](db_connector.md#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |

----------

<span id="insertId()"></span>

#### `insertId()` 取得新插入的 ID

``` php
public function insertId() : int
```

参数

* 无

返回

* 新插入的 ID

----------

<span id="table()"></span>

#### `table()` 切换数据表

``` php
public function table( string $table ) : object
```

参数

* `table` 表名

返回

* 本类的实例

----------

<span id="force()"></span>

#### `force()` 强制使用索引名

``` php
public function force( string $index ) : object
```

参数

* `index` 索引名

返回

* 本类的实例

----------

<span id="join()"></span>

#### `join()` join 语句处理

``` php
public function join( string $table [, string $on [, string $type ]] ) : object
```

参数

* `table` join 的表
* `on` on 条件
* `type` join 类型

  可能的值

  | 值 | 类型 | 描述 |
  | - | - | - |
  | INNER（默认） | string | 内连接 |
  | LEFT | string | 左连接 |
  | RIGHT | string | 右连接 |
  | FULL | string | 全连接 |

返回

* 本类的实例

----------

<span id="where()"></span>

#### `where()` where 语句处理

``` php
public function where( mixed $where [, string $exp [, string $value [, string $param [, string $type ]]]] ) : object
```

#### `whereAnd()` whereAnd 语句处理

``` php
public function whereAnd( mixed $where [, string $exp [, string $value [, string $param [, string $type ]]]] ) : object
```

#### `whereOr()` whereOr 语句处理

``` php
public function whereOr( mixed $where [, string $exp [, string $value [, string $param [, string $type ]]]] ) : object
```

参数

* `where` 字段名

  支持两种类型：字符串、数组，为数组时表示批量条件

* `exp` 表达式

  当 `where` 为字符串时为必须，当 `where` 为数组时自动忽略。

* `value` 条件值

  当 `where` 为字符串时为必须，当 `where` 为数组时自动忽略。

* `param` 参数名

  当 `where` 为数组时自动忽略。

* `type` 数据类型

  为空自动判断，当 `where` 为数组时自动忽略。

  可能的值

  | 值 | 类型 | 描述 |
  | - | - | - |
  | str（默认） | string | 字符串 |
  | int | string | 整数 |
  | float | string | 浮点数 |
  | double | string | 数字 |
  | bool | string | 布尔值 |

返回

* 本类的实例

----------

<span id="group()"></span>

#### `group()` group 语句处理

``` php
public function group( mixed $field ) : object
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段

返回

* 本类的实例

----------

<span id="order()"></span>

#### `order()` order 语句处理

``` php
public function order( mixed $field, [ string $type = 'ASC' ] ) : object
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段排序
* `type` 排序类型

返回

* 本类的实例

----------

<span id="limit()"></span>

#### `limit()` limit 语句处理

``` php
public function limit( [ int $limit = false [, int $length = false ]] ) : object
```

参数

* `limit` 偏离或长度
* `length` 长度

返回

* 本类的实例

----------

<span id="find()"></span>

#### `find()` 读取一条记录

``` php
public function find( [ mixed $field ] ) : mixed
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段

返回

* 数据记录

----------

<span id="select()"></span>

#### `select()` 执行 select 查询

``` php
public function select( [ mixed $field [, bool $all = true ]] ) : mixed
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段
* `all` 是否全部记录

返回

* 数据记录集

----------

<span id="insert()"></span>

#### `insert()` 插入记录

``` php
public function insert( mixed $field [, string $value [, string $param [, string $type ]]] ) : int
```

参数

* [`field`](#bind) 字段
* [`value`](#bind) 值
* [`param`](#bind) 参数
* [`type`](#bind) 参数类型

返回

* 影响行数

----------

<span id="update()"></span>

#### `update()` 更新记录

``` php
public function update( mixed $field [, string $value [, string $param [, string $type ]]] ) : int
```

参数

* [`field`](#bind) 字段
* [`value`](#bind) 值
* [`param`](#bind) 参数
* [`type`](#bind) 参数类型

返回

* 影响行数

----------

<span id="delete()"></span>

#### `delete()` 删除记录

``` php
public function delete() : int
```

参数

* 无

返回

* 删除行数

----------

<span id="duplicate()"></span>

#### `duplicate()` 克隆数据

``` php
public function duplicate( [ mixed $field [, string $table ]] ) : int
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段
* `table` 目的表名

返回

* 新插入的 ID

----------

<span id="pagination()"></span>

#### `pagination()` 统计分页

``` php
public function pagination( [ int $perpage = 0 [, mixed $current = 'get' [, string $pageparam = 'page' [, int $pergroup = 0 [, bool $reset = true ]]]]] ) : array
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

* `reset` 是否重置 SQL，如为 true，所有 `$_名称` 类型的属性都将被重置

返回

* [分页参数](../paginator/index.md)

----------

<span id="count()"></span>

#### `count()` 记录数

``` php
public function count( [ mixed $field [, bool $reset = true ]] ) : int
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段
* `reset` 是否重置 SQL，如为 true，所有 `$_名称` 类型的属性都将被重置

返回

* 本类的实例

----------

<span id="max()"></span>

#### `max()` 最大值

``` php
public function max( [ mixed $field ] ) : mixed
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段

返回

* 最大值

----------

<span id="min()"></span>

#### `min()` 最小值

``` php
public function min( [ mixed $field ] ) : mixed
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段

返回

* 最小值

----------

<span id="avg()"></span>

#### `avg()`平均值

``` php
public function avg( [ mixed $field ] ) : mixed
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段

返回

* 平均值

----------

<span id="sum()"></span>

#### `sum()` 和

``` php
public function sum( [ mixed $field ] ) : mixed
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段

返回

* 和

----------

<span id="buildSql()"></span>

#### `buildSql()` 构建 SQL 语句

``` php
public function buildSql() : string
```

参数

* 无

返回

* SQL 语句

----------

<span id="getFields()"></span>

#### `getFields()` 取得字段

`0.2.2` 新增

``` php
public function getFields( [ string $type = '' [, string $table = '' ]] ) : array
```

参数

* `type` 类型

  可能的值

  | 值 | 类型 | 描述 |
  | - | - | - |
  | 空（默认） | | 去掉前缀的表明 |
  | full | string | 完整表名 |

* `table` 指定表

返回

* 字段数组

----------

<span id="getTableInfo()"></span>

#### `getTableInfo()` 取得表信息

`0.2.2` 新增

``` php
public function getTableInfo( [ string $type = '' [, string $table = '' ]] ) : mixed
```

参数

* `type` 类型

  可能的值

  | 值 | 类型 | 描述 |
  | - | - | - |
  | 空（默认） | | 字段信息 |
  | full_columns | string | 完整字段信息 |
  | index | string | 索引 |
  | fields | string | 完整字段列表 |
  | pk | string | 主键 |

* `table` 指定表

返回

* SQL 语句

----------

<span id="getTables()"></span>

#### `getTables()` 取得数据表列表

`0.2.2` 新增

``` php
public function getTables( [ string $dbName = '' ] ) : array
```

参数

* `dbName` 指定数据库

返回

* 数据表列表

----------

<span id="aggProcess()"></span>

#### `aggProcess()` 绑定处理（配合 `fetchSql()` 方法）

``` php
private function aggProcess( string $type, mixed $field [, bool $reset = true ] ) : mixed
```

参数

* `type` 类型

  可能的值

  | 值 | 类型 | 描述 |
  | - | - | - |
  | COUNT（默认） | string | 记录数 |
  | MAX | string | 最大值 |
  | MIN | string | 最小值 |
  | AVG | string | 平均值 |
  | SUM | string | 和 |

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段
* `reset` 是否重置 SQL，如为 true，所有 `$_名称` 类型的属性都将被重置

返回

* 记录 / SQL 语句

----------

<span id="buildSelect()"></span>

#### `buildSelect()` 构建 select 语句

``` php
private function buildSelect( [ mixed $field ] ) : string
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段

返回

* select 语句

----------

<span id="buildInsert()"></span>

#### `buildInsert()` 构建 insert 语句

``` php
private function buildInsert( mixed $field [, string $value [, string $param [, string $type ]]] ) : string
```

参数

* [`field`](#bind) 字段
* [`value`](#bind) 值
* [`param`](#bind) 参数
* [`type`](#bind) 参数类型

返回

* insert 语句

----------

<span id="buildUpdate()"></span>

#### `buildUpdate()` 构建 update 语句

``` php
private function buildUpdate( mixed $field [, string $value [, string $param [, string $type ]]] ) : string
```

参数

* [`field`](#bind) 字段
* [`value`](#bind) 值
* [`param`](#bind) 参数
* [`type`](#bind) 参数类型

返回

* update 语句

----------

<span id="buildDelete()"></span>

#### `buildDelete()` 构建 delete 语句

``` php
private function buildDelete() : string
```

参数

* 无

返回

* delete 语句

----------

<span id="buildDuplicate()"></span>

#### `buildDuplicate()` 构建克隆语句

``` php
private function buildDuplicate( [ mixed $field [, string $table ]] ) : string
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段
* `table` 目的表名

返回

* 克隆语句

----------

<span id="buildWhere()"></span>

#### `buildWhere()` 构建 where 语句

``` php
private function buildWhere( [ bool $add_where = true ] ) : string
```

参数

* `add_where` 是否添加 `WHERE`

返回

* where 语句

----------

<span id="buildAgg()"></span>

#### `buildAgg()` 构建聚合 SQL 语句

``` php
private function buildAgg( string $type [, mixed $field ] ) : string
```

参数

* `type` 类型

  可能的值

  | 值 | 类型 | 描述 |
  | - | - | - |
  | COUNT（默认） | string | 记录数 |
  | MAX | string | 最大值 |
  | MIN | string | 最小值 |
  | AVG | string | 平均值 |
  | SUM | string | 和 |

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段

返回

* 聚合 SQL 语句

----------

<span id="bind"></span>

#### 绑定参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段
* `value` 值

  当 `field` 为字符串时为必须，当 `field` 为数组时自动忽略。

* `param` 参数

  当 `field` 为数组时自动忽略。

* `type` 参数类型

  可能的值

  | 值 | 类型 | 描述 |
  | - | - | - |
  | str（默认） | string | 字符串 |
  | int | string | 整数 |
  | float | string | 浮点数 |
  | double | string | 数字 |
  | bool | string | 布尔值 |
