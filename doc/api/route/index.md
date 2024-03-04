# ginkgo\Route

路由管理

----------

### 类摘要

```php
namespace ginkgo;

class Route {
  // 属性
  public static $config = array();

  public static $route = array(
    'mod'   => 'index',
    'ctrl'  => 'index',
    'act'   => 'index',
  );

  public static $routeOrig = array(
    'mod'   => 'index',
    'ctrl'  => 'index',
    'act'   => 'index',
  );

  public static $param = array();

  public static $pathInfo;
  public static $pathOrig;
  public static $pathArr;
  public static $routeExclude = array('page');

  private static $configThis = array(
    'url_suffix'   => '.html',
    'route_rule'   => array(),
    'default_mod'  => '',
    'default_ctrl' => '',
    'default_act'  => '',
  );

  private static $obj_request;
  private static $init;

  // 方法
  public static config( array $config )
  public static get( [ string $name ] ) : mixed
  public static rule( mixed $rule [, mixed $value ] )
  public static check() : array
  public static build( [ string $path [, mixed $param [, minxed $exclude ]]] ) : string
  public static setExclude( mixed $exclude )

  private static init( [ array $config ] )
  private static pathInfoProcess()
  private static ruleProcess()
  private static routeProcess()
  private static routeOrigProcess()
  private static paramProcess()
  private static staticRuleProcess( string $rule, string $value ) : bool
  private static activeRuleProcess( string $rule, string $value ) : bool
  private static regexRuleProcess( array $pathArr, string $value, mixed $param )
  private static validateRoute() : bool
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array static | 配置 `0.2.0` 新增 |
| [`$route`](#$route) | public | array static | 路由 |
| [`$routeOrig`](#$route) | public | array static | 原始路由 |
| `$param` | public | array static | 参数 |
| `$pathInfo` | public | string static | PATHINFO |
| `$pathOrig` | public | string static | 原始 PATHINFO |
| `$pathArr` | public | array static | PATHINFO 解析后的数组 |
| `$routeExclude` | public | array static | 排除参数 |
| [`$configThis`](#$config) | private | array static | 默认配置 `0.2.0` 新增 |
| [`$obj_request`](../request/index.md) | private | object static | 请求实例 |
| `$init` | private | bool static | 是否初始化标志 |
| 方法 | - | - | - |
| [config()](#config()) | public | static | 配置 `0.2.0` 新增 |
| [get()](#get()) | public | static | 获取路由信息 |
| [rule()](#rule()) | public | static | 设置路由规则 |
| [check()](#check()) | public | static | 解析路由 |
| [build()](#build()) | public | static | 建立路由 |
| [setExclude()](#setExclude()) | public | static | 设置排除参数 |
| [init()](#init()) | private | static | 初始化 |
| [pathInfoProcess()](#pathInfoProcess()) | private | static | PATHINFO 处理 |
| [ruleProcess()](#ruleProcess()) | private | static | 路由规则处理 |
| [routeProcess()](#routeProcess()) | private | static | 路由处理 |
| [routeOrigProcess()](#routeOrigProcess()) | private | static | 原始路由处理 |
| [paramProcess()](#paramProcess()) | private | static | 参数处理 |
| [staticRuleProcess()](#staticRuleProcess()) | private | static | 静态规则处理 |
| [activeRuleProcess()](#activeRuleProcess()) | private | static | 动态规则处理 |
| [regexRuleProcess()](#regexRuleProcess()) | private | static | 正则规则处理 |
| [validateRoute()](#validateRoute()) | private | static | 验证路由 |

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
| url_suffix | string | .html | URL 后缀 |
| route_rule | string | | 路由规则 |
| default_mod | string | | 默认模块 |
| default_ctrl | string | | 默认控制器 |
| default_act | string | | 默认动作 |

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

<span id="get()"></span>

#### `get()` 获取路由信息

``` php
public static function get( [ string $name ] ) : mixed
```

参数

* `name` 路由名称

返回

* 路由信息

----------

<span id="rule()"></span>

#### `rule()` 设置路由规则

``` php
public static function rule( mixed $rule [, mixed $value ] )
```

参数

* `rule` 路由规则，字符串或数组

  为字符串时表示名称，为数组时表示批量设置

* `value` 路由值

  当 `rule` 为字符串时为必须，当 `rule` 为数组时自动忽略。

返回

* 无

----------

<span id="check()"></span>

#### `check()` 解析路由

``` php
public static function check() : array
```

参数

* 无

返回

* 完整路由信息

----------

<span id="build()"></span>

#### `build()` 建立路由

``` php
public static function build( [ string $path [, mixed $param [, minxed $exclude ]]] ) : string
```

参数

* `path` 路径
* `param` 参数
* `exclude` 排除参数

返回

* 路由

----------

<span id="setExclude()"></span>

#### `setExclude()` 设置排除参数

``` php
public static function setExclude( mixed $exclude )
```

参数

* `exclude` 排除参数

返回

* 无

----------

<span id="init()"></span>

#### `init()` 初始化

``` php
private static function init( [ array $config ] )
```

参数

* [`config`](#$config) 配置参数 `0.2.0` 新增

返回

* 无

----------

<span id="pathInfoProcess()"></span>

#### `pathInfoProcess()` PATHINFO 处理

``` php
private static function pathInfoProcess()
```

参数

* 无

返回

* 无

----------

<span id="ruleProcess()"></span>

#### `ruleProcess()` 路由规则处理

``` php
private static function ruleProcess()
```

参数

* 无

返回

* 无

----------

<span id="routeProcess()"></span>

#### `routeProcess()` 路由处理

``` php
private static function routeProcess()
```

参数

* 无

返回

* 无

----------

<span id="routeOrigProcess()"></span>

#### `routeOrigProcess()` 原始路由处理

``` php
private static function routeOrigProcess()
```

参数

* 无

返回

* 无

----------

<span id="paramProcess()"></span>

#### `paramProcess()` 参数处理

``` php
private static function paramProcess()
```

参数

* 无

返回

* 无

----------

<span id="staticRuleProcess()"></span>

#### `staticRuleProcess()` 静态规则处理

``` php
private static function staticRuleProcess( string $rule, string $value ) : bool
```

参数

* `rule` 规则
* `value` 路由信息

返回

* 布尔值

----------

<span id="activeRuleProcess()"></span>

#### `activeRuleProcess()` 动态规则处理

``` php
private static function activeRuleProcess( string $rule, string $value ) : bool
```

参数

* `rule` 规则
* `value` 路由信息

返回

* 布尔值

----------

<span id="regexRuleProcess()"></span>

#### `regexRuleProcess()` 正则规则处理

``` php
private static function regexRuleProcess( array $pathArr, string $value, mixed $param )
```

参数

* `pathArr` PATHINFO 解析后的数组
* `value` 路由信息
* `param` 规则指定的参数名

返回

* 无

----------

<span id="validateRoute()"></span>

#### `validateRoute()` 验证路由

``` php
private static function validateRoute() : bool
```

参数

* 无

返回

* 布尔值
