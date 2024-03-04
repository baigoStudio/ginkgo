## ginkgo\Response

响应

----------

### 类摘要

```php
namespace ginkgo;

class Response {
  // 属性
  public $config = array();
  public $statusCode;
  public $replace  = array();

  public $header   = array(
    'Content-Type'  => 'text/html; Charset=UTF-8',
  );

  protected $data;

  protected $statusRow = array(
    100 => 'Continue',
    101 => 'Switching Protocols',

    200 => 'OK',
    201 => 'Created',
    202 => 'Accepted',
    203 => 'Non-Authoritative Information',
    204 => 'No Content',
    205 => 'Reset Content',
    206 => 'Partial Content',

    300 => 'Multiple Choices',
    301 => 'Moved Permanently',
    302 => 'Found',
    303 => 'See Other',
    304 => 'Not Modified',
    305 => 'Use Proxy',
    307 => 'Temporary Redirect',

    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Time-out',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Request Entity Too Large',
    414 => 'Request-URI Too Large',
    415 => 'Unsupported Media Type',
    416 => 'Requested range not satisfiable',
    417 => 'Expectation Failed',

    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Time-out',
    505 => 'HTTP Version not supported',
  );

  protected $configThis = array(
    'charset'              => 'UTF-8',
    'jsonp_callback'       => '',
    'jsonp_callback_param' => '',
  );

  // 方法
  public static create( mixed $data [, string $type [, int $statusCode = 200 [, array $header ]]] ) : object
  public config( array $config )
  public setStatusCode( [ int $statusCode = 200 ] )
  public setHeader( mixed $header [, string $value ] )
  public setContent( mixed $data )
  public setReplace( mixed $replace [, string $value ] )
  public getStatusCode() : int
  public getStatus() : string
  public getHeader( [ string $header ] ) : mixed
  public getContent() : mixed
  public expires( string $time )
  public cacheControl( string $cacheControl )
  public contentType( string $contentType [, string $charset ] )
  public send( [ mixed $id = 0 ] )

  protected __construct( mixed $data [, int $statusCode = 200 [, array $header ]] )
  protected __clone()

  protected output( mixed $data ] ) : mixed
  protected replaceProcess( mixed $content ) : mixed
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array | 配置 |
| `$statusCode` | public | int | 状态码 |
| `$replace` | public | array | 替换数据 |
| `$header` | public | array | 响应头信息 |
| `$data` | protected | mixed | 响应内容 |
| [`$configThis`](#$config) | protected | array | 默认配置 |
| `$statusRow` | protected | array | 默认状态码说明 |
| 方法 | - | - | - |
| [create()](#create()) | public | static | 创建响应 |
| [config()](#config()) | public | | 配置 |
| [setStatusCode()](#setStatusCode()) | public | | 设置状态码 |
| [setHeader()](#setHeader()) | public | | 设置响应头 |
| [setContent()](#setContent()) | public | | 设置响应内容 |
| [setReplace()](#setReplace()) | public | | 设置替换数据 |
| [getStatusCode()](#getStatusCode()) | public | | 获取状态码 |
| [getStatus()](#getStatus()) | public | | 获取状态码信息 |
| [getHeader()](#getHeader()) | public | | 获取头 |
| [getContent()](#getContent()) | public | | 获取响应内容 |
| [expires()](#expires()) | public | | 设置过期时间 |
| [cacheControl()](#cacheControl()) | public | | 设置缓存控制 |
| [contentType()](#contentType()) | public | | 设置响应 MIME 类型 |
| [send()](#send()) | public | | 发送响应内容 |
| __construct() | protected | | 同 [create()](#create()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [output()](#output()) | protected | | 输出并注入调试信息 |
| [replaceProcess()](#replaceProcess()) | protected | | 输出替换处理 |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

`0.2.0` 新增

``` php
public $config;
protected $configThis;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| charset | string | UTF-8 | 编码 |
| jsonp_callback | string | | JSONP 回调函数 |
| jsonp_callback_param | string | JSONP 请求参数 |

----------

<span id="create()"></span>

#### `create()` 实例化方法

``` php
public static function create( mixed $data [, string $type [, int $statusCode = 200 [, array $header ]]] ) : object
```

参数

* `data` 响应内容
* `type` 响应类型
* `statusCode` 状态码
* `header` 响应头信息

返回

* 本类的实例

----------

<span id="config()"></span>

#### `config()` 配置

`0.2.0` 新增

``` php
public function config( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="setStatusCode()"></span>

#### `setStatusCode()` 设置状态码

``` php
public function setStatusCode( [ int $statusCode = 200 ] )
```

参数

* `statusCode` 状态码

返回

* 无

----------

<span id="setHeader()"></span>

#### `setHeader()` 设置头

``` php
public function setHeader( mixed $header [, string $value ] )
```

参数

* `header` 响应头，字符串或数组

  为字符串时表示名称，为数组时表示批量设置

* `value` 值

  当 `header` 为字符串时为必须，当 `header` 为数组时自动忽略。

返回

* 无

----------

<span id="setContent()"></span>

#### `setContent()` 设置响应内容

``` php
public function setContent( mixed $data )
```

参数

* `data` 响应内容

返回

* 无

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

<span id="getStatusCode()"></span>

#### `getStatusCode()` 获取状态码

``` php
public function getStatusCode() : int
```

参数

* 无

返回

* 状态码

----------

<span id="getStatus()"></span>

#### `getStatus()` 获取状态码信息

``` php
public function getStatus() : string
```

参数

* 无

返回

* 状态码说明

----------

<span id="getHeader()"></span>

#### `getHeader()` 获取响应头

``` php
public function getHeader( [ string $header ] ) : mixed
```

参数

* `header` 响应头，为空时返回全部响应头

返回

* 响应头

----------

<span id="getContent()"></span>

#### `getContent()` 获取响应内容

``` php
public function getContent() : mixed
```

参数

* 无

返回

* 响应内容

----------

<span id="expires()"></span>

#### `expires()` 设置过期时间

``` php
public function expires( string $time )
```

参数

* `time` 过期时间

返回

* 无

----------

<span id="cacheControl()"></span>

#### `cacheControl()` 设置缓存控制

``` php
public function cacheControl( string $cacheControl )
```

参数

* `cacheControl` 缓存控制命令

返回

* 无

----------

<span id="contentType()"></span>

#### `contentType()` 设置响应 MIME 类型

``` php
public function contentType( string $contentType [, string $charset ] )
```

参数

* `contentType` 响应内容的类型
* `charset` 字符编码

返回

* 无

----------

<span id="send()"></span>

#### `send()` 发送响应内容

``` php
public function send( [ mixed $id = 0 ] )
```

参数

* `id` 一般用于调试，判断响应发送自何处

返回

* 无

----------

<span id="output()"></span>

#### `output()` 输出并注入调试信息

``` php
protected function output( mixed $data ] ) : mixed
```

参数

* `data` 响应内容

返回

* 处理以后的响应内容

----------

<span id="replaceProcess()"></span>

#### `replaceProcess()` 输出替换处理

``` php
protected function replaceProcess( mixed $content ) : mixed
```

参数

* `content` 输出内容

返回

* 处理以后的输出内容
