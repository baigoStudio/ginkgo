## ginkgo\Ftp

FTP 文件传输

----------

### 类摘要

```php
namespace ginkgo;

class Ftp {
  // 属性
  public $config = array();
  public $caInfo;
  public $result;
  public $error;
  public $errno;
  public $statusCode;
  public $allowScheme = array('ftp', 'ftps', 'sftp');

  protected static $instance;

  private $configThis = array(
    'scheme'          => '',
    'host'            => '',
    'port'            => 21,
    'user'            => '',
    'pass'            => '',
    'path'            => '',
    'pasv'            => false,
    'verify_peer'     => false,
    'verify_host'     => false,
    'return_transfer' => true,
    'timeout'         => 30,
  );

  private $res_curl;
  private $userPass;
  private $hostUrl;
  private $hostPath;

  // 已弃用属性
  public $res_conn;

  // 方法
  public static instance( [ array $config ] ) : object
  public config( array $config )
  public init() : bool
  public pasv( [ bool $pasv ] )
  public port( [ int $port ] )
  public fileUpload( string $path_local, string $path_remote [, bool $ascii = true ] ) : bool
  public fileDelete( string $path_remote ) : bool
  public getError() : string
  public getErrno() : int

  protected __construct( [ array $config ] ) : object
  protected __clone()

  private optProcess( array $opts )
  private urlProcess() : bool
  private errRecord( string $msg ) // since 0.2.4

  // 已弃用方法
  public connect() : bool
  public login() : bool
  public dirList( string $path_remote [, bool $is_abs = false ] ) : array
  public dirMk( string $path_remote [, bool $is_abs = false ] ) : bool
  public dirDelete( string $path_remote [, bool $is_abs = false ] ) : bool
  public close()
  private initConfig() : bool
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array | 配置 |
| `$caInfo` | public | string | 证书路径，`0.2.0` 新增 |
| `$result` | public | string | 返回结果，`0.2.0` 新增 |
| `$error` | public | string | 错误 |
| `$errno` | public | int | 错误号，`0.2.0` 新增 |
| `$statusCode` | public | string | 状态码，`0.2.0` 新增 |
| `$allowScheme` | public | array | 允许的协议，`0.2.0` 新增 |
| `$instance` | protected | object static | 本类实例 |
| [`$configThis`](#$config) | private | array | 默认配置 |
| `$res_curl` | private | resource | CURL 连接资源，`0.2.0` 新增 |
| `$userPass` | private | string | 用户名密码，`0.2.0` 新增 |
| `$hostUrl` | private | string | 主机 URL，`0.2.0` 新增 |
| `$hostPath` | private | string | 主机路径，`0.2.0` 新增 |
| 已弃用属性 | - | - | - |
| `$res_conn` | public | object | ftp 连接资源 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [init()](#init()) | public | | 初始化 |
| [config()](#config()) | public | | 配置，`0.2.0` 新增 |
| [pasv()](#pasv()) | public | | 设置被动模式，`0.2.0` 新增 |
| [port()](#port()) | public | | 设置端口，`0.2.0` 新增 |
| [fileUpload()](#fileRead()) | public | | 上传文件 ||
| [fileDelete()](#fileDelete()) | public | | 删除文件 |
| [close()](#close()) | public | | 关闭 FTP 连接 |
| [getError()](#getError()) | public | | 获取错误 |
| [getErrno()](#getErrno()) | public | | 获取错误号 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [optProcess()](#optProcess()) | private | | 选项处理，`0.2.0` 新增 |
| [urlProcess()](#urlProcess()) | private | | 主机 URL 处理，`0.2.0` 新增 |
| 已弃用方法 | - | - | - |
| [connect()](#connect()) | public | | 连接服务器，`0.2.0` 弃用 |
| [login()](#login()) | public | | 登录，`0.2.0` 弃用 |
| [dirList()](#dirList()) | public | | 列出目录结构，`0.2.0` 弃用 |
| [dirMk()](#dirMk()) | public | | 创建目录，`0.2.0` 弃用 |
| [dirDelete()](#dirDelete()) | public | | 递归删除整个目录，`0.2.0` 弃用 |
| [initConfig()](#initConfig()) | private | | 配置初始化，`0.2.0` 弃用 |
| [errRecord()](#errRecord()) | private | | 记录错误，`0.2.4` 新增 |

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
| scheme | string | | FTP 协议，`0.2.0` 新增 |
| host | string | | 服务器 |
| port | int | | 端口 |
| user | string | | 用户名 |
| pass | string | | 密码 |
| path | string | | 基本路径 |
| pasv | bool | false | 被动模式 |
| verify_peer | bool | false | 验证对等证书，`0.2.0` 新增 |
| verify_host | bool | false | 验证主机，`0.2.0` 新增 |
| return_transfer | bool | true | 是否转换返回，`0.2.0` 新增 |
| timeout | int | 30 | 服务器超时，`0.2.0` 新增 |

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

<span id="init()"></span>

#### `init()` 初始化

`0.2.0` 之前，快速执行 [`connect()`](#connect()) 和 [`login()`](#login()) 方法

``` php
public function init() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="pasv()"></span>

#### `pasv()` 设置被动模式

`0.2.0` 新增

``` php
public function pasv( [ bool $pasv = true ] )
```

参数

* `pasv`，是否开启被动模式

返回

* 无

----------

<span id="port()"></span>

#### `port()` 设置端口

`0.2.0` 新增

``` php
public function port( [ int $port = 21 ] )
```

参数

* `port`，端口

返回

* 无

----------

<span id="fileUpload()"></span>

#### `fileUpload()` 上传文件

``` php
public function fileUpload( string $path_local, string $path_remote [, bool $is_abs = false [, int $mod = FTP_ASCII ]] ) : bool // 0.2.0 前
public function fileUpload( string $path_local, string $path_remote [, bool $ascii = true ] ) : bool // 0.2.0 及以后
```

参数

* `path_local` 本地路径
* `path_remote` 远程路径
* `$is_abs` 给定的路径是否为绝对路径，`0.2.0` 弃用
* `$mod` 上传模式，`0.2.0` 弃用，可能的值如下：

  可能的值

  | 值 | 类型 | 描述 |
  | - | - | - |
  | FTP_ASCII（默认值） | 预定义常量 ｜ 文本模式 |
  | FTP_BINARY | 预定义常量 ｜ 二进制模式 |

* `$ascii` 是否以 ASCII 码模式上传，`0.2.0` 新增

返回

* 布尔值

----------

<span id="fileDelete()"></span>

#### `fileDelete()` 删除文件

``` php
public function fileDelete( string $path_remote [, bool $is_abs = false ] ) : bool
```

参数

* `path_remote` 远程路径
* `$is_abs` 给定的路径是否为绝对路径 `0.2.0` 弃用

返回

* 布尔值

----------

<span id="close()"></span>

#### `close()` 关闭 FTP 连接

``` php
public function close()
```

参数

* 无

返回

* 无

----------

<span id="getError()"></span>

#### `getError()` 获取错误

``` php
public function getError() : string
```

参数

* 无

返回

* 错误消息

----------

<span id="optProcess()"></span>

#### `optProcess()` cURL 选项处理

`0.2.0` 新增

``` php
private function optProcess( $opts )
```

参数

* `opts` 选项

返回

* 无

----------

<span id="urlProcess()"></span>

#### `urlProcess()` 主机 URL 处理

`0.2.0` 新增

``` php
private function urlProcess() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="connect()"></span>

#### `connect()` 连接服务器

`0.2.0` 弃用

``` php
public function connect() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="login()"></span>

#### `login()` 登录

`0.2.0` 弃用

``` php
public function login() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="dirList()"></span>

#### `dirList()` 列出目录结构

`0.2.0` 弃用

``` php
public function dirList( string $path_remote [, bool $is_abs = false ] ) : array
```

参数

* `path_remote` 远程路径
* `$is_abs` 给定的路径是否为绝对路径

返回

* 目录列表

----------

<span id="dirMk()"></span>

#### `dirMk()` 创建目录

`0.2.0` 弃用

``` php
public function dirMk( string $path_remote [, bool $is_abs = false ] ) : bool
```

参数

* `path_remote` 远程路径
* `$is_abs` 给定的路径是否为绝对路径

返回

* 布尔值

----------

<span id="dirDelete()"></span>

#### `dirDelete()` 递归删除整个目录

`0.2.0` 弃用

``` php
public function dirDelete( string $path_remote [, bool $is_abs = false ] ) : bool
```

参数

* `path_remote` 远程路径
* `$is_abs` 给定的路径是否为绝对路径

返回

* 布尔值

----------

<span id="initConfig()"></span>

#### `initConfig()` 配置初始化

`0.2.0` 弃用

``` php
private function initConfig() : bool
```

参数

* 无

返回

* 布尔值


----------

<span id="errRecord()"></span>

#### `errRecord()` 记录错误

`0.2.4` 新增

``` php
private function errRecord( string $msg )
```

参数

* #msg 错误信息
