## ginkgo\Lang

语言处理

----------

### 类摘要

```php
namespace ginkgo;

class Lang {
  // 属性
  public $lang;
  public $config = array();
  public $current;
  public $clientLang;
  public $range = '';

  protected static $instance;

  private $configThis = array(
    'switch'    => false,
    'default'   => 'zh_CN',
  );

  // 方法
  public static instance( [ array $config ] ) : object
  public config( array $config )
  public range( string $range ) : string
  public getCurrent( [ bool $lower = false [, string $separator [, bool $client = false ]]] ) : string
  public setCurrent( string $lang )
  public add( mixed $name [, mixed $value [, string $range ]] )
  public set( mixed $name [, mixed $value [, string $range ]] )
  public get( [ string $name [, string $range [, array $replace [, bool $show_src = true ]]]] ) : mixed
  public load( string $path [, string $range ] ) : mixed

  protected __construct( [ array $config ] ) : object
  protected __clone()

  private init()
  private rangeProcess( string $range ) : mixed
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$lang` | public | string | 错误 |
| [`$config`](#$config) | public | string | 错误 |
| `$current` | public | string | 错误 |
| `$clientLang` | public | string | 错误 |
| `$range` | public | string | 错误 |
| `$instance` | protected | object static | 本类实例 |
| [`$configThis`](#$config) | private | array | 默认图片 MIME |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [config()](#config()) | public | | 配置 |
| [range()](#range()) | public | | 设置、获取作用域 |
| [getCurrent()](#getCurrent()) | public | | 获取当前语言 |
| [setCurrent()](#setCurrent()) | public | | 设置当前语言 |
| [add()](#add()) | public | | 添加语言变量 |
| [set()](#set()) | public | | 设置语言变量 |
| [get()](#get()) | public | | 获取语言变量 |
| [load()](#load()) | public | | 载入语言文件 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [init()](#init()) | private | | 初始化 |
| [rangeProcess()](#rangeProcess()) | private | | 作用域处理 |

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
| switch | bool | false | 是否启用开关 |
| default | string | zh_CN | 默认语言 |

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

#### `config()` 配置

``` php
public function config( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="range()"></span>

#### `range()` 设置、获取作用域

``` php
public function range( [ string $range ] ) : array
```

参数

* `range` 作用域，支持二级作用域，两级作用域之间用 <kbd>.</kbd> 隔开，如此参数为空，则返回作用域

返回

* 作用域

----------

<span id="getCurrent()"></span>

#### `getCurrent()` 获取当前语言

``` php
public function getCurrent( [ bool $lower = false [, string $separator [, bool $client = false ]]] ) : string
```

参数

* `lower` 是否返回小写字母
* `separator` 语言分隔符字体
* `client` 是否以客户端语言为准

返回

* 当前语言

----------

<span id="setCurrent()"></span>

#### `setCurrent()` 设置当前语言

``` php
public function setCurrent( string $lang )
```

参数

* `lang` 语言

返回

* 无

----------

<span id="add()"></span>

#### `add()` 添加语言变量（不覆盖）

``` php
public function add( mixed $name [, mixed $value [, string $range ]] )
```

参数

* `name` 名称

  支持两种类型：为字符串时表示语言变量名，为数组时表示批量添加

* `value` 值

  当 `name` 为字符串时为必须，当 `name` 为数组时自动忽略。

* [`range`](#range()) 作用域

返回

* 无

----------

<span id="set()"></span>

#### `set()` 设置语言变量（覆盖）

``` php
public function set( mixed $name [, mixed $value [, string $range ]] )
```

参数

* `name` 名称

  支持两种类型：为字符串时表示语言变量名，为数组时表示批量设置

* `value` 值

  当 `name` 为字符串时为必须，当 `name` 为数组时自动忽略。

* [`range`](#range()) 作用域

返回

* 无

----------

<span id="get()"></span>

#### `get()` 读取语言变量

``` php
public function get( [ string $name [, string $range [, array $replace [, bool $show_src = true ]]]] ) : mixed
```

参数

* `name` 名称
* [`range`](#range()) 作用域
* `replace` 输出替换
* `show_src` 返回原始字符

返回

* 语言变量

----------

<span id="load()"></span>

#### `load()` 载入语言文件

``` php
public function load( string $path [, string $range ] ) : mixed
```

参数

* `path` 语言文件路径
* `range` 作用域

返回

* 语言文件内容

----------

<span id="init()"></span>

#### `init()` 初始化

``` php
private function init()
```

参数

* 无

返回

* 无

----------

<span id="rangeProcess()"></span>

#### `rangeProcess()` 作用域处理

``` php
private function rangeProcess( string $range ) : mixed
```

参数

* `range` 作用域

返回

* 作用域
