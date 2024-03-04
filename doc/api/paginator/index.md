## ginkgo\Paginator

分页处理器

----------

### 类摘要

```php
namespace ginkgo;

class Paginator {
  // 属性
  public $config = array();
  public $current;
  public $count;
  public $totalRow;

  protected static $instance;

  private $configThis = array(
    'perpage'      => 10,
    'pergroup'     => 10,
    'pageparam'    => 'page',
  );

  // 方法
  public static instance( [ array $config ] ) : object
  public config( array $config )
  public make( [ mixed $current = 'get' ] ) : array
  public current( [ mixed $current = 'get' ] )
  public count( [ int $count ] ) : int
  public perpage( [ int $perpage ] ) : int
  public pergroup( [ int $pergroup ] ) : int
  public pageparam( [ string $pageparam ] ) : string

  protected __construct( [ array $config ] ) : object
  protected __clone()

  private totalProcess() : array
  private groupProcess() : array
  private offsetProcess() : int
  private stepProcess() : array
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array | 配置 |
| `$current` | public | int | 当前页码 |
| `$count` | public | int | 总记录数 |
| `$totalRow` | public | array | 分页统计 |
| `$instance` | protected | object static | 本类实例 |
| [`$configThis`](#$config) | private | array | 默认配置 |
| 方法 | - | - | - |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [instance()](#instance()) | public | static | 实例化 |
| [config()](#config()) | public | | 配置 |
| [make()](#make()) | public | | 生成分页参数 |
| [current()](#current()) | public | | 设置、获取当前页码 |
| [count()](#current()) | public | | 设置、获取总记录数 |
| [perpage()](#perpage()) | public | | 设置、获取每页记录数 |
| [pergroup()](#pergroup()) | public | | 设置、获取每组页数 |
| [pageparam()](#pageparam()) | public | | 设置、获取分页参数 |
| [totalProcess()](#totalProcess()) | private | | 总页数处理 |
| [groupProcess()](#groupProcess()) | private | | 分组处理 |
| [offsetProcess()](#offsetProcess()) | private | | 偏移处理 |
| [stepProcess()](#stepProcess()) | private | | 步进处理 |

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
| perpage | int | 10 | 每页记录数 |
| pergroup | int | 10 | 每组页数 |
| pageparam | string | page | 分页参数 |

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

<span id="make()"></span>

#### `make()` 生成分页参数

``` php
public function make( [ mixed $current = 'get' ] ) : array
```

参数

* [`current`](#current()) 当前页码：

返回

* 分页参数

----------

<span id="current()"></span>

#### `current()` 设置、获取当前页码

``` php
public function current( [ mixed $current ] ) : int
```

参数

* `current` 当前页码，为空时获取当前页码

  混合型，默认为 get

  可能的值

  | 值 | 描述 |
  | - | - |
  | get | 用 get 方法获取页码 |
  | post | 用 post 方法获取页码 |
  | 整数 | 当前页码 |

返回

* 当前页码

----------

<span id="count()"></span>

#### `count()` 设置、获取总记录数

``` php
public function count( [ int $count ] ) : int
```

参数

* `count` 总记录数，为空时获取总记录数

返回

* 总记录数

----------

<span id="perpage()"></span>

#### `perpage()` 设置、获取每页记录数

``` php
public function perpage( [ int $perpage ] ) : int
```

参数

* `perpage` 每页记录数，为空时获取每页记录数

返回

* 每页记录数

----------

<span id="pergroup()"></span>

#### `pergroup()` 设置、获取每组页数

``` php
public function pergroup( [ int $pergroup ] ) : int
```

参数

* `pergroup` 每组页数，为空时获取每组页数

返回

* 每组页数

----------

<span id="pageparam()"></span>

#### `pageparam()` 设置、获取分页参数

``` php
public function pageparam( [ string $pageparam ] ) : string
```

参数

* `pageparam` 分页参数，为空时获取分页参数

返回

* 分页参数

----------

<span id="totalProcess()"></span>

#### `totalProcess()` 总页数处理

``` php
private function totalProcess() : array
```

参数

* 无

返回

* 总页数参数

----------

<span id="groupProcess()"></span>

#### `groupProcess()` 分组处理

``` php
private function groupProcess() : array
```

参数

* 无

返回

* 分组参数

----------

<span id="offsetProcess()"></span>

#### `offsetProcess()` 偏移处理

``` php
private function offsetProcess() : int
```

参数

* 无

返回

* 偏移数

----------

<span id="stepProcess()"></span>

#### `stepProcess()` 步进处理

``` php
private function stepProcess() : array
```

参数

* 无

返回

* 步进参数
