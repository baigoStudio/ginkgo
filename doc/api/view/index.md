## ginkgo\View

视图类

----------

### 类摘要

```php
namespace ginkgo;

class View {
  // 属性
  public $config   = array();
  public $replace  = array();

  protected static $instance;

  private $configThis = array(
   'type' => 'php',
  );

  private $obj_driver;
  private $data = array();

  // 方法
  public static instance( [ mixed $config = 'php', [ array $configTpl ]] ) : object
  public config( array $config )
  public driver( [ mixed $config = '', [ array $configTpl ]] ) : object
  public assign( mixed $assign [, mixed $value ] )
  public fetch( [ mixed $tpl [, mixed $assign [, mixed $value [, bool $is_display = false ]]]] ) : mixed
  public display( string $content [, mixed $assign [, mixed $value ]] ) : mixed
  public has( [ mixed $tpl ] ) : bool
  public setReplace( mixed $replace [, string $value ] )
  public setPath( string $pathTpl )
  public setObj( $name, &$obj )
  public getPath() : string
  public reset()

  protected __construct( [ mixed $config = '', [ array $configTpl ]] ) : object
  protected __clone()

  private replaceProcess( string $content ) : string
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array | 配置 |
| `$replace` | public | array | 替换数据 |
| `$instance` | protected | object static | 本类实例 |
| [`$obj_driver`](view_driver_php.md) | private | object | 视图驱动实例 |
| [`$configThis`](#$config) | private | array | 默认配置 |
| `$data` | private | array | 模板数据 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [config()](#config()) | public | | 配置 |
| [driver()](#driver()) | public | | 设置视图驱动 |
| [assign()](#assign()) | public | | 赋值 |
| [fetch()](#fetch()) | public | | 渲染模板 |
| [display()](#display()) | public | | 渲染字符内容 |
| [has()](#has()) | public | | 验证模板文件是否存在 |
| [setReplace()](#setReplace()) | public | | 设置替换数据 |
| [setPath()](#setPath()) | public | | 设置模板路径 |
| [setObj()](#setObj()) | public | | 设置对象映射 |
| [getPath()](#getPath()) | public | | 获取模板路径 |
| [reset()](#reset()) | public | | 重置模板数据 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [replaceProcess()](#replaceProcess()) | private | | 替换数据处理 |

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
| type | string | php | 视图驱动 |

----------

<span id="instance()"></span>

#### `instance()` 实例化方法

``` php
public static function instance( [ mixed $config = 'php', [ array $configTpl ]] ) : object
```

参数

* [`config`](#$config) 视图配置
* [`configTpl`](view_driver.md#$configTpl) 模板配置

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

<span id="driver()"></span>

#### `driver()` 设置视图驱动

``` php
public function driver( [ mixed $config = '', [ array $configTpl ]] ) : object
```

参数

* [`config`](#$config) 视图配置
* [`configTpl`](view_driver.md#$configTpl) 模板配置

返回

* 本类的实例

----------

<span id="assign()"></span>

#### `assign()` 赋值

``` php
public function assign( mixed $assign [, mixed $value ] )
```

参数

* `assign` 变量，字符串或数组

  为数组时表示批量赋值

* `value` 值

  当 `assign` 为字符串时为必须，当 `assign` 为数组时自动忽略

返回

* 无

----------

<span id="fetch()"></span>

#### `fetch()` 渲染模板

``` php
public function fetch( [ mixed $tpl [, mixed $assign [, mixed $value [, bool $is_display = false ]]]] ) : mixed
```

参数

* `tpl` 模板

  支持如下几种写法：

  | 用法 | 描述 | 规则 |
  | - | - | - |
  | 不带任何参数 | 自动定位 | app/tpl/`当前模块/当前控制器/当前动作`.tpl.php |
  | 动作 | 常用写法 | app/tpl/当前模块/当前控制器/`动作`.tpl.php |
  | 控制器/动作 | 常用写法 | app/tpl/当前模块/`控制器/动作`.tpl.php |
  | 完整的模板路径 | 必须包含模板后缀 | 模板后缀必须与配置一致 |

* `assign` 变量，字符串或数组

  为数组时表示批量赋值

* `value` 值

  当 `assign` 为字符串时为必须，当 `assign` 为数组时自动忽略

* `is_display` 是否调用视图驱动的 `display()` 方法

返回

* 渲染结果

----------

<span id="display()"></span>

#### `display()` 渲染字符内容

``` php
public function display( string $content [, mixed $assign [, mixed $value ]] ) : mixed
```

参数

* `content` 字符内容，即模板内容
* `assign` 变量，字符串或数组

  为数组时表示批量赋值

* `value` 值

  当 `assign` 为字符串时为必须，当 `assign` 为数组时自动忽略

返回

* 渲染结果

----------

<span id="has()"></span>

#### `has()` 验证模板文件是否存在

``` php
public function has( [ mixed $tpl ] ) : bool
```

参数

* `tpl` 模板

  支持如下几种写法：

  | 用法 | 描述 | 规则 |
  | - | - | - |
  | 不带任何参数 | 自动定位 | app/tpl/`当前模块/当前控制器/当前动作`.tpl.php |
  | 动作 | 常用写法 | app/tpl/当前模块/当前控制器/`动作`.tpl.php |
  | 控制器/动作 | 常用写法 | app/tpl/当前模块/`控制器/动作`.tpl.php |
  | 完整的模板路径 | 必须包含模板后缀 | 模板后缀必须与配置一致 |

返回

* 布尔值

----------

<span id="setReplace()"></span>

#### `setReplace()` 设置替换数据

``` php
public function setReplace( mixed $replace [, string $value ] )
```

参数

* `replace` 替换数据，字符串或数组

  为字符串时表示名称，为数组时表示批量设置

* `value` 值

  当 `replace` 为字符串时为必须，当 `replace` 为数组时自动忽略。

返回

* 无

----------

<span id="setPath()"></span>

#### `setPath()` 设置模板路径

``` php
public function setPath( string $pathTpl )
```

参数

* `pathTpl` 模板路径

返回

* 无

----------

<span id="setObj()"></span>

#### `setObj()` 设置对象映射

``` php
public function setObj( $name, &$obj )
```

参数

* `name` 对象名称
* `obj` 对象映射

返回

* 无

----------

<span id="getPath()"></span>

#### `getPath()` 获取模板路径

``` php
public function getPath() : string
```

参数

* 无

返回

* 路径

----------

<span id="reset()"></span>

#### `reset()` 重置模板数据

``` php
public function reset()
```

参数

* 无

返回

* 无

----------

<span id="replaceProcess()"></span>

#### `replaceProcess()` 替换数据处理

``` php
private function replaceProcess( string $content ) : string
```

参数

* `content` 内容

返回

* 替换后的内容
