# ginkgo\App

应用调度管理

----------

### 类摘要

```php
namespace ginkgo;

class App {
  // 属性
  public static $config = array();
  public static $header = array(); // 0.2.3 新增

  private static $configThis = array(
    'timezone'         => 'Asia/Shanghai',
    'return_type'      => 'html',
    'return_type_ajax' => 'json',
  );

  private static $obj_request;
  private static $obj_lang;
  private static $route;
  private static $init;

  // 方法
  public static init( [ array $config ] )
  public static run( [ array $config ] ) : object
  public static config( array $config )
  public header( mixed $header [, string $value ] )
  public static setTimezone( string $timezone )

  private static configProcess()
  private static extraProcess()
  private static langProcess()
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array static | 配置 `0.2.0` 新增 |
| [`$header`](#$header) | public | array static | 响应头 `0.2.3` 新增 |
| [`$configThis`](#$config) | private | array static | 默认配置 `0.2.0` 新增 |
| [`$obj_request`](../request/index.md) | private | object static | 请求实例 |
| [`$obj_lang`](../lang/index.md) | private | object static | 语言实例 |
| [`$route`](#$route) | private | array static | 路由 |
| `$init` | private | bool static | 是否初始化标志 |
| 方法 | - | - | - |
| [init()](#init()) | public | static | 初始化 |
| [run()](#run()) | public | static | 运行应用 |
| [config()](#config()) | public | static | 配置 `0.2.0` 新增 |
| [header()](#header()) | public | static | 设置响应头 `0.2.3` 新增 |
| [setTimezone()](#setTimezone()) | public | static | 设置时区 |
| [configProcess()](#configProcess()) | private | static | 配置处理 |
| [extraProcess()](#extraProcess()) | private | static | 扩展处理 |
| [langProcess()](#langProcess()) | private | static | 语言处理 |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

`0.2.0` 新增

``` php
public static $config;
private static $configThis;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| timezone | string | Asia/Shanghai | 默认时区 |
| return_type | string | html | 默认返回类型 |
| return_type_ajax | string | json | 默认 Ajax 返回类型 |

----------

<span id="$header"></span>

#### `$header` 响应头

`0.2.3` 新增

``` php
public static $header;
```

符合响应头信息规范

----------

<span id="$route"></span>

#### `$route` 路由

``` php
private static $route;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| mod | string | index | 模块 |
| ctrl | string | index | 控制器 |
| act | string | index | 动作 |

----------

<span id="init()"></span>

#### `init()` 初始化

``` php
public static function init( [ array $config ] )
```

参数

* [`config`](#$config) 配置参数 `0.2.0` 新增

返回

* 无

----------

<span id="run()"></span>

#### `run()` 运行应用

``` php
public static function run( [ array $config ] ) : object
```

参数

* [`config`](#$config) 配置参数 `0.2.0` 新增

返回

* [ginkgo\Response](../response/index.md) 实例

----------

<span id="config()"></span>

#### `config()` 配置

`0.2.0` 新增

``` php
public static function config( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="header()"></span>

#### `header()` 设置响应头信息

`0.2.3` 新增

``` php
public static function header( mixed $header )
```

参数

* `header` 响应头，字符串或数组

  为字符串时表示名称，为数组时表示批量设置

* `value` 值

  当 `header` 为字符串时为必须，当 `header` 为数组时自动忽略。

返回

* 无

----------

<span id="setTimezone()"></span>

#### `setTimezone()` 设置时区

``` php
public static function setTimezone( string $timezone )
```

参数

* `timezone` 时区标识符，详情请参见 [php 官网](https://www.php.net/manual/zh/timezones.php)

返回

* 无

----------

<span id="configProcess()"></span>

#### `configProcess()` 配置处理

``` php
private static function configProcess()
```

参数

* 无

返回

* 无

----------

<span id="extraProcess()"></span>

#### `extraProcess()` 扩展处理

``` php
private static function extraProcess()
```

参数

* 无

返回

* 无

----------

<span id="langProcess()"></span>

#### `langProcess()` 语言处理

``` php
private static function langProcess()
```

参数

* 无

返回

* 无
