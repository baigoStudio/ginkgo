## ginkgo\response\Jsonp

JSONP 响应

----------

### 类摘要

```php
namespace ginkgo\response;
use ginkgo\Response;

class Jsonp extends Response {
  // 常量
  const CALLBACK_PARAM = 'callback';
  const CALLBACK       = 'callback';

  // 属性
  public $header   = array(
    'Content-Type'  => 'application/javascript; Charset=UTF-8',
  );

  // 继承的属性
  public $config = array();
  public $statusCode;
  public $replace  = array();

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
  protected output( mixed $data ] ) : mixed

  // 继承的方法
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

  protected replaceProcess( mixed $content ) : mixed
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 常量 | - | - | - |
| `CALLBACK_PARAM` | | string | JSONP 回调函数 |
| `CALLBACK` | | string | JSONP 请求参数 |
| 继承的属性 | - | - | - |
| [`$config`](../response/index.md#$config) | public | array | 配置 |
| `$statusCode` | public | int | 状态码 |
| `$replace` | public | array | 替换数据 |
| `$header` | public | array | 响应头信息 |
| `$data` | protected | mixed | 响应内容 |
| [`$configThis`](../response/index.md#$config) | protected | array | 默认配置 |
| `$statusRow` | protected | array | 默认状态码说明 |
| 方法 | - | - | - |
| [output()](#output()) | protected | | 输出并注入调试信息 |
| 继承的方法 | - | - | - |
| [create()](../response/index.md#create()) | public | static | 创建响应 |
| [config()](../response/index.md#config()) | public | | 配置 |
| [setStatusCode()](../response/index.md#setStatusCode()) | public | | 设置状态码 |
| [setHeader()](../response/index.md#setHeader()) | public | | 设置响应头 |
| [setContent()](../response/index.md#setContent()) | public | | 设置响应内容 |
| [setReplace()](../response/index.md#setReplace()) | public | | 设置替换数据 |
| [getStatusCode()](../response/index.md#getStatusCode()) | public | | 获取状态码 |
| [getStatus()](../response/index.md#getStatus()) | public | | 获取状态码信息 |
| [getHeader()](../response/index.md#getHeader()) | public | | 获取头 |
| [getContent()](../response/index.md#getContent()) | public | | 获取响应内容 |
| [expires()](../response/index.md#expires()) | public | | 设置过期时间 |
| [cacheControl()](../response/index.md#cacheControl()) | public | | 设置缓存控制 |
| [contentType()](../response/index.md#contentType()) | public | | 设置响应 MIME 类型 |
| [send()](../response/index.md#send()) | public | | 发送响应内容 |
| __construct() | protected | | 同 [create()](#create()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [replaceProcess()](../response/index.md#replaceProcess()) | protected | | 输出替换处理 |

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
