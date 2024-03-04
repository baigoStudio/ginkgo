## ginkgo\Cookie

Cookie 管理

----------

### 类摘要

```php
namespace ginkgo;

class Cookie {
  // 属性
  public static $config;

  private static $configThis = array(
    'prefix'    => '',
    'expire'    => 0,
    'path'      => '/',
    'domain'    => '',
    'secure'    => false,
    'httponly'  => true,
    'setcookie' => true,
  );
  private static $init;

  // 方法
  public static init( [ array $config ] )
  public static prefix( [ string $prefix ] ) : string
  public static set( string $name, string $value [, array $option ] )
  public static get( string $name [, string $prefix ] ) : string
  public static delete( string $name [, string $prefix ] )
  public static config( array $config )
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array static | 配置 |
| [`$configThis`](#$config) | private | array static | 默认配置 |
| `$init` | private | bool static | 是否初始化 |
| 方法 | - | - | - |
| [init()](#init()) | public | static | 初始化 |
| [prefix()](#prefix()) | public | static | 设置、读取前缀 |
| [set()](#set()) | public | static | 设置 Cookie |
| [get()](#get()) | public | static | 读取 Cookie |
| [delete()](#delete()) | public | static | 删除 Cookie |
| [config()](#config()) | public | static | 配置（`0.2.0` 新增） |

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
| prefix | string | | Cookie 名称前缀 |
| expire | int | 0 | Cookie 保存时间 |
| path | string | / | Cookie 保存路径 |
| domain | string | | Cookie 有效域名 |
| secure | bool | false | Cookie 启用安全传输 |
| httponly | bool | true | httponly 设置 |
| setcookie | bool | true | 是否使用 setcookie |

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

<span id="prefix()"></span>

#### `prefix()` 设置、读取前缀

``` php
public static function prefix( [ string $prefix ] ) : string
```

参数

* `prefix` 前缀，如此参数为空，则返回当前前缀

返回

* 前缀

----------

<span id="set()"></span>

#### `set()` 设置 Cookie

``` php
public static function set( string $name, string $value [, array $option ] )
```

参数

* `name` 名称
* `value` 值
* [`option`](#$config) 选项参数

返回

* 无

----------

<span id="get()"></span>

#### `get()` 读取 Cookie

``` php
public static function get( string $name [, string $prefix ] ) : string
```

参数

* `name` 名称
* `prefix` 前缀

返回

* Cookie

----------

<span id="delete()"></span>

#### `delete()` 删除 Cookie

``` php
public static function delete( string $name [, string $prefix ] )
```

参数

* `name` 名称
* `prefix` 前缀

返回

* 无

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
