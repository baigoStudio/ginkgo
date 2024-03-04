## ginkgo\view\driver\Php

ginkgo 内置的视图驱动类

----------

### 类摘要

```php
namespace ginkgo;
use ginkgo\view\Driver;

class Php extends Driver {
  // 继承的属性
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
  public fetch( [ mixed $tpl [, mixed $data ] ) : mixed
  public display( string $content [, mixed $data ] ) : mixed

  // 继承的方法
  public static instance( [ array $config ] ) : object
  public config( array $config )
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
| 继承的属性 | - | - | - |
| [`$config`](view_driver.md#$config) | public | array | 配置 |
| `$instance` | protected | object static | 本类实例 |
| [`$obj_request`](../request/index.md) | protected | object | 配置 |
| `$obj` | protected | array | 对象 |
| `$route` | protected | array | 路由 |
| `$param` | protected | array | 路由参数 |
| `$pathTpl` | protected | array | 模板路径 |
| [`$configThis`](view_driver.md#$config) | protected | array | 默认配置 |
| 方法 | - | - | - |
| [fetch()](#fetch()) | public | | 渲染模板 |
| [display()](#display()) | public | | 渲染字符内容 |
| 继承的方法 | - | - | - |
| [instance()](view_driver.md#instance()) | public | static | 实例化 |
| [config()](view_driver.md#config()) | public | | 配置 |
| [has()](view_driver.md#has()) | public | | 验证模板文件是否存在 |
| [setPath()](view_driver.md#setPath()) | public | | 设置模板路径 |
| [setObj()](view_driver.md#setObj()) | public | | 设置对象映射 |
| [getPath()](view_driver.md#getPath()) | public | | 获取模板路径 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [pathProcess()](view_driver.md#pathProcess()) | public | | 路径处理 |

----------

<span id="fetch()"></span>

#### `fetch()` 渲染模板

``` php
public function fetch( [ mixed $tpl [, mixed $data ] ) : mixed
```

参数

* [`tpl`](view_driver.md#tpl) 模板
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
