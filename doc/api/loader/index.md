## ginkgo\Loader

载入器

----------

### 类摘要

```php
namespace ginkgo;

class Loader {
  // 属性
  protected static $instance = array();

  // 方法
  public static load( string $path [, string $type = 'require' ] ) : mixed
  public static register()
  public static ctrl( string $class [, string $layer [, mixed $mod = true [, array $option ]]] ) : object
  public static model( string $class [, string $layer [, mixed $mod = true [, array $option ]]] ) : object
  public static validate( string $class [, string $layer [, mixed $mod = true [, array $option ]]] ) : object
  public static classes( string $class [, string $layer [, mixed $mod = true [, array $option ]]] ) : object
  public static clearInstance()

  private static getPath( string $path ) : string
  private static autoload( string $class_name ] ) : bool
  private static namespaceProcess( string $class [, string $layer [, mixed $mod = true [, string $type = 'classes' ]]] ) : string
  private static pathProcess( array $path ) : string
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$instance` | protected | array static | 用静态属性保存实例 |
| 方法 | - | - | - |
| [load()](#load()) | public | static | 载入文件 |
| [register()](#register()) | public | static | 注册自动加载 |
| [ctrl()](#ctrl()) | public | static | 加载控制器 |
| [model()](#model()) | public | static | 加载模型 |
| [validate()](#validate()) | public | static | 加载验证器 |
| [classes()](#classes()) | public | static | 加载类 |
| [clearInstance()](#clearInstance()) | public | static | 清除实例 |
| [getPath()](#getPath()) | private | static | 获取路径 |
| [autoload()](#autoload()) | private | static | 自动加载函数 |
| [namespaceProcess()](#namespaceProcess()) | private | static | 命名空间处理 |
| [pathProcess()](#pathProcess()) | private | static | 路径处理 |

----------

<span id="load()"></span>

#### `load()` 载入文件

``` php
public static function load( string $path [, string $type = 'require' ] ) : mixed
```

参数

* `path` 路径
* `type` 载入类型，可能的值为 include、include_once、require、require_once 代表 php 函数

返回

* 载入文件的内容

----------

<span id="register()"></span>

#### `register()` 注册自动加载

``` php
public static function register()
```

参数

* 无

返回

* 无

----------

<span id="ctrl()"></span>

#### `ctrl()` 加载控制器

``` php
public static function ctrl( string $class [, string $layer [, mixed $mod = true [, array $option ]]] ) : object
```

参数

* `class` 类名
* `layer` 分层
* `mod` 模块，如为字符串代表指定模块，如为 false 代表控制器根目录
* `option` 选项，会传递给控制器构造函数

返回

* 控制器实例

----------

<span id="model()"></span>

#### `model()` 加载模型

``` php
public static function model( string $class [, string $layer [, mixed $mod = true [, array $option ]]] ) : object
```

参数

* `class` 类名
* `layer` 分层
* `mod` 模块，如为字符串代表指定模块，如为 false 代表模型根目录
* `option` 选项，会传递给模型构造函数

返回

* 模型实例

----------

<span id="validate()"></span>

#### `validate()` 加载验证器

``` php
public static function validate( string $class [, string $layer [, mixed $mod = true [, array $option ]]] ) : object
```

参数

* `class` 类名
* `layer` 分层
* `mod` 模块，如为字符串代表指定模块，如为 false 代表验证器根目录
* `option` 选项，会传递给验证器构造函数

返回

* 验证器实例

----------

<span id="classes()"></span>

#### `classes()` 加载类

``` php
public static function classes( string $class [, string $layer [, mixed $mod = true [, array $option ]]] ) : object
```

参数

* `class` 类名
* `layer` 分层
* `mod` 模块，如为字符串代表指定模块，如为 false 代表类根目录
* `option` 选项，会传递给类构造函数

返回

* 类实例

----------

<span id="clearInstance()"></span>

#### `clearInstance()` 清除实例

``` php
public static function clearInstance()
```

参数

* 无

返回

* 无

----------

<span id="getPath()"></span>

#### `getPath()` 获取路径

``` php
private static function getPath( string $path ) : string
```

参数

* `path` 路径

返回

* 处理后的路径

----------

<span id="autoload()"></span>

#### `autoload()` 自动加载函数

``` php
private static function autoload( string $class_name ] ) : bool
```

参数

* `class_name` 类名

返回

* 布尔值

----------

<span id="namespaceProcess()"></span>

#### `namespaceProcess()` 命名空间处理

``` php
private static function namespaceProcess( string $class [, string $layer [, mixed $mod = true [, string $type = 'classes' ]]] ) : string
```

参数

* `class` 类名
* `layer` 分层
* `mod` 模块，如为字符串代表指定模块，如为 false 代表类根目录
* `type` 类型，可能的值为 ctrl、model、validate、classes

返回

* 命名空间

----------

<span id="pathProcess()"></span>

#### `pathProcess()` 路径处理

``` php
private static function pathProcess( array $path ) : string
```

参数

* `path` 路径数组

返回

* 处理后的路径
