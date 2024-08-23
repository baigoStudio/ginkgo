## ginkgo\Error

异常、错误处理

----------

### 类摘要

```php
namespace ginkgo;

class Error {
  // 属性
  public static $config;

  private static $errType = array(
    E_ERROR              => 'Error - E_ERROR',
    E_CORE_ERROR         => 'Core Error - E_CORE_ERROR',
    E_COMPILE_ERROR      => 'Compile Error - E_COMPILE_ERROR',
    E_USER_ERROR         => 'User Error - E_USER_ERROR',
    E_RECOVERABLE_ERROR  => 'Catchable Fatal Error - E_RECOVERABLE_ERROR',

    E_PARSE              => 'Parsing Error - E_PARSE',

    E_WARNING            => 'Warning - E_WARNING',
    E_CORE_WARNING       => 'Core Warning - E_CORE_WARNING',
    E_COMPILE_WARNING    => 'Compile Warning - E_COMPILE_WARNING',
    E_USER_WARNING       => 'User Warning - E_USER_WARNING',

    E_NOTICE             => 'Notice - E_NOTICE',
    E_USER_NOTICE        => 'User Notice - E_USER_NOTICE',

    E_STRICT             => 'Runtime Notice - E_STRICT',
  );
  private static $errFatal = array(
    E_ERROR,
    E_PARSE,
    E_CORE_ERROR,
    E_COMPILE_ERROR,
    E_RECOVERABLE_ERROR,
  );
  private static $optDebugDump = false;
  private static $uncatchable;
  private $configThis = array(
    'dump'  => false,
    'tag'   => 'div',
    'class' => 'container p-5',
  );

  // 方法
  public static register( [ mixed $config = false ] )
  public static config( mixed $config )
  public static appError( int $err_no, string $err_msg, string $err_file, int $err_line )
  public static appExcept( object $excpt )
  public static appShutdown()
  public static fetch( [ string $tpl [, array $data ]] ) : string
  public static dump( array $error ) : string

  private static isFatal( int $type ) : bool
  private static sendErr( array $error )
  private static pathProcess( [ string $tpl ] ) : string
  private static configProcess( [ mixed $config = false ] ) : array
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array static | 调试配置 |
| [`$configThis`](#$config) | private | array static | 默认配置（`0.2.0` 新增） |
| [`$errType`](#$errType) | private | array static | 错误类型 |
| [`$errFatal`](#$errFatal) | private | array static | 致命错误类型 |
| `$optDebugDump` | private | bool static | 调试配置 |
| `$uncatchable` | private | array static | 无法捕获的错误 |
| 方法 | - | - | - |
| [register()](#register()) | public | static | 注册错误处理方法 |
| [config()](#config()) | public | static | 取得错误 |
| [appError()](#appError()) | public | static | 错误处理 |
| [appExcept()](#appExcept()) | public | static | 异常处理 |
| [appShutdown()](#appShutdown()) | public | static | 程序关闭处理 |
| [fetch()](#fetch()) | public | static | 渲染错误模板 |
| [dump()](#dump()) | public | static | 输出错误 |
| [isFatal()](#isFatal()) | private | static | 判断是否为致命错误 |
| [sendErr()](#sendErr()) | private | static | 输出报错信息 |
| [pathProcess()](#pathProcess()) | private | static | 模板路径处理 |
| [configProcess()](#configProcess()) | private | static | 配置处理 |

----------

<span id="$config"></span>

#### `$config` 调试配置，`$configThis` 默认配置

``` php
public static $config;
private static $configThis;
```

可以为字符串、布尔值和数组

当此属性为 true 或者 'true' 是表示打开调试功能，false 为关闭

为数组时，结构如下：

| 名称 | 类型 | 描述 |
| - | - | - |
| dump | mixed | true 或者 'true' 是表示打开调试功能，false 为关闭，'trace' 输出追踪 |
| tag | string | 调试信息包含在标签内 |
| class | string | 调试信息包含标签的 css 类名 |

----------

<span id="$errType"></span>

#### `$errType` 错误类型

``` php
private static $errType;
```

结构

| 名称 | 类型 | 描述 |
| - | - | - |
| E_ERROR | 预定义常量 | 致命错误 |
| E_CORE_ERROR | 预定义常量 | 内核错误 |
| E_COMPILE_ERROR | 预定义常量 | 致命编译时错误 |
| E_USER_ERROR | 预定义常量 | 用户错误 |
| E_RECOVERABLE_ERROR | 预定义常量 | 可被捕捉的致命错误 |
| E_PARSE | 预定义常量 | 解析错误（语法错误） |
| E_WARNING | 预定义常量 | 警告（非致命错误） |
| E_CORE_WARNING | 预定义常量 | 内核通知（非致命错误） |
| E_COMPILE_WARNING | 预定义常量 | 编译时警告（非致命错误） |
| E_USER_WARNING | 预定义常量 | 用户警告 |
| E_NOTICE | 预定义常量 | 通知 |
| E_USER_NOTICE | 预定义常量 | 用户通知 |
| E_STRICT | 预定义常量 | 运行时通知 |

----------

<span id="$errFatal"></span>

#### `$errFatal` 致命错误类型

``` php
private static $errFatal;
```

结构

| 名称 | 类型 | 描述 |
| - | - | - |
| E_ERROR | 预定义常量 | 致命错误 |
| E_PARSE | 预定义常量 | 解析错误（语法错误） |
| E_CORE_ERROR | 预定义常量 | 内核错误 |
| E_COMPILE_ERROR | 预定义常量 | 致命编译时错误 |
| E_RECOVERABLE_ERROR | 预定义常量 | 可被捕捉的致命错误 |

----------

<span id="register()"></span>

#### `register()` 初始化

``` php
public static function register( [ mixed $config = false ] )
```

参数

* [`config`](#$config) 配置 `0.2.0`新增

返回

* 无

----------

<span id="config()"></span>

#### `config()` 配置

`0.2.0` 新增

``` php
public static function config( mixed $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="appError()"></span>

#### `appError()` 错误处理

``` php
public static function appError( int $err_no, string $err_msg, string $err_file, int $err_line )
```

参数

* `err_no` 错误号
* `err_msg` 错误消息
* `err_file` 错误所在文件
* `err_line` 错误所在行

返回

* 无

----------

<span id="appExcept()"></span>

#### `appExcept()` 异常处理

``` php
public static function appExcept( object $excpt )
```

参数

* `excpt` 异常实例

返回

* 无

----------

<span id="appShutdown()"></span>

#### `appShutdown()` 程序关闭处理

``` php
public static function appShutdown()
```

参数

* 无

返回

* 无

----------

<span id="fetch()"></span>

#### `fetch()` 渲染错误模板

``` php
public static function fetch( [ string $tpl [, array $data ]] ) : string
```

参数

* `tpl` 模板路径
* `data` 待渲染数据

返回

* 渲染结果

----------

<span id="dump()"></span>

#### `dump()` 判断是否为致命错误

``` php
public static function dump( array $error ) : string
```

参数

* `error` 错误信息

返回

* HTML 代码

----------

<span id="isFatal()"></span>

#### `isFatal()` 判断是否为致命错误

``` php
private static function isFatal( int $type ) : bool
```

参数

* `type` 错误类型

返回

* 布尔值

----------

<span id="sendErr()"></span>

#### `sendErr()` 输出报错信息

``` php
private static function sendErr( array $error )
```

参数

* `error` 错误信息

返回

* 无

----------

<span id="pathProcess()"></span>

#### `pathProcess()` 错误模板路径处理

``` php
private static function pathProcess( [ string $tpl ] ) : string
```

参数

* `tpl` 模板路径

返回

* 完整模板路径

----------

<span id="configProcess()"></span>

#### `configProcess()` 错误模板路径处理

`0.2.0` 新增

``` php
private static function configProcess( [ mixed $config = false ] ) : array
```

参数

* `config` 配置

返回

* 处理过的配置参数
