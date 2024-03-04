## ginkgo\Ctrl

控制器抽象类，无法直接实例化

----------

### 类摘要

```php
namespace ginkgo;

abstract class Ctrl {
  // 属性
  protected $obj_request;
  protected $obj_lang;
  protected $obj_view;
  protected $route;
  protected $routeOrig;
  protected $param;

  // 方法
  public __construct( [ array $param ] )

  protected c_init( [ array $param ] )
  protected assign( mixed $assign [, mixed $value ] )
  protected fetch( [ string $tpl [, mixed $assign [, mixed $value [, int $code = 200 ]]]] ) : object
  protected display( [ string $content [, mixed $assign  [, mixed $value [, int $code = 200 ]]]] ) : object
  protected redirect( string $url ) : object
  protected json( [ array $content [, int $code = 200 ]] ) : object
  protected jsonp( [ array $content [, int $code = 200 ]] ) : object
  protected reset()
  protected setObj( string $name, object &$obj )
  protected validate( mixed $data [, mixed $validate [, string $scene [, array $only [, array $remove [, array $append ]]]]] ) : mixed
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$obj_request`](../request/index.md) | protected | object | 请求实例 |
| [`$obj_lang`](../lang/index.md) | protected | object | 语言实例 |
| [`$obj_view`](../view/index.md) | protected | object | 视图实例 |
| [`$route`](#$route) | protected | array | 路由 |
| [`$routeOrig`](#$route) | protected | array | 原始路由 |
| `$param` | protected | array | 路由参数 |
| 方法 | - | - | - |
| [__construct()](#__construct()) | public | | 构造函数 |
| [c_init()](#c_init()) | protected | | 控制器初始化 |
| [assign()](#assign()) | protected | | 向视图赋值 |
| [fetch()](#fetch()) | protected | | 渲染模板输出 |
| [display()](#display()) | protected | | 显示模板输出 |
| [redirect()](#redirect()) | protected | | 重定向输出 |
| [json()](#json()) | protected | | JSON 输出 |
| [jsonp()](#jsonp()) | protected | | JSONP 输出 |
| [driver()](#driver()) | protected | | 初始化视图驱动 |
| [reset()](#reset()) | protected | | 清空变量 |
| [setObj()](#setObj()) | protected | | 向模板映射对象 |
| [validate()](#validate()) | protected | | 验证 |

----------

<span id="$route"></span>

#### `$route` 路由，`$routeOrig` 原始路由

``` php
protected $route;
protected $routeOrig;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| mod | string | index | 模块 |
| ctrl | string | index | 控制器 |
| act | string | index | 动作 |

----------

<span id="__construct()"></span>

#### `__construct()` 构造函数

``` php
protected function __construct( [ array $param ] ) : object
```

参数

* `param` 参数，由 [`ginkgo\App`](../app/index.md#run()) 类 `run()` 方法自动传人

返回

* 本类实例

----------

<span id="c_init()"></span>

#### `c_init()` 控制器初始化

``` php
protected function c_init( [ array $param ] )
```

参数

* `param` 参数，由 [`ginkgo\App`](../app/index.md#run()) 类 `run()` 方法自动传人

返回

* 无

----------

<span id="assign()"></span>

#### `assign()` 向视图赋值

``` php
protected function assign( mixed $assign [, mixed $value ] )
```

参数

* `assign` 变量名或值

  支持两种类型：为字符串时表示变量名，为数组时表示批量传输

* `value` 变量值

  当 `assign` 为字符串时为必须，当 `assign` 为数组时自动忽略。

返回

* 无

----------

<span id="fetch()"></span>

#### `fetch()` 渲染模板输出

``` php
protected function fetch( [ string $tpl [, mixed $assign [, mixed $value [, int $code = 200 ]]]] ) : object
```

参数

* `tpl` 模板

  支持如下几种写法：

  | 用法 | 描述 | 规则 |
  | - | - | - |
  | 不带任何参数 | 自动定位 | app/tpl/`当前模块/当前控制器/当前动作`.tpl.php |
  | 动作 | 常用写法 | app/tpl/当前模块/当前控制器/`动作`.tpl.php |
  | 控制器/动作 | 常用写法 | app/tpl/当前模块/`控制器/动作`.tpl.php |
  | 完整的模板路径 | 必须包含模板后缀 | 模板后缀必须与配置一致，详情请查看 [配置 -> 常量配置](../../index/config/const) |

* `assign` 变量名或值

  支持两种类型：为字符串时表示变量名，为数组时表示批量传输

* `value` 变量值

  当 `assign` 为字符串时为必须，当 `assign` 为数组时自动忽略。

* `code` HTTP 状态码

返回

* [ginkgo\Response](../response/index.md) 实例

----------

<span id="display()"></span>

#### `display()` 显示模板输出

``` php
protected function display( [ string $content [, mixed $assign  [, mixed $value [, int $code = 200 ]]]] ) : object
```

参数

* `content` 模板内容（非模板文件）
* `assign` 变量名或值

  支持两种类型：为字符串时表示变量名，为数组时表示批量传输

* `value` 变量值

  当 `assign` 为字符串时为必须，当 `assign` 为数组时自动忽略。

* `code` HTTP 状态码

返回

* [ginkgo\Response](../response/index.md) 实例

----------

<span id="redirect()"></span>

#### `redirect()` 重定向输出

``` php
protected function redirect( string $url ) : object
```

参数

* `url` 重定向 URL

返回

* [ginkgo\Response](../response/index.md) 实例

----------

<span id="json()"></span>

#### `json()` JSON 输出

``` php
protected function json( [ array $content [, int $code = 200 ]] ) : object
```

参数

* `content` 准备输出的内容
* `code` HTTP 状态码

返回

* [ginkgo\Response](../response/index.md) 实例

----------

<span id="jsonp()"></span>

#### `jsonp()` JSONP 输出

``` php
protected function jsonp( [ array $content [, int $code = 200 ]] ) : object
```

参数

* `content` 准备输出的内容
* `code` HTTP 状态码

返回

* [ginkgo\Response](../response/index.md) 实例

----------

<span id="driver()"></span>

#### `driver()` 初始化视图驱动

``` php
protected function driver( string $driver ) : object
```

参数

* `driver` 驱动

返回

* [app\View](../view/index.md) 实例

----------

<span id="reset()"></span>

#### `reset()` 清空变量

``` php
protected function reset()
```

参数

* 无

返回

* 无

----------

<span id="setObj()"></span>

#### `setObj()` 向模板映射对象

``` php
protected function setObj( string $name, object &$obj )
```

参数

* `name` 对象名称
* `obj` 对象映射

返回

* 无

----------

<span id="validate()"></span>

#### `validate()` 验证

``` php
protected function validate( mixed $data [, mixed $validate [, string $scene [, array $only [, array $remove [, array $append ]]]]] ) : mixed
```

参数

* `data` 待验证数据
* `validate` 验证器名称

  支持两种类型：为字符串时表示验证器名称，为数组时表示验证规则，为空时自动查找验证器

* `scene` 验证场景
* `only` 仅验证指定规则
* `remove` 移除指定规则
* `append` 追加验证规则

返回

* 验证结果
