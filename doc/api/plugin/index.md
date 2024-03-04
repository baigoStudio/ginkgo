## ginkgo\Plugin

插件管理调度

----------

### 类摘要

```php
namespace ginkgo;

class Plugin {
  // 属性
  protected static $instance = array();

  private static $listeners = array();
  private static $obj_file;
  private static $init;

  // 方法
  public static add( string $hook, object &$object, string $method )
  public static listen( string $hook [, mixed $data ] ) : mixed

  private static init()
  private static configProcess( string $dir ) : array
  private static dirProcess( mixed $key, mixed $value ) : string
  private static namespaceProcess( string $dir, array $config ) : string
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$instance` | protected | array static | 用静态属性保存实例 |
| 方法 | - | - | - |
| [add()](#add()) | public | static | 将插件方法挂载到钩子 |
| [listen()](#listen()) | public | static | 在系统内埋设钩子 |
| [init()](#init()) | private | static | 初始化 |
| [configProcess()](#configProcess()) | private | static | 插件配置处理 |
| [dirProcess()](#dirProcess()) | private | static | 插件目录处理 |
| [namespaceProcess()](#namespaceProcess()) | private | static | 插件命名空间处理 |

----------

<span id="add()"></span>

#### `add()` 将插件方法挂载到钩子

``` php
public static function add( string $hook, object &$object, string $method )
```

参数

* `hook` 钩子名称
* `object` 插件实例
* `method` 执行插件的方法

返回

* 无

----------

<span id="listen()"></span>

#### `listen()` 在系统内埋设钩子

``` php
public static function listen( string $hook [, mixed $data ] ) : mixed
```

参数

* `hook` 钩子名称
* `data` 数据

返回

* 插件处理后的数据

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

<span id="configProcess()"></span>

#### `configProcess()` 插件配置处理

``` php
public static function configProcess( string $dir ) : array
```

参数

* `dir` 目录

返回

* 插件配置

----------

<span id="dirProcess()"></span>

#### `dirProcess()` 插件目录处理

``` php
public static function dirProcess( mixed $key, mixed $value ) : string
```

参数

* `key` 键名
* `value` 值

返回

* 目录名

----------

<span id="namespaceProcess()"></span>

#### `namespaceProcess()` 插件命名空间处理

``` php
public static function namespaceProcess( string $dir, array $config ) : string
```

参数

* `dir` 目录
* `config` 配置

返回

* 命名空间
