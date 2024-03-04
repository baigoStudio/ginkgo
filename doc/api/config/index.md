## ginkgo\Config

配置管理

----------

### 类摘要

```php
namespace ginkgo;

class Config {
  // 属性
  public static $config;
  public static $range = array();
  public static $count = 1;

  private static $init;

  // 方法
  public static init()
  public static range( [ string $range ] ) : array
  public static add( mixed $name [, mixed $value [, string $range ]] )
  public static set( mixed $name [, mixed $value [, string $range ]] )
  public static get( [ string $name [, string $range ]] ) : mixed
  public static delete( [ string $name [, string $range ]] )
  public static count() : int
  public static load( string $path [, string $name [, string $range ]] ) : mixed
  public static write( string $path [, mixed $value ] ) : int

  private static loadSys()
  private static rangeProcess( [ string $range ] ) : array
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$config` | public | array static | 配置值 |
| `$range` | public | string static | 作用域 |
| `$count` | public | int static | 载入配置文件计数 |
| `$init` | private | bool static | 是否初始化 |
| 方法 | - | - | - |
| [init()](#init()) | public | static | 初始化 |
| [range()](#range()) | public | static | 设置、获取作用域 |
| [add()](#add()) | public | static | 添加配置（不覆盖） |
| [set()](#set()) | public | static | 设置配置（覆盖） |
| [get()](#get()) | public | static | 读取配置 |
| [delete()](#delete()) | public | static | 删除配置 |
| [count()](#count()) | public | static | 载入配置文件计数 |
| [load()](#load()) | public | static | 载入配置文件 |
| [write()](#write()) | public | static | 写入配置文件 |
| [loadSys()](#loadSys()) | private | static | 载入系统配置 |
| [rangeProcess()](#rangeProcess()) | private | static | 作用域处理 |

----------

<span id="init()"></span>

#### `init()` 初始化

``` php
public static function init()
```

参数

* 无

返回

* 无

----------

<span id="range()"></span>

#### `range()` 设置、获取作用域

``` php
public static function range( [ string $range ] ) : array
```

参数

* `range` 作用域，支持二级作用域，两级作用域之间用 <kbd>.</kbd> 隔开，如此参数为空，则返回作用域

返回

* 作用域

----------

<span id="add()"></span>

#### `add()` 添加配置（不覆盖）

``` php
public static function add( mixed $name [, mixed $value [, string $range ]] )
```

参数

* `name` 名称

  支持两种类型：为字符串时表示配置名，为数组时表示批量添加

* `value` 值

  当 `name` 为字符串时为必须，当 `name` 为数组时自动忽略。

* [`range`](#range()) 作用域

返回

* 无

----------

<span id="set()"></span>

#### `set()` 设置配置（覆盖）

``` php
public static function set( mixed $name [, mixed $value [, string $range ]] )
```

参数

* `name` 名称

  支持两种类型：为字符串时表示配置名，为数组时表示批量设置

* `value` 值

  当 `name` 为字符串时为必须，当 `name` 为数组时自动忽略。

* [`range`](#range()) 作用域

返回

* 无

----------

<span id="get()"></span>

#### `get()` 读取配置

``` php
public static function get( [ string $name [, string $range ]] ) : mixed
```

参数

* `name` 名称
* [`range`](#range()) 作用域

返回

* 配置

----------

<span id="delete()"></span>

#### `delete()` 删除配置

``` php
public static function delete( [ string $name [, string $range ]] )
```

参数

* `name` 名称
* [`range`](#range()) 作用域

返回

* 无

----------

<span id="count()"></span>

#### `count()` 载入配置文件计数

``` php
public static function count() : int
```

参数

* 无

返回

* 载入配置文件计数

----------

<span id="load()"></span>

#### `load()` 载入配置文件

``` php
public static function load( string $path [, string $name [, string $range ]] ) : mixed
```

参数

* `path` 配置文件路径
* `name` 名称
* [`range`](#range()) 作用域

返回

* 配置

----------

<span id="write()"></span>

#### `write()` 载入配置文件

``` php
public static function write( string $path [, mixed $value ] ) : int
```

参数

* `path` 配置文件路径
* `value` 值

  支持两种类型：字符串、数组

返回

* 写入字节数

----------

<span id="loadSys()"></span>

#### `loadSys()` 载入系统配置

``` php
private static function loadSys()
```

参数

* 无

返回

* 无

----------

<span id="rangeProcess()"></span>

#### `rangeProcess()` 作用域处理

``` php
private static function rangeProcess( [ string $range ] ) : array
```

参数

* [`range`](#range()) 作用域

返回

* 处理后的作用域数组
