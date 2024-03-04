# ginkgo\Session

会话管理

----------

### 类摘要

```php
namespace ginkgo;

class Session {
  // 属性
  public static $config = array();

  private static $configThis = array(
    'autostart'     => false,
    'name'          => '',
    'type'          => 'file',
    'path'          => '',
    'prefix'        => 'ginkgo_',
    'cookie_domain' => '',
    'life_time'     => 1200,
  );

  private static $init;

  // 方法
  public static init( [ array $config ] )
  public static config( array $config )
  public static prefix( [ string $prefix ] ) : string
  public static set( string $name, string $value [, string $prefix ] )
  public static get( string $name, string [, string $prefix ] ) : string
  public static delete( string $name, string [, string $prefix ] )

  private static prefixProcess( string $prefix ) : array
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array static | 配置 `0.2.0` 新增 |
| [`$configThis`](#$config) | private | array static | 默认配置 `0.2.0` 新增 |
| `$init` | private | bool static | 是否初始化标志 |
| 方法 | - | - | - |
| [init()](#init()) | public | static | 初始化 |
| [config()](#config()) | public | static | 配置 `0.2.0` 新增 |
| [prefix()](#prefix()) | public | static | 设置、获取前缀 |
| [set()](#set()) | public | static | 设置会话变量 |
| [get()](#get()) | public | static | 获取会话变量 |
| [delete()](#delete()) | public | static | 删除会话变量 |
| [prefixProcess()](#prefixProcess()) | private | static | 前缀处理 |

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
| autostart| bool | false | 是否自动开始 |
| name | string | | Session ID 名称 |
| type | string | file | 会话类型 |
| path | string | | 保存路径（仅对 file 类型有效） |
| prefix | string | ginkgo_ | 会话前缀 |
| cookie_domain | string | 设定会话 cookie 的域名 |
| life_time | string | 1200 | 会话生命周期 |

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

<span id="prefix()"></span>

#### `prefix()` 设置、获取前缀

``` php
public static function prefix( [ string $prefix ] ) : string
```

参数

* `prefix` 前缀，支持二级前缀，两级前缀之间用 <kbd>.</kbd> 隔开，为空时返回前缀

返回

* 前缀

----------

<span id="set()"></span>

#### `set()` 设置会话变量

``` php
public static function set( string $name, string $value [, string $prefix ] )
```

参数

* `name` 变量名
* `value` 变量值
* [`prefix`](#prefix()) 前缀

返回

* 无

----------

<span id="get()"></span>

#### `get()` 获取会话变量

``` php
public static function get( string $name, string [, string $prefix ] ) : string
```

参数

* `name` 变量名
* [`prefix`](#prefix()) 前缀

返回

* 变量

----------

<span id="delete()"></span>

#### `delete()` 删除会话变量

``` php
public static function delete( string $name, string [, string $prefix ] )
```

参数

* `name` 变量名
* [`prefix`](#prefix()) 前缀

返回

* 无

----------

<span id="prefixProcess()"></span>

#### `prefixProcess()` 前缀处理

``` php
private static function prefixProcess( string $prefix ) : array
```

参数

* [`prefix`](#prefix()) 前缀

返回

* 前缀
