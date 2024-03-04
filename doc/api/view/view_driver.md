## ginkgo\view\Driver

视图驱动抽象类，无法直接实例化

----------

### 类摘要

```php
namespace ginkgo;

abstract class Driver {
  // 属性
  public $config = array();

  protected static $instance;
  protected $obj_request;
  protected $obj;

  protected $route;
  protected $param;
  protected $pathTpl;

  protected $configThis = array(
    'path' => '',
  );

  // 方法
  public static instance( [ array $config ] ) : object
  public config( array $config )
  public fetch( [ mixed $tpl [, mixed $data ] ) : mixed
  public display( string $content [, mixed $data ] ) : mixed
  public has( [ mixed $tpl ] ) : bool
  public setPath( string $pathTpl )
  public setObj( $name, &$obj )
  public getPath() : string

  protected __construct( [ array $config ] ) : object
  protected __clone()
  protected pathProcess( [ string $tpl ] ) : string
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array | 配置 |
| `$instance` | protected | object static | 本类实例 |
| [`$obj_request`](../request/index.md) | protected | object | 配置 |
| `$obj` | protected | array | 对象 |
| `$route` | protected | array | 路由 |
| `$param` | protected | array | 路由参数 |
| `$pathTpl` | protected | array | 模板路径 |
| [`$configThis`](#$config) | protected | array | 默认配置 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [config()](#config()) | public | | 配置 |
| [fetch()](#fetch()) | public | | 渲染模板 |
| [display()](#display()) | public | | 渲染字符内容 |
| [has()](#has()) | public | | 验证模板文件是否存在 |
| [setPath()](#setPath()) | public | | 设置模板路径 |
| [setObj()](#setObj()) | public | | 设置对象映射 |
| [getPath()](#getPath()) | public | | 获取模板路径 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [pathProcess()](#pathProcess()) | public | | 路径处理 |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

``` php
public $config;
protected $configThis;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| path | string | | 模板路径 |

----------

<span id="instance()"></span>

#### `instance()` 实例化方法

``` php
public static function instance() : object
```

参数

* 无

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

<span id="fetch()"></span>

#### `fetch()` 渲染模板

``` php
public function fetch( [ mixed $tpl [, mixed $data ] ) : mixed
```

参数

* [`tpl`](#tpl) 模板
* `data` 模板变量

返回

* 渲染结果

----------

<span id="display()"></span>

#### `display()` 渲染字符内容

``` php
public function display( string $content [, mixed $data ] ) : mixed
```

参数

* `content` 字符内容，即模板内容
* `data` 模板变量

返回

* 渲染结果

----------

<span id="has()"></span>

#### `has()` 验证模板文件是否存在

``` php
public function has( [ mixed $tpl ] ) : bool
```

参数

* [`tpl`](#tpl) 模板

返回

* 布尔值

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

<span id="pathProcess()"></span>

#### `pathProcess()` 路径处理

``` php
public function pathProcess( [ string $tpl ] ) : string
```

参数

* [`tpl`](#tpl) 模板

返回

* 路径

----------

<span id="tpl"></span>

#### `tpl` 参数

支持如下几种写法：

| 用法 | 描述 | 规则 |
| - | - | - |
| 不带任何参数 | 自动定位 | app/tpl/`当前模块/当前控制器/当前动作`.tpl.php |
| 动作 | 常用写法 | app/tpl/当前模块/当前控制器/`动作`.tpl.php |
| 控制器/动作 | 常用写法 | app/tpl/当前模块/`控制器/动作`.tpl.php |
| 完整的模板路径 | 必须包含模板后缀 | 模板后缀必须与配置一致 |
