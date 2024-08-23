## ginkgo\Http

HTTP 请求处理

----------

### 类摘要

```php
namespace ginkgo;

use ginkgo\common\File_Sys;

class Http extends File_Sys {
  // 属性
  public $config = array();
  public $caInfo;
  public $result;
  public $errno;
  public $statusCode;

  public $curlOpt = array();

  public $httpHeader = array(
    'Content-Type'  => 'application/x-www-form-urlencoded; charset=UTF-8',
    'Accept'        => 'application/json',
  );

  protected static $instance;

  private $configThis = array(
    'scheme'          => '',
    'charset'         => 'UTF-8',
    'port'            => '',
    'accept'          => 'application/json',
    'curlopt_header'  => false,
    'verify_peer'     => false,
    'verify_host'     => false,
    'return_transfer' => true,
    'timeout'         => 30,
  );

  private $res_curl;
  private $hostUrl;

  // 继承的属性
  public $mimeRows = array();
  public $error;
  public $rule = 'md5';

  public $fileInfo = array(
    'name'      => '',
    'tmp_name'  => '',
    'ext'       => '',
    'mime'      => '',
    'size'      => 0,
  );

  protected $obj_file;

  // 方法
  public static instance( [ array $config ] ) : object
  public config( array $config )
  public request( string $url [, array $data [, string $method = 'get' ]] ) : mixed
  public getRemote( string $url [, array $data [, string $method = 'get' ]] ) : array
  public move( string $dir [, $name = true [, $replace = true ]] ) : bool
  public setHeader( mixed $header [, string $value ] )
  public setAccept( string $type )
  public setOpt( mixed $opt [, string $value ] )
  public contentType( string $contentType [, string $charset ] )
  public port( [ int $port ] )
  public getResult() : mixed
  public getErrno() : int
  public getStatusCode() : int

  protected __construct( array $config ) : object
  protected __clone()

  private optProcess( array $opts )
  private urlProcess( string $url ) : bool
  private resultProcess( mixed $result ) : mixed
  private dataProcess( mixed $data ) : string
  private httpHeaderProcess() : array

  // 继承的方法
  public rule( string $rule )
  public getMime( string $path [, $mime = false ] ) : string
  public getExt( string $path [, $mime = false ] ) : string
  public getInfo( [ string $name ] ) : mixed
  public getError() : string
  public setMime( mixed $mime [, array $value ] )

  protected verifyFile( string $ext [, string $mime ] ) : bool
  protected genFilename( [ bool $name = true ] ) : string
  protected errRecord( string $msg ) // since 0.2.4
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array | 配置 |
| `$caInfo` | public | string | 证书路径 |
| `$result` | public | string | 返回结果 |
| `$errno` | public | int | 错误号 |
| `$statusCode` | public | string | 状态码 |
| `$httpHeader` | public | array | HTTP 头信息 |
| `$curlOpt` | public | array | [CURL 选项](https://www.php.net/manual/zh/function.curl-setopt.php) |
| `$instance` | protected | object static | 本类实例 |
| [`$configThis`](#$config) | private | array | 默认配置 |
| `$res_curl` | private | resource | CURL 连接资源 |
| `$hostUrl` | private | string | 主机 URL |
| 继承的属性 | - | - | `0.3.0` 迁移至 ginkgo\common\File_Sys |
| `$mimeRows` | public | array | MIME 池 |
| `$error` | public | string | 错误 |
| `$rule` | public | string | 生成文件名规则（函数名） |
| `$fileInfo` | public | array | 默认 $_FILES 结构 |
| [`$obj_file`](../file/index.md) | protected | object | 文件对象 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [config()](#config()) | public | | 配置 |
| [request()](#request()) | public | | 发起请求 |
| [getRemote()](#getRemote()) | public | | 发起远程请求并保存为临时文件 |
| [move()](#move()) | public | | 把远程请求到的临时文件移动到指定目录 |
| [setHeader()](#setHeader()) | public | | 设置 HTTP 头 |
| [setAccept()](#setAccept()) | public | | 设置请求返回的类型 |
| [setOpt()](#setOpt()) | public | | 设置 CURL 选项 |
| [contentType()](#contentType()) | public | | 设置请求内容的类型 |
| [port()](#port()) | public | | 设置端口 |
| [getResult()](#getResult()) | public | | 获取原始返回内容 |
| [getErrno()](#getErrno()) | public | | 获取错误号 |
| [getStatusCode()](#getStatusCode()) | public | | 获取状态码 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [optProcess()](#optProcess()) | private | | 选项处理，`0.2.0` 新增 |
| [urlProcess()](#urlProcess()) | private | | 主机 URL 处理，`0.2.0` 新增 |
| [resultProcess()](#resultProcess()) | private | | 结果处理 |
| [dataProcess()](#dataProcess()) | private | | 发送数据处理 |
| [httpHeaderProcess()](#httpHeaderProcess()) | private | | 头信息处理 |
| 继承的方法 | - | - | `0.3.0` 迁移至 ginkgo\common\File_Sys |
| [rule()](../common/common_file_sys.md#rule()) | public | | 设置 MIME |
| [getMime()](../common/common_file_sys.md#getMime()) | public | | 获取文件的 MIME 类型 |
| [getExt()](../common/common_file_sys.md#getExt()) | public | | 获取文件的扩展名 |
| [getInfo()](../common/common_file_sys.md#getInfo()) | public | | 获取文件信息 |
| [getError()](../common/common_file_sys.md#getError()) | public | | 获取错误 |
| [setMime()](../common/common_file_sys.md#setMime()) | public | | 设置生成文件名规则（函数名） |
| [genFilename()](../common/common_file_sys.md#genFilename()) | protected | | 生成文件名 |
| [verifyFile()](../common/common_file_sys.md#verifyFile()) | protected | | 验证是否为允许的文件 |
| [errRecord()](../common/common_file_sys.md#errRecord()) | protected | | 记录错误，`0.2.4` 新增 |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

`0.2.0` 新增

``` php
public $config;
private $configThis;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| scheme | string | | 协议 |
| charset | string | UTF-8 | 编码 |
| port | int | | 端口 |
| accept | string | application/json | 请求返回的类型 |
| curlopt_header | bool | false | 是否将头文件的信息作为数据流输出 |
| verify_peer | bool | false | 验证对等证书 |
| verify_host | bool | false | 验证主机 |
| return_transfer | bool | true | 是否转换返回 |
| timeout | int | 30 | 服务器超时 |

----------

<span id="instance()"></span>

#### `instance()` 实例化方法

``` php
public static function instance( [ array $config ] ) : object
```

参数

* [`config`](#$config) 配置参数

返回

* 本类的实例

----------

<span id="request()"></span>

#### `request()` 发起请求

``` php
public function request( string $url [, array $data [, string $method = 'get' ]] ) : mixed
```

参数

* `url` 请求 URL
* `data` 准备发送的数据，可以为数组或字符串
* `method` 请求方法，get、post 或 put

返回

* 请求结果

----------

<span id="getRemote()"></span>

#### `getRemote()` 发起远程请求并保存为临时文件

``` php
public function getRemote( string $url [, array $data [, string $method = 'get' ]] ) : array
```

参数

* `url` 请求 URL
* `data` 准备发送的数据，可以为数组或字符串
* `method` 请求方法，get 或 post

返回

* 临时文件信息

----------

<span id="move()"></span>

#### `move()` 把远程请求到的文件移动到指定目录

``` php
public function move( string $dir [, $name = true [, $replace = true ]] ) : bool
```

参数

* `dir` 指定目录
* `name` 文件名，true 为自动生成, false 为原始文件名, 字符串为指定文件名
* `replace` 是否覆盖

返回

* 布尔值

----------

<span id="setHeader()"></span>

#### `setHeader()` 设置 HTTP 头

``` php
public function setHeader( mixed $header [, string $value ] )
```

参数

* `header` HTTP 头，字符串或数组

  为字符串时表示名称，为数组时表示批量设置

* `value` 值 `0.2.0` 新增

  当 `header` 为字符串时为必须，当 `header` 为数组时自动忽略。

返回

* 无

----------

<span id="setAccept()"></span>

#### `setAccept()` 设置请求返回的类型

``` php
public function setAccept( string $type )
```

参数

* `type` 请求返回的类型

返回

* 无

----------

<span id="setOpt()"></span>

#### `setOpt()` 设置 CURL 选项

 `0.3.0` 新增

``` php
public function setOpt( mixed $opt [, string $value ] )
```

参数

* `opt` CURL 选项名或数组

  为数组时表示批量设置，选项名详见 [CURL 选项](https://www.php.net/manual/zh/function.curl-setopt.php)

* `value` 值

  当 `opt` 为字符串时为必须，当 `opt` 为数组时自动忽略。

返回

* 无

----------

<span id="contentType()"></span>

#### `contentType()` 设置请求内容的类型

``` php
public function contentType( string $contentType [, string $charset ] )
```

参数

* `contentType` 请求内容的类型
* `charset` 字符编码

返回

* 无

----------

<span id="port()"></span>

#### `port()` 设置端口

``` php
public function port( [ int $port ] )
```

参数

* `port` 端口

返回

* 无

----------

<span id="getResult()"></span>

#### `getResult()` 获取原始返回内容

``` php
public function getResult() : mixed
```

参数

* 无

返回

* 原始返回内容

----------

<span id="getErrno()"></span>

#### `getErrno()` 获取错误号

``` php
private function getErrno() : int
```

参数

* 无

返回

* 错误号

----------

<span id="getStatusCode()"></span>

#### `getStatusCode()` 获取状态码

``` php
private function getStatusCode() : int
```

参数

* 无

返回

* 状态码


----------

<span id="optProcess()"></span>

#### `optProcess()` cURL 选项处理

`0.2.0` 新增

``` php
private function optProcess( array $opts )
```

参数

* `opts` 选项

返回

* 属性节点

----------

<span id="urlProcess()"></span>

#### `urlProcess()` 主机 URL 处理

`0.2.0` 新增

``` php
private function urlProcess( string $url ) : bool
```

参数

* `url` 请求 URL

返回

* 布尔值

----------

<span id="resultProcess()"></span>

#### `resultProcess()` 结果处理

``` php
private function resultProcess( mixed $result ) : mixed
```

参数

* `result` 结果

返回

* 处理后的结果

----------

<span id="dataProcess()"></span>

#### `dataProcess()` 发送数据处理

``` php
private function dataProcess( mixed $data ) : string
```

参数

* `data` 待发送的数据

返回

* 处理后的数据字符串

----------

<span id="httpHeaderProcess()"></span>

#### `httpHeaderProcess()` 头信息处理

``` php
private function httpHeaderProcess() : array
```

参数

* 无

返回

* HTTP 头信息数组
