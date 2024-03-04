## ginkgo\Datetime

日期时间处理处理

`0.3.0` 新增 `ginkgo\Datetime`

----------

### 类摘要

```php
namespace ginkgo;

class Datetime {
  // 属性
  public static $config = array();

  private static $configThis = array(
    'date'       => 'Y-m-d', // 日期
    'date_short' => 'm-d', // 短日期
    'time_short' => 'H:i', // 短时间
  );

  private static $init;

  // 方法
  public static toTime( string $datetime ) : int
  public static diff( mixed $begin [, mixed $end = 'now' [, bool $abs = true ]] ) : array
  public static friendly( numeric $time = GK_NOW ) : array
  public config( array $config )
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array static | 配置 |
| [`$configThis`](#$config) | private | array static | 默认配置 |
| `$init` | private | bool static | 是否初始化标志 |
| 方法 | - | - | - |
| [toTime()](#toTime()) | public | static | 日期时间字符串转时间戳 |
| [diff()](#diff()) | public | static | 计算两个时间差 |
| [friendly()](#friendly()) | public | static | 友好的时间 |
| [config()](#config()) | public | | 配置 |

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
| date | string | Y-m-d | 日期 |
| date_short | string | m-d | 短日期 |
| time_short | string | H:i | 短时间 |

----------

<span id="init()"></span>

#### `init()` 初始化

``` php
public static function init( [ array $config ] )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="toTime()"></span>

#### `toTime()` 日期时间字符串转时间戳

``` php
public static function toTime( string $datetime ) : int
```

参数

* `datetime` 日期时间字符串

返回

* UNIX 时间戳

----------

<span id="diff()"></span>

#### `diff()` 计算两个时间差

``` php
public static function diff( mixed $begin [, mixed $end = 'now' [, bool $abs = true ]] ) : array
```

参数

* `begin` 开始时间，UNIX 时间戳或日期时间字符串
* `end` 结束时间，UNIX 时间戳或日期时间字符串，默认值 now，为当前时间
* `abs` 间隔是否强制为正

返回

* 时间差数组

  结构如下：

  | 属性 | 类型 | 描述 |
  | - | - | - |
  | y | int | 间隔年数 |
  | m | int | 间隔月数（除掉年数剩余的） |
  | d | int | 间隔天数（除掉月数剩余的） |
  | h | int | 间隔小时数（除掉天数剩余的） |
  | i | int | 间隔分钟数（除掉小时数剩余的） |
  | s | int | 间隔秒数（除掉分钟数剩余的） |
  | w | int | 间隔周数 |
  | day | int | 间隔天数（除掉周数剩余的） |
  | a | int | 间隔总天数 |
  | period | int | 经历总天数 |

----------

<span id="friendly()"></span>

#### `friendly()` 友好的时间

``` php
public static function friendly( numeric $time = GK_NOW ) : array
```

参数

* `time` UNIX 时间戳，默认为当前时间

返回

* 友好的时间数组

  结构如下：

  | 属性 | 类型 | 描述 |
  | - | - | - |
  | diff | int | 间隔时间 |
  | unit | string | 时间单位 |

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
