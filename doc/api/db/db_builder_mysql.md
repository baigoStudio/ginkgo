## ginkgo\db\builder\Mysql

MySQL 数据库 SQL 语句构造器

----------

### 类摘要

```php
namespace ginkgo\db\builder;
use ginkgo\db\Builder;

class Mysql extends Builder {
  // 属性
  private $exp = array(
    'EQ'                => '=',
    'NEQ'               => '<>',
    'GT'                => '>',
    'EGT'               => '>=',
    'LT'                => '<',
    'ELT'               => '<=',
    'LIKE'              => 'LIKE',
    'NOTLIKE'           => 'NOT LIKE',
    'NOT LIKE'          => 'NOT LIKE',
    'IN'                => 'IN',
    'NOTIN'             => 'NOT IN',
    'NOT IN'            => 'NOT IN',
    'BETWEEN'           => 'BETWEEN',
    'NOTBETWEEN'        => 'NOT BETWEEN',
    'NOT BETWEEN'       => 'NOT BETWEEN',
    'EXP'               => 'EXP',
  );

  private $compopr = array(
    '=', '<>', '>', '>=', '<', '<='
  );

  private $logic = array(
    'AND', 'OR'
  );

  private $order = array(
    'DESC', 'ASC'
  );

  private $join = array(
    'INNER', 'LEFT', 'RIGHT', 'FULL'
  );

  // 继承的属性
  public $config = array(); // 自 v0.3.0 废弃

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
  public field( mixed $field ) : string
  public insert( mixed $field [, string $value [, string $param [, string $type ]]] ) : array
  public update( mixed $field [, string $value [, string $param [, string $type [, string $from = 'update' ]]]] ) : array
  public table( string $table ) : string
  public force( string $index ) : string
  public join( mixed $join [, string $on [, string $type ]] ) : string
  public where( mixed $where [, string $exp [, string $value [, string $param [, string $type ]]]] ) : array
  public group( mixed $field ) : string
  public order( mixed $field [, string $type ] ) : string
  public limit( [ int $limit = false [, int $length = false ]] ) : string
  public addChar( string $value ) : string
  public fieldProcess( string $field ) : string

  protected __construct()
  protected __clone()

  private inArrayProcess( string $name [, string $type = 'order' ] ) : string
  private expProcess( string $name ) : string
  private updateProcess( mixed $field [, string $param [, string $value [, string $from = 'update' ]]] ) : string
  private joinProcess( string $join [, string $on [, string $type = 'INNER' ]] ) : string
  private onProcess( [ string $fidle_1 [, string $compopr [, string $fidle_2 ]]] ) : string
  private whereProcess( string $field [, string $exp = '=' [, string $param [, string $value ]]] ) : string
  private whereProcessSub( string $field [, string $exp = '=' [, string $param [, string $value ]]] ) : string
  private orderProcess( string $field [, string $type = 'ASC' ] ) : string
  private bindProcess( string $bind, string $value [, string $from [, string $param [, string $type [, string $exp [, array $return ]]]]] ) : array
  private isSpecBind( string $value, string $exp ) : bool
  private paramChar( string $param [, string $from [, bool $is_sql = true ]] ) : string

  // 继承的方法
  public instance( [ array $config ] ) : object
  public config( array $config )
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$exp`](#$exp) | private | array | SQL 操作符 |
| [`$compopr`](#$compopr) | private | array | 比较运算符 |
| [`$logic`](#$logic) | private | array | 逻辑运算符 |
| [`$order`](#$order) | private | array | 排序方式 |
| [`$join`](#$join) | private | array | join 方式 |
| 继承的属性 | - | - | - |
| [`$config`](../db.md#$config) | public | array | 配置 |
| `$instance` | protected | object static | 本类的实例 |
| [`$configThis`](../db.md#$config) | private | array | 默认配置 自 `v0.3.0` 废弃 |
| 方法 | - | - | - |
| [field()](#field()) | public | | 处理字段 |
| [insert()](#insert()) | public | | 构建 insert 语句 |
| [update()](#update()) | public | | 构建 update 语句 |
| [table()](#table()) | public | | 处理表名 |
| [force()](#force()) | public | | 处理强制索引 |
| [join()](#join()) | public | | 构建 join 命令 |
| [where()](#where()) | public | | 构建 where 语句 |
| [group()](#group()) | public | | 构建 group 命令 |
| [order()](#order()) | public | | 构建 order 语句 |
| [limit()](#limit()) | public | | 构建 limit 语句 |
| [addChar()](#addChar()) | public | | 添加 SQL 语句名称界定符 |
| [fieldProcess()](#fieldProcess()) | public | | 字段名处理 |
| [inArrayProcess()](#inArrayProcess()) | private | | 命令合法性处理 |
| [expProcess()](#expProcess()) | private | | 运算符合法性处理 |
| [updateProcess()](#updateProcess()) | private | | 处理 update 语句 |
| [joinProcess()](#joinProcess()) | private | | 处理 join 语句 |
| [onProcess()](#onProcess()) | private | | join 语句的 on 命令处理 |
| [whereProcess()](#whereProcess()) | private | | 处理 where 语句 |
| [whereProcessSub()](#whereProcessSub()) | private | | 处理 where 子语句 |
| [orderProcess()](#orderProcess()) | private | | 排序语句处理 |
| [bindProcess()](#bindProcess()) | private | | 绑定处理 |
| [isSpecBind()](#isSpecBind()) | private | | 是否特殊绑定 |
| [paramChar()](#paramChar()) | private | | 绑定参数名处理 |
| 继承的方法 | - | - | - |
| [instance()](db_builder.md#instance()) | public | static | 实例化 |
| [config()](db_builder.md#config()) | public | | 设定配置 |
| __construct() | protected | | 同 [instance()](db_builder.md##instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |

----------

<span id="$exp"></span>

#### `$exp` SQL 操作符

``` php
private $exp;
```

结构

| 名称 | 类型 | 值 | 描述 |
| - | - | - | - |
| EQ | string | = | 等于 |
| NEQ | string | <> | 不等于 |
| GT | string | > | 大于 |
| EGT | string | >= | 大于等于 |
| LT | string | < | 小于 |
| ELT | string | <= | 小于等于 |
| LIKE | string | LIKE | 模糊匹配 |
| NOTLIKE | string | NOT LIKE | 模糊不匹配 |
| NOT LIKE | string | NOT LIKE | 模糊不匹配 |
| IN | string | IN | 在范围内 |
| NOTIN | string | NOT IN | 不在范围内 |
| NOT IN | string | NOT IN | 不在范围内 |
| BETWEEN | string | BETWEEN | 在两者之间 |
| NOTBETWEEN | string | NOT BETWEEN | 不在两者之间 |
| NOT BETWEEN | string | NOT BETWEEN | 不在两者之间 |
| EXP | string | EXP | 原生表达式 |

----------

<span id="$compopr"></span>

#### `$compopr` 比较运算符

``` php
private $compopr;
```

结构

| 名称 | 类型 | 值 | 描述 |
| - | - | - | - |
| 0 | string | = | 等于 |
| 1 | string | <> | 不等于 |
| 2 | string | > | 大于 |
| 3 | string | >= | 大于等于 |
| 4 | string | < | 小于 |
| 5 | string | <= | 小于等于 |

----------

<span id="$logic"></span>

#### `$logic` 逻辑运算符

``` php
private $logic;
```

结构

| 名称 | 类型 | 值 | 描述 |
| - | - | - | - |
| 0 | string | AND | 且 |
| 1 | string | OR | 或 |

----------

<span id="$order"></span>

#### `$order` 排序方式

``` php
private $order;
```

结构

| 名称 | 类型 | 值 | 描述 |
| - | - | - | - |
| 0 | string | DESC | 倒序 |
| 1 | string | ASC | 顺序 |

----------

<span id="$join"></span>

#### `$join` join 方式

``` php
private $join;
```

结构

| 名称 | 类型 | 值 | 描述 |
| - | - | - | - |
| 0 | string | INNER | 内连接 |
| 1 | string | LEFT | 左连接 |
| 2 | string | RIGHT | 右连接 |
| 3 | string | FULL | 全连接 |

----------

<span id="field()"></span>

#### `field()` 处理字段

``` php
public function field( mixed $field ) : string
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段

返回

* 处理后的语句

----------

<span id="insert()"></span>

#### `insert()` 构建 insert 语句

``` php
public function insert( mixed $field [, string $value [, string $param [, string $type ]]] ) : array
```

参数

* [`field`](#bind) 字段
* [`value`](#bind) 值
* [`param`](#bind) 参数
* [`type`](#bind) 参数类型

返回

* 处理后的参数，结构

  | 值 | 描述 |
  | - | - |
  | insert | insert 语句 |
  | bind | 绑定参数 |

----------

<span id="update()"></span>

#### `update()` 构建 update 语句

``` php
public function update( mixed $field [, string $value [, string $param [, string $type [, string $from = 'update' ]]]] ) : array
```

参数

* [`field`](#bind) 字段
* [`value`](#bind) 值
* [`param`](#bind) 参数
* [`type`](#bind) 参数类型
* `from` 来源

返回

* 处理后的参数，结构

  | 值 | 描述 |
  | - | - |
  | update | update 语句 |
  | bind | 绑定参数 |

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

----------

<span id="force()"></span>

#### `force()` 处理强制索引名

``` php
public function force( string $index ) : string
```

参数

* `index` 索引名

返回

* 索引名

----------

<span id="join()"></span>

#### `join()` 构建 join 语句

``` php
public function join( mixed $join [, string $on [, string $type ]] ) : string
```

参数

* [`join`](#joinParam) join 表名
* [`on`](#joinParam) on 条件
* [`type`](#joinParam) join 类型

返回

* 处理后的语句

----------

<span id="where()"></span>

#### `where()` 构建 where 语句

``` php
public function where( mixed $where [, string $exp [, string $value [, string $param [, string $type ]]]] ) : array
```

参数

* `where` where 条件
* `exp` 运算符
* `value` 值
* `param` 参数
* `type` 参数类型

  可能的值

  | 值 | 类型 | 描述 |
  | - | - | - |
  | str（默认） | string | 字符串 |
  | int | string | 整数 |
  | float | string | 浮点数 |
  | double | string | 数字 |
  | bool | string | 布尔值 |

返回

* 处理后的参数，结构

  | 值 | 描述 |
  | - | - |
  | where | where 语句 |
  | bind | 绑定参数 |

----------

<span id="group()"></span>

#### `group()` 构建 group 命令

``` php
public function group( mixed $field ) : string
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段

返回

* 处理后的语句

----------

<span id="order()"></span>

#### `order()` 构建 order 语句

``` php
public function order( mixed $field [, string $type ] ) : string
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段
* `type` 类型

  可能的值

  | 值 | 类型 | 描述 |
  | ASC（默认） | string | ASC | 顺序 |
  | DESC | string | DESC | 倒序 |

返回

* 处理后的语句

----------

<span id="limit()"></span>

#### `limit()` 构建 limit 语句

``` php
public function limit( [ int $limit = false [, int $length = false ]] ) : string
```

参数

* `limit` 偏离或长度
* `length` 长度

返回

* 处理后的语句

----------

<span id="addChar()"></span>

#### `addChar()` 添加 SQL 名称界定符

``` php
public function addChar( string $value ) : string
```

参数

* `value` 名称

返回

* 处理后的名称

----------

<span id="fieldProcess()"></span>

#### `fieldProcess()` 字段名处理

``` php
public function fieldProcess( string $field ) : string
```

参数

* `field` 字段名

返回

* 完整字段名

----------

<span id="inArrayProcess()"></span>

#### `inArrayProcess()` 命令合法性处理，到属性规定的数组中过滤一遍

``` php
private function inArrayProcess( string $name [, string $type = 'order' ] ) : string
```

参数

* `name` 命令
* `type` 类型

  可能的值

  | 值 | 描述 |
  | - | - |
  | order（默认） | 排序方式 |
  | logic | 逻辑运算符 |
  | join | join 方式 |
  | compopr | 比较运算符 |

返回

* 命令名称

----------

<span id="expProcess()"></span>

#### `expProcess()` 运算符合法性处理

``` php
private function expProcess( string $name ) : string
```

参数

* `name` 运算符

返回

* 命令名称

----------

<span id="updateProcess()"></span>

#### `updateProcess()` 处理 update 语句

``` php
private function updateProcess( mixed $field [, string $param [, string $value [, string $from = 'update' ]]] ) : string
```

参数

* [`field`](#bind) 字段
* [`value`](#bind) 值
* [`param`](#bind) 参数
* [`type`](#bind) 参数类型
* `from` 来源

返回

* 处理后的语句

----------

<span id="joinProcess()"></span>

#### `joinProcess()` 处理 join 语句

``` php
private function joinProcess( string $join [, string $on [, string $type = 'INNER' ]] ) : string
```

参数

* [`join`](#joinParam) join 表名
* [`on`](#joinParam) on 条件
* [`type`](#joinParam) join 类型

返回

* 处理后的语句

----------

<span id="onProcess()"></span>

#### `onProcess()`join 语句的 on 命令处理

``` php
private function onProcess( [ string $fidle_1 [, string $compopr [, string $fidle_2 ]]] ) : string
```

参数

* `fidle_1` 字段 1
* `compopr` 运算符
* `fidle_2` 字段 2

返回

* 处理后的语句

----------

<span id="whereProcess()"></span>

#### `whereProcess()` 处理 where 语句

``` php
private function whereProcess( string $field [, string $exp = '=' [, string $param [, string $value ]]] ) : string
```

参数

* `field` 字段
* `exp` 运算符
* `param` 参数
* `value` 值

返回

* 处理后的语句

----------

<span id="whereProcessSub()"></span>

#### `whereProcessSub()` 处理 where 子语句

``` php
private function whereProcessSub( string $field [, string $exp = '=' [, string $param [, string $value ]]] ) : string
```

参数

* `field` 字段
* `exp` 运算符
* `param` 参数
* `value` 值

返回

* 处理后的语句

----------

<span id="orderProcess()"></span>

#### `orderProcess()` 排序语句处理

``` php
private function orderProcess( string $field [, string $type = 'ASC' ] ) : string
```

参数

* `field` 字段，可以使用数组和字符串，为数组时表示多个字段
* `type` 类型

  可能的值

  | 值 | 类型 | 描述 |
  | ASC（默认） | string | ASC | 顺序 |
  | DESC | string | DESC | 倒序 |

返回

* 处理后的语句

----------

<span id="bindProcess()"></span>

#### `bindProcess()` 绑定处理

``` php
private function bindProcess( string $bind, string $value [, string $from [, string $param [, string $type [, string $exp [, array $return ]]]]] ) : array
```

参数

* `bind` 绑定
* [`value`](#bind) 值
* `from` 来源
* [`param`](#bind) 参数
* [`type`](#bind) 参数类型
* `exp` 运算符
* `return` 返回值（用于递归）

返回

* 绑定参数

----------

<span id="isSpecBind()"></span>

#### `isSpecBind()` 是否特殊绑定

``` php
private function isSpecBind( string $value, string $exp ) : bool
```

参数

* `value` 值
* `exp` 运算符

返回

* 布尔值

----------

<span id="paramChar()"></span>

#### `paramChar()` 绑定参数名处理

``` php
private function paramChar( string $param [, string $from [, bool $is_sql = true ]] ) : string
```

参数

* `param` 参数
* `is_sql` 是否为 SQL 命令
* `from` 来源

返回

* 参数名

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

----------

<span id="joinParam"></span>

#### join 参数

* `join` join 表名
* `on` on 条件
* `type` join 类型

  可能的值

  | 值 | 类型 | 描述 |
  | - | - | - |
  | INNER（默认） | string | 内连接 |
  | LEFT | string | 左连接 |
  | RIGHT | string | 右连接 |
  | FULL | string | 全连接 |
