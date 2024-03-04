## ginkgo\Request

请求处理

----------

### 类摘要

```php
namespace ginkgo;

class Request {
  // 属性
  public $route = array(
    'mod'   => 'index',
    'ctrl'  => 'index',
    'act'   => 'index',
  );

  public $routeOrig = array(
    'mod'   => 'index',
    'ctrl'  => 'index',
    'act'   => 'index',
  );

  public $param = array();

  public $mimeType = array(
    'json'  => array(
      'application/json',
      'text/x-json',
      'application/jsonrequest',
      'text/json',
    ),
    'html'  => array(
      'text/html',
      'application/xhtml+xml',
      '*/*',
    ),
    'xml'   => array(
      'application/xml',
      'text/xml',
      'application/x-xml',
    ),
    'js'    => array(
      'text/javascript',
      'application/javascript',
      'application/x-javascript',
    ),
    'css'   => array(
      'text/css',
    ),
    'rss'   => array(
      'application/rss+xml',
    ),
    'yaml'  => array(
      'application/x-yaml',
      'text/yaml',
    ),
    'atom'  => array(
      'application/atom+xml',
    ),
    'pdf'   => array(
      'application/pdf',
    ),
    'text'  => array(
      'text/plain',
    ),
    'image' => array(
      'image/png',
      'image/jpg',
      'image/jpeg',
      'image/pjpeg',
      'image/gif',
      'image/webp',
      'image/*',
    ),
    'csv'   => array(
      'text/csv',
    ),
  );

  protected static $instance;

  // 方法
  public static instance() : object
  public setRoute( string $name [, string $value ] )
  public setRouteOrig( string $name [, string $value ] )
  public setParam( string $name [, string $value ] )
  public route( [ mixed $name = false ] ) : mixed
  public routeOrig( [ mixed $name = false ] ) : mixed
  public param( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false ]]]] ) : mixed
  public get( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false ]]]] ) : mixed
  public post( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false ]]]] ) : mixed
  public request( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false ]]]] ) : mixed
  public server( [ string $name ] ) : mixed
  public session( [ string $name ] ) : mixed
  public cookie( [ string $name ] ) : mixed
  public accept() : string
  public type() : string
  public mimeType( mixed $type [, mixed $value ] )
  public ip() : string
  public method() : string
  public isGet() : bool
  public isPost() : bool
  public isAjax() : bool
  public isPjax() : bool
  public isSsl() : bool
  public isMobile() : bool
  public root( [ bool $with_domain = false ] ) : string
  public url( [ bool $with_domain = false ] ) : string
  public domain() : string
  public host( [ bool $strict = false ] ) : string
  public scheme() : string
  public header( [ string $name [, string $separator = '-' ]] ) : mixed
  public token() : array
  public checkDuplicate( [ string $method = 'POST' ] ) : bool
  public setDuplicate( [ string $method = 'POST' ] )
  public baseFile() : string
  public baseUrl( [ bool $with_domain = false [, string $route_type ]] ) : string
  public fillParam( array $data, array $param ) : array
  public pagination( int $count [, int $perpage = 0 [, mixed $current = 'get' [, string $pageparam = 'page' [, int $pergroup = 0 ]]]] ) : array
  public input( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false ]]]] ) : mixed

  protected __construct()
  protected __clone()

  private duplicateProcess( [ string $method = 'POST' ] ) : string
  private varProcessR( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false [, array $var = array() ]]]]] ) : mixed
  private varProcessS( [ mixed $name = true [, array $var = array() ]] ) : mixed
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$route`](#$route) | public | string | 路由 |
| [`$routeOrig`](#$route) | public | string | 原始路由 |
| `$param` | public | array | 参数 |
| [`$mimeType`](#$mimeType) | public | array | 常用 MIME 类型 |
| `$instance` | protected | object static | 本类实例 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [setRoute()](#setRoute()) | public | | 设置路由 |
| [setRouteOrig()](#setRouteOrig()) | public | | 设置原始路由 |
| [setParam()](#setParam()) | public | | 设置参数 |
| [route()](#route()) | public | | 取得路由 |
| [routeOrig()](#routeOrig()) | public | | 取得原始路由 |
| [param()](#param()) | public | | 取得路由参数 |
| [get()](#get()) | public | | get 方法取得变量 |
| [post()](#post()) | public | | post 方法取得变量 |
| [request()](#request()) | public | | request 方法取得变量 |
| [server()](#server()) | public | | 取得服务器变量 |
| [session()](#session()) | public | | 取得会话变量 |
| [cookie()](#cookie()) | public | | 取得 Cookie |
| [accept()](#accept()) | public | | 取得请求类型 |
| [type()](#type()) | public | | 取得输出类型 |
| [mimeType()](#mimeType()) | public | | 设置 [`$mimeType`](#$mimeType) |
| [ip()](#ip()) | public | | 取得 IP 地址 |
| [method()](#method()) | public | | 取得请求方法 |
| [isGet()](#isGet()) | public | | 是否 get 请求 |
| [isPost()](#isPost()) | public | | 是否 post 请求 |
| [isAjax()](#isAjax()) | public | | 是否 ajax 请求 |
| [isPjax()](#isPjax()) | public | | 是否 pjax 请求 |
| [isSsl()](#isSsl()) | public | | 是否 ssl 请求 |
| [isMobile()](#isMobile()) | public | | 客户端是否移动设备 |
| [root()](#root()) | public | | 当前请求的根路径 |
| [url()](#url()) | public | | 当前请求的 URL |
| [domain()](#domain()) | public | | 当前请求的域名（带协议） |
| [host()](#host()) | public | | 当前请求的主机名 |
| [scheme()](#scheme()) | public | | 当前请求的协议 |
| [header()](#header()) | public | | 当前请求头信息 |
| [token()](#token()) | public | | 取得表单令牌 |
| [checkDuplicate()](#checkDuplicate()) | public | | 验证是否重复提交 |
| [setDuplicate()](#setDuplicate()) | public | | 设置重复提交 |
| [baseFile()](#baseFile()) | public | | 取得入口文件 |
| [baseUrl()](#baseUrl()) | public | | 取得入口文件的 URL |
| [fillParam()](#fillParam()) | public | | 填充参数 |
| [pagination()](#pagination()) | public | | 取得分页参数 |
| [input()](#input()) | public | | 处理输入参数 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [duplicateProcess()](#input()) | private | | 重复提交处理 |
| [varProcessR()](#varProcessR()) | private | | 变量处理 |
| [varProcessS()](#varProcessR()) | private | | 变量处理 |

----------

<span id="$route"></span>

#### `$route` 路由、`$routeOrig` 原始路由

``` php
public $route;
public $routeOrig;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| mod | string | | 模块 |
| ctrl | string | | 控制器 |
| act | string | | 动作 |

----------

<span id="$mimeType"></span>

#### `$mimeType` 常用 MIME 类型

``` php
public $mimeType = array(
  'json'  => array(
    'application/json',
    'text/x-json',
    'application/jsonrequest',
    'text/json',
  ),
  'html'  => array(
    'text/html',
    'application/xhtml+xml',
    '*/*',
  ),
  'xml'   => array(
    'application/xml',
    'text/xml',
    'application/x-xml',
  ),
  'js'    => array(
    'text/javascript',
    'application/javascript',
    'application/x-javascript',
  ),
  'css'   => array(
    'text/css',
  ),
  'rss'   => array(
    'application/rss+xml',
  ),
  'yaml'  => array(
    'application/x-yaml',
    'text/yaml',
  ),
  'atom'  => array(
    'application/atom+xml',
  ),
  'pdf'   => array(
    'application/pdf',
  ),
  'text'  => array(
    'text/plain',
  ),
  'image' => array(
    'image/png',
    'image/jpg',
    'image/jpeg',
    'image/pjpeg',
    'image/gif',
    'image/webp',
    'image/*',
  ),
  'csv'   => array(
    'text/csv',
  ),
);
```

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

<span id="setRoute()"></span>

#### `setRoute()` 设置路由 [`$route`](#$route)

``` php
public function setRoute( string $name [, string $value ] )
```

参数

* `name` 路由名称

  支持两种类型：字符串、数组，为数组时表示批量设置

* `value` 路由值

  当 `name` 为字符串时为必须，当 `name` 为数组时自动忽略。

返回

* 无

----------

<span id="setRouteOrig()"></span>

#### `setRouteOrig()` 设置原始路由 [`$routeOrig`](#$route)

``` php
public function setRouteOrig( string $name [, string $value ] )
```

参数

* `name` 路由名称

  支持两种类型：字符串、数组，为数组时表示批量设置

* `value` 路由值

  当 `name` 为字符串时为必须，当 `name` 为数组时自动忽略。

返回

* 无

----------

<span id="setParam()"></span>

#### `setParam()` 设置参数

``` php
public function setParam( string $name [, string $value ] )
```

参数

* `name` 路由名称

  支持两种类型：字符串、数组，为数组时表示批量设置

* `value` 路由值

  当 `name` 为字符串时为必须，当 `name` 为数组时自动忽略。

返回

* 无

----------

<span id="route()"></span>

#### `route()` 取得路由 [`$route`](#$route)

``` php
public function route( [ mixed $name = false ] ) : mixed
```

参数

* `name` 路由名称

返回

* 路由

----------

<span id="routeOrig()"></span>

#### `routeOrig()` 取得原始路由 [`$routeOrig`](#$route)

``` php
public function routeOrig( [ mixed $name = false ] ) : mixed
```

参数

* `name` 路由名称

返回

* 路由

----------

<span id="param()"></span>

#### `param()` 取得路由参数

``` php
public function param( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false ]]]] ) : mixed
```

参数

* `name` 参数名称
* `type` 类型
* `default` 默认值
* `htmlmode` 是否 html 模式

返回

* 路由参数

----------

<span id="get()"></span>

#### `get()` get 方法取得变量

``` php
public function get( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false ]]]] ) : mixed
```

参数

* `name` 名称
* `type` 类型
* `default` 默认值
* `htmlmode` 是否 html 模式

返回

* get 变量

----------

<span id="post()"></span>

#### `post()` post 方法取得变量

``` php
public function post( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false ]]]] ) : mixed
```

参数

* `name` 名称
* `type` 类型
* `default` 默认值
* `htmlmode` 是否 html 模式

返回

* post 变量

----------

<span id="request()"></span>

#### `request()` request 方法取得变量

``` php
public function request( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false ]]]] ) : mixed
```

参数

* `name` 名称
* `type` 类型
* `default` 默认值
* `htmlmode` 是否 html 模式

返回

* request 变量

----------

<span id="server()"></span>

#### `server()` 取得服务器变量

``` php
public function server( [ string $name ] ) : mixed
```

参数

* `name` 名称

返回

* 服务器变量

----------

<span id="session()"></span>

#### `session()` 取得会话变量

``` php
public function session( [ string $name ] ) : mixed
```

参数

* `name` 名称

返回

* 会话变量

----------

<span id="cookie()"></span>

#### `cookie()` 取得 Cookie

``` php
public function cookie( [ string $name ] ) : mixed
```

参数

* `name` 名称

返回

* Cookie

----------

<span id="accept()"></span>

#### `accept()` 取得请求类型

``` php
public function accept() : string
```

参数

* 无

返回

* MIME 类型

----------

<span id="type()"></span>

#### `type()` 取得输出类型

``` php
public function type() : string
```

参数

* `rule` 生成文件名规则（函数名）

返回

* 输出类型

----------

<span id="mimeType()"></span>

#### `mimeType()` 设置 [`$mimeType`](#$mimeType)

``` php
public function mimeType( mixed $type [, mixed $value ] )
```

参数

* `path` 图片路径

返回

* 无

----------

<span id="ip()"></span>

#### `ip()` 取得 IP 地址

``` php
public function ip() : string
```

参数

* 无

返回

* IP 地址

----------

<span id="method()"></span>

#### `method()` 取得请求方法

``` php
public function method() : string
```

参数

* 无

返回

* 请求方法

----------

<span id="isGet()"></span>

#### `isGet()` 是否 get 请求

``` php
public function isGet() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="isPost()"></span>

#### `isPost()` 是否 post 请求

``` php
public function isPost() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="isAjax()"></span>

#### `isAjax()` 是否 ajax 请求

``` php
public function isAjax() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="isPjax()"></span>

#### `isPjax()` 是否 pjax 请求

``` php
public function isPjax() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="isSsl()"></span>

#### `isSsl()` 是否 ssl 请求

``` php
public function isSsl() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="isMobile()"></span>

#### `isMobile()` 客户端是否移动设备

``` php
public function isMobile() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="root()"></span>

#### `root()` 当前请求的根路径

``` php
public function root( [ bool $with_domain = false ] ) : string
```

参数

* `with_domain` 是否带域名

返回

* 根路径

----------

<span id="url()"></span>

#### `url()` 当前请求的 URL

``` php
public function url( [ bool $with_domain = false ] ) : string
```

参数

* `with_domain` 是否带域名

返回

* URL

----------

<span id="domain()"></span>

#### `domain()` 当前请求的域名（带协议）

``` php
public function domain() : string
```

参数

* 无

返回

* 域名（带协议）

----------

<span id="host()"></span>

#### `host()` 当前请求的主机名

``` php
public function host( [ bool $strict = false ] ) : string
```

参数

* `strict` 严格模式

返回

* 主机名

----------

<span id="scheme()"></span>

#### `scheme()` 当前请求的协议

``` php
public function scheme() : string
```

参数

* 无

返回

* 协议

----------

<span id="header()"></span>

#### `header()` 当前请求头信息

``` php
public function header( [ string $name [, string $separator = '-' ]] ) : mixed
```

参数

* `name` 名称
* `separator` 分隔符

返回

* 请求头信息

----------

<span id="token()"></span>

#### `token()` 取得表单令牌

``` php
public function token() : array
```

参数

* 无

返回

* 表单令牌数组

``` php
array(
  'name'   => '__token__', // 表单名称
  'value'  => 'fwegweerIUreljiErl', // 令牌值
);
```

----------

<span id="checkDuplicate()"></span>

#### `checkDuplicate()` 验证是否重复提交

``` php
public function checkDuplicate( [ string $method = 'POST' ] ) : bool
```

参数

* `method` 方法

返回

* 布尔值

----------

<span id="setDuplicate()"></span>

#### `setDuplicate` 设置重复提交

``` php
public function setDuplicate( [ string $method = 'POST' ] )
```

参数

* `method` 方法

返回

* 无

----------

<span id="baseFile()"></span>

#### `baseFile` 取得入口文件

``` php
public function baseFile() : string
```

参数

* 无

返回

* 入口文件

----------

<span id="baseUrl()"></span>

#### `baseUrl` 取得入口文件的 URL

``` php
public function baseUrl( [ bool $with_domain = false [, string $route_type ]] ) : string
```

参数

* `with_domain` 是否带域名
* `route_type` 路由类型

返回

* 入口文件的 URL

----------

<span id="fillParam()"></span>

#### `fillParam` 填充参数

根据 `param` 规定的结构，将 `data` 数据填充完整

``` php
public function fillParam( array $data, array $param ) : array
```

参数

* `data` 数据
* `param` 结构参数

返回

* 填充完毕以后的数据

----------

<span id="pagination()"></span>

#### `pagination` 取得分页参数

``` php
public function pagination( int $count [, int $perpage = 0 [, mixed $current = 'get' [, string $pageparam = 'page' [, int $pergroup = 0 ]]]] ) : array
```

参数

* `count` 总记录数
* `perpage` 每页记录数
* `current` 当前页码，为空时获取当前页码

  混合型，默认为 get

  可能的值

  | 值 | 描述 |
  | - | - |
  | get | 用 get 方法获取页码 |
  | post | 用 post 方法获取页码 |
  | 整数 | 当前页码 |

* `pageparam` 分页参数
* `pergroup` 每组页数

返回

* 分页参数

----------

<span id="input()"></span>

#### `input` 处理输入参数

``` php
public function input( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false ]]]] ) : mixed
```

参数

* `name` 名称
* `type` 类型
* `default` 默认值
* `htmlmode` 是否 html 模式

返回

* 参数

----------

<span id="duplicateProcess()"></span>

#### `duplicateProcess` 重复提交处理

``` php
private function duplicateProcess( [ string $method = 'POST' ] ) : string
```

参数

* `method` 方法

返回

* 随机返回字体文件路径

----------

<span id="varProcessR()"></span>

#### `varProcessR` 变量处理

``` php
private function varProcessR( [ mixed $name = true [, string $type = 'str' [, mixed $default [, bool $htmlmode = false [, array $var = array() ]]]]] ) : mixed
```

参数

* `name` 名称
* `type` 类型
* `default` 默认值
* `htmlmode` 是否 html 模式
* `var` 待处理值

返回

* 变量

----------

<span id="varProcessS()"></span>

#### `varProcessS` 变量处理

``` php
private function varProcessS( [ mixed $name = true [, array $var = array() ]] ) : mixed
```

参数

* `name` 名称
* `var` 待处理值

返回

* 变量
