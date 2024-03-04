## ginkgo\Smtp

SMTP 邮件发送类

----------

### 类摘要

```php
namespace ginkgo;

class Smtp {
  // 属性
  public $config = array();
  public $error;
  public $rcpt;
  public $reply;
  public $subject;
  public $content;
  public $contentAlt;

  protected static $instance;

  private $configThis = array(
    'method'        => 'smtp',
    'host'          => '',
    'secure'        => 'off',
    'port'          => 25,
    'auth'          => 'true',
    'user'          => '',
    'pass'          => '',
    'from_addr'     => 'root@localhost',
    'from_name'     => 'root',
    'reply_addr'    => 'root@localhost',
    'reply_name'    => 'root',
  );

  private $serverCaps = array();
  private $crlf = "\r\n";
  private $le = "\n";
  private $res_conn;
  private $init;

  // 方法
  public static instance( [ array $config ] ) : object
  public config( array $config )
  public connect() : bool
  public addRcpt( string $addr [, string $name ] )
  public addReply( string $addr [, string $name ] )
  public setSubject( string $subject )
  public setFrom( string $addr [, string $name ] )
  public setContent( string $content )
  public setContentAlt( string $content )
  public getError( [ string $name ] ) : mixed
  public send() : bool

  protected __construct( [ array $config ] ) : object
  protected __clone()

  private createHello( string $host ) : bool
  private createBody( string $boundary, string $message_id ) : bool
  private sendCmd( string $cmd, string $cmd_str, $expect = 250 ) : bool
  private sendHello( string $hello, string $host ) : bool
  private sendDo( string $data ) : mixed
  private headerProcess( string $boundary, string $message_id ) : string
  private bodyProcess( string $boundary ) : string
  private addrProcess( string $type, array $addr ) : string
  private serverCapsProcess( string $type )
  private contentProcess( string $boundary, string $content [, string $type = 'text/plain' ] ) : string
  private getAuthtype() : string
  private headerLine( string $name, string $value ) : string
  private contentLine( string $value ) : string
  private contentEncode( string $string ) : string
  private getResult() : string
  private errRecord( string $msg ) // since 0.2.4
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array | 配置 |
| `$error` | public | array | 错误 |
| [`$rcpt`](#$rcpt) | public | array | 收件人 |
| [`$reply`](#$rcpt) | public | array | 回复地址 |
| `$subject` | public | string | 主题 |
| `$content` | public | string | 邮件内容 |
| `$contentAlt` | public | string | 纯文本邮件内容 |
| `$instance` | protected | object static | 本类实例 |
| [`$configThis`](#$config) | private | array | 默认配置 |
| `$serverCaps` | private | array | 服务器说明 |
| `$crlf` | private | string | 换行符 |
| `$le` | private | string | 换行符 |
| `$res_conn` | private | resource | 连接资源 |
| `$init` | private | bool | 是否初始化标记 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [config()](#config()) | public | | 配置 |
| [connect()](#connect()) | public | | 连接服务器 |
| [addRcpt()](#addRcpt()) | public | | 添加收件人 |
| [addReply()](#addReply()) | public | | 添加回复地址 |
| [setSubject()](#setSubject()) | public | | 设置主题 |
| [setFrom()](#setFrom()) | public | | 设置来源地址 |
| [setContent()](#setContent()) | public | | 设置内容 |
| [setContentAlt()](#setContentAlt()) | public | | 设置纯文本内容 |
| [getError()](#getError()) | public | | 获取错误 |
| [send()](#send()) | public | | 发送邮件 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [createHello()](#createHello()) | private | | 创建 HELLO 命令 |
| [createBody()](#createBody()) | private | | 创建邮件主体 |
| [sendCmd()](#sendCmd()) | private | | 发送命令 |
| [sendHello()](#sendHello()) | private | | 发送 HELLO |
| [sendDo()](#sendDo()) | private | | 真实发送命令 |
| [headerProcess()](#headerProcess()) | private | | 头处理 |
| [bodyProcess()](#bodyProcess()) | private | | 主体处理 |
| [addrProcess()](#addrProcess()) | private | | 地址处理 |
| [serverCapsProcess()](#serverCapsProcess()) | private | | 服务器说明处理 |
| [contentProcess()](#contentProcess()) | private | | 内容处理 |
| [getAuthtype()](#getAuthtype()) | private | | 获取认证类型 |
| [headerLine()](#headerLine()) | private | | 处理一行头 |
| [contentLine()](#contentLine()) | private | | 处理一行内容 |
| [contentEncode()](#contentEncode()) | private | | 内容编码 |
| [getResult()](#getResult()) | private | | 获取服务器反馈 |
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
| method | string | smtp | 发送邮件方法（smtp 或 func） |
| host | string | | 服务器地址 |
| secure | string | off | 安全认证类型（ssl 或 tls 或者 off） |
| port | int | 25 | 端口 |
| auth | bool | true | 服务器是否需要认证 |
| user | string | | 用户名 |
| pass | string | | 密码 |
| from_addr | string | root@localhost | 来源地址 |
| from_name | string | root | 来源名字 |
| reply_addr | string | root@localhost | 回复地址 |
| reply_name | string | root | 回复名字 |

----------

<span id="$rcpt"></span>

#### `$rcpt` 收件人，`$reply` 回复地址

``` php
public $rcpt = array(
  array(
    'addr' => 'root@localhost',
    'name' => 'root', // 可选
  ),
  array(
    'addr' => 'test@localhost',
    'name' => 'test', // 可选
  ),
);

public $reply  = array(
  array(
    'addr' => 'root@localhost',
    'name' => 'root', // 可选
  ),
  array(
    'addr' => 'test@localhost',
    'name' => 'test', // 可选
  ),
);
```

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

<span id="connect()"></span>

#### `connect()` 连接服务器

``` php
public function connect() : bool
```

参数

* 无

返回

* 连接是否成功

----------

<span id="addRcpt()"></span>

#### `addRcpt()` 添加收件人

``` php
public function addRcpt( string $addr [, string $name ] )
```

参数

* [`addr`](#$rcpt) 邮箱地址
* [`name`](#$rcpt) 名字

返回

* 无

----------

<span id="addReply()"></span>

#### `addReply()` 添加回复地址

``` php
public function addReply( string $addr [, string $name ] )
```

参数

* [`addr`](#$rcpt) 邮箱地址
* [`name`](#$rcpt) 名字

返回

* 无

----------

<span id="setSubject()"></span>

#### `setSubject()` 设置主题

``` php
public function setSubject( string $subject )
```

参数

* `subject` 主题

返回

* 无

----------

<span id="setFrom()"></span>

#### `setFrom()` 设置来源地址

``` php
public function setFrom( string $addr [, string $name ] )
```

参数

* [`addr`](#$rcpt) 邮箱地址
* [`name`](#$rcpt) 名字

返回

* 无

----------

<span id="setContent()"></span>

#### `setContent()` 设置内容

``` php
public function setContent( string $content )
```

参数

* `content` 内容

返回

* 无

----------

<span id="setContentAlt()"></span>

#### `setContentAlt()` 设置纯文本内容

本方法会自动过滤 html 标签

``` php
public function setContentAlt( string $content )
```

参数

* `content` 内容

返回

* 无

----------

<span id="getError()"></span>

#### `getError()` 获取错误

``` php
public function getError( [ string $name ] ) : mixed
```

参数

* `name` 错误名称，本参数为空时返回所有错误

返回

* 错误

----------

<span id="send()"></span>

#### `send()` 发送邮件

``` php
public function send() : bool
```

参数

* 无

返回

* 发送是否成功

----------

<span id="createHello()"></span>

#### `createHello()` 创建 HELLO 命令

``` php
private function createHello( string $host ) : bool
```

参数

* `host` 主机

返回

* 发送是否成功

----------

<span id="createBody()"></span>

#### `createBody()` 创建邮件主体

``` php
private function createBody( string $boundary, string $message_id ) : bool
```

参数

* `boundary` 边界
* `message_id` 消息 ID

返回

* 发送是否成功

----------

<span id="sendCmd()"></span>

#### `sendCmd()` 发送命令

``` php
private function sendCmd( string $cmd, string $cmd_str, $expect = 250 ) : bool
```

参数

* `cmd` 命令标记
* `cmd_str` 命令内容
* `expect` 期待服务器返回值

返回

* 发送是否成功

----------

<span id="sendHello()"></span>

#### `sendHello()` 发送 HELLO

``` php
private function sendHello( string $hello, string $host ) : bool
```

参数

* `hello` hello 消息
* `host` 主机

返回

* 发送是否成功

----------

<span id="sendDo()"></span>

#### `sendDo()` 真实发送命令

``` php
private function sendDo( string $data ) : mixed
```

参数

* `data` 命令数据

返回

* 发送是否成功

----------

<span id="headerProcess()"></span>

#### `headerProcess()` 头处理

``` php
private function headerProcess( string $boundary, string $message_id ) : string
```

参数

* `boundary` 边界
* `message_id` 消息 ID

返回

* 头

----------

<span id="bodyProcess()"></span>

#### `bodyProcess()` 主体处理

``` php
private function bodyProcess( string $boundary ) : string
```

参数

* `boundary` 边界

返回

* 主体

----------

<span id="addrProcess()"></span>

#### `addrProcess()` 地址处理

``` php
private function addrProcess( string $type, array $addr ) : string
```

参数

* `type` 类型
* `addr` 地址内容

返回

* 地址

----------

<span id="serverCapsProcess()"></span>

#### `serverCapsProcess()` 服务器说明处理

``` php
private function serverCapsProcess( string $type )
```

参数

* `type` 类型

返回

* 无

----------

<span id="contentProcess()"></span>

#### `contentProcess()` 内容处理

``` php
private function contentProcess( string $boundary, string $content [, string $type = 'text/plain' ] ) : string
```

参数

* `boundary` 边界
* `content` 内容
* `type` 类型

返回

* 内容

----------

<span id="getAuthtype()"></span>

#### `getAuthtype()` 获取认证类型

``` php
private function getAuthtype() : string
```

参数

* 无

返回

* 认证类型

----------

<span id="headerLine()"></span>

#### `headerLine()` 处理一行头

``` php
private function headerLine( string $name, string $value ) : string
```

参数

* `name` 名称
* `value` 值

返回

* 头

----------

<span id="contentLine()"></span>

#### `contentLine()` 处理一行内容

``` php
private function contentLine( string $value ) : string
```

参数

* `value` 值

返回

* 内容

----------

<span id="contentEncode()"></span>

#### `contentEncode()` 内容编码

``` php
private function contentEncode( string $string ) : string
```

参数

* `string` 内容

返回

* 编码后的内容

----------

<span id="getResult()"></span>

#### `getResult()` 获取服务器反馈

``` php
private function getResult() : string
```

参数

* 无

返回

* 服务器反馈


----------

<span id="errRecord()"></span>

#### `errRecord()` 记录错误

`0.2.4` 新增

``` php
private function errRecord( string $msg )
```

参数

* #msg 错误信息
