## ginkgo\Log

日志管理

----------

### 类摘要

```php
namespace ginkgo;

class Log {
  // 属性
  public static $config = array();
  public static $log;

  private static $configThis = array(
    'save'      => false,
    'file_size' => 2097152,
  );

  private static $init;

  // 方法
  public static init( array $config )
  public static config( array $config )
  public static get( [ string $type ] ) : mixed
  public static record( mixed $value [, string $type ] )
  public static save()
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | string static | 配置 |
| `$log` | public | string static | 日志 |
| [`$configThis`](#$config) | private | array static | 默认图片 MIME |
| `$init` | private | bool static | 是否初始化 |
| 方法 | - | - | - |
| [init()](#init()) | public | static | 初始化 |
| [config()](#config()) | public | static | 配置 |
| [get()](#get()) | public | static | 获取日志 |
| [record()](#record()) | public | static | 记录日志 |
| [save()](#save()) | public | static | 保存日志 |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

`0.2.0` 新增

``` php
public $config;
private $configThis;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| save | bool | flase | 是否自动保存日志 |
| file_size | int | 2097152 | 日志文件大小，超过将另存新文件 |

----------

<span id="init()"></span>

#### `init()` 初始化

``` php
public static function init( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="config()"></span>

#### `config()` 配置

``` php
public static function config( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="get()"></span>

#### `get()` 获取日志

``` php
public static function get( [ string $type ] ) : mixed
```

参数

* `type` 类型

返回

* 日志

----------

<span id="record()"></span>

#### `record()` 记录日志

``` php
public static function record( mixed $value [, string $type ] )
```

参数

* `value` 日志内容
* `type` 类型

返回

* 无

----------

<span id="save()"></span>

#### `save()` 保存日志

``` php
public static function save()
```

参数

* 无

返回

* 无
