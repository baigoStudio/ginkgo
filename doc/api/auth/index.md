## ginkgo\Auth

认证是鉴定用户身份的过程。它通常使用一个标识符（如用户名）和一个加密令牌（比如密码或者存取令牌）来鉴别用户身份。认证是登录功能的基础。

`0.1.2` 新增

----------

### 类摘要

```php
namespace ginkgo;

class Auth {
  // 属性
  public $prefix = 'user';
  public $config = array();
  public $options = array(
    'cookie'    => true,
    'remember'  => false,
  );
  public $error;

  protected static $instance;

  private $session;
  private $cookie;
  private $remember;
  private $configThis = array(
    'session_expire'    => 1200,
    'remember_expire'   => 2592000,
  );

  // 方法
  public static instance( [ array $config = array() [, string $prefix ]] ) : object
  public read() : array
  public write( array $authRow [, bool $regen = false [, string $loginType = 'form' [, string $remember [, mixed $pathCookie = '/' ]]]] )
  public end( [ bool $regen = false ] )
  public check( array $authRow [, mixed $pathCookie = '/' ] ) : bool
  public config( array $config )
  public prefix( [ string $prefix ] ) : string
  public setOptions( string $name [, string $value ] )
  public getOptions( [ string $name ] ) : string
  public getError() : string

  protected __construct( [ array $config = array() [, string $prefix ]] ) : object
  protected __clone()

  private checkParam( array $authRow ) : bool
  private haveSession() : bool
  private haveRemenber() : bool
  private hashProcess( array $authRow ) : string
  private errRecord( string $msg ) // since 0.2.4
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$prefix` | public | string | 前缀 |
| [`$config`](#$config) | public | array | 配置 |
| [`$options`](#$options) | public | array | 选项 |
| `$error` | public | string | 错误消息 |
| `$instance` | protected | object static | 本类的实例 |
| [`$session`](#$session) | private | array | 会话 |
| [`$cookie`](#$session) | private | array | Cookie |
| [`$remember`](#$session) | private | array | 记住密码 |
| [`$configThis`](#$config) | private | array | 默认配置 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化方法 |
| [read()](#read()) | public | | 读取认证信息 |
| [write()](#write()) | public | | 写入认证信息 |
| [end()](#end()) | public | | 结束会话 |
| [check()](#check()) | public | | 会话校验 |
| [config()](#config()) | public | | 配置 |
| [prefix()](#prefix()) | public | | 设置、读取前缀 |
| [setOptions()](#setOptions()) | public | | 设置选项 |
| [getOptions()](#getOptions()) | public | | 读取选项 |
| [getError()](#getError()) | public | | 读取错误 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [checkParam()](#checkParam()) | private | | 验证参数 |
| [haveSession()](#haveSession()) | private | | 验证是否有会话信息 |
| [haveRemenber()](#haveRemenber()) | private | | 验证是否记住密码 |
| [hashProcess()](#hashProcess()) | private | | 哈希处理 |
| [errRecord()](#errRecord()) | private | | 记录错误，`0.2.4` 新增 |

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
| session_expire | int | 20分钟 | 认证过期时间 |
| remember_expire | int | 30天 | 记住密码过期时间 |

----------

<span id="$options"></span>

#### `$options` 选项

``` php
public $options;
```

结构：

| 选项名 | 类型 | 默认 | | 描述
| - | - | - | - |
| cookie | bool | true | 是否开启 cookie，如果开启，系统将同时通过 cookie 来验证 |
| remember | bool | false | 是否开启记住用户，如果开启，系统可以实现自动登录 |

----------

<span id="$session"></span>

#### `$session` 会话，`$cookie` Cookie，`$remember` 记住密码

``` php
private $session;
private $cookie;
private $remember;
```

结构

| 名称 | 类型 | 描述 |
| - | - | - |
| 前缀_id | int | 用户 ID |
| 前缀_name | string | 用户名 |
| 前缀_hash | string | 哈希值 |
| 前缀_time | int | 保存时间 |
| 前缀_time_expire | int | 过期时间 |

----------

<span id="instance()"></span>

#### `instance()` 实例化

``` php
public static function instance( [ array $config [, string $prefix ]] ) : object
```

参数

* [`$config`](#config) 配置参数
* `prefix` 前缀

返回

* 本类实例

----------

<span id="read()"></span>

#### `read()` 读取认证信息

``` php
public function read() : array
```

参数

* 无

返回

* 认证信息

  结构如下：

  | 属性 | 类型 | 描述 |
  | - | - | - |
  | [`$session`](#$session) | array | 会话 |
  | [`$cookie`](#$session) | array | Cookie |
  | [`$remember`](#$session) | array | 记住密码 |

----------

<span id="write()"></span>

#### `write()` 写入认证信息

``` php
public function write( array $authRow [, bool $regen = false [, string $loginType = 'form' [, string $remember [, mixed $pathCookie = '/' ]]]] )
```

参数

* [`authRow`](#authRow) 用户信息
* `regen` 使用新生成的会话 ID 更新现有会话 ID

  布尔值，默认为 false

* `loginType` 登录类型

  字符串，默认为 form，表示从表单登录，开发者可以根据实际情况自行命名，如：auto 等等

* `remember` 记住登录状态

  字符串，默认为空，要记住登录状态，必须将本参数设置为 `remember`，`0.2.0` 起可以为 `true`

* `pathCookie` Cookie 保存路径

  字符串或数组，默认 <kbd>/</kbd>

返回

* 无

----------

<span id="end()"></span>

#### `end()` 结束认证

``` php
public function end( [ bool $regen = false ] )
```

参数

* `regen` 是否使用新生成的会话 ID

返回

* 无

----------

<span id="check()"></span>

#### `check()` 验证认证信息

``` php
public function check( array $authRow [, mixed $pathCookie = '/' ] ) : bool
```

参数

* [`authRow`](#authRow) 用户信息
* `pathCookie` Cookie 保存路径

    字符串或数组，默认 <kbd>/</kbd>

返回

* 布尔值

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

<span id="prefix()"></span>

#### `prefix()` 设置、读取前缀

``` php
public function prefix( [ string $prefix ] ) : string
```

参数

* `prefix` 前缀，如此参数为空，则返回当前前缀

返回

* 前缀

----------

<span id="setOptions()"></span>

#### `setOptions()` 设置选项

``` php
public function setOptions( string $name [, string $value ] )
```

参数

* [`name`](#$options) 选项名

  支持两种类型: 为字符串时表示选项名，为数组时表示批量设置。

* `value` 值

  `name` 参数为字符串时必须，为数组时自动忽略

返回

* 无

----------

<span id="getOptions()"></span>

#### `getOptions()` 读取选项

``` php
public function getOptions( [ string $name ] ) : string
```

参数

* [`name`](#$options) 选项名

  此选项为空时，返回所有选项

返回

* 指定选项

----------

<span id="getError()"></span>

#### `getError()` 读取错误

``` php
public function getError() : string
```

参数

* 无

返回

* 错误信息

----------

<span id="checkParam()"></span>

#### `checkParam()` 验证参数

``` php
private function checkParam( array $authRow ) : bool
```

参数

* [`authRow`](#authRow) 用户信息

返回

* 布尔值

----------

<span id="haveSession()"></span>

#### `haveSession()` 验证是否有会话信息

``` php
private function haveSession() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="haveRemenber()"></span>

#### `haveRemenber()` 是否有记住登录状态

``` php
private function haveRemenber() : bool
```

参数

* 无

返回

* 布尔值

----------

<span id="hashProcess()"></span>

#### `hashProcess()` 哈希处理

``` php
private function hashProcess( array $authRow ) : string
```

参数

* [`authRow`](#authRow) 用户信息

返回

* 哈希值

----------

<span id="errRecord()"></span>

#### `errRecord()` 记录错误

`0.2.4` 新增

``` php
private function errRecord( string $msg )
```

参数

* #msg 错误信息


----------

<span id="authRow"></span>

#### `authRow` 用户信息：

必须为数组，结构如下：

| 名称 | 类型 | 必需 | 描述 |
| - | - | - | - |
| 前缀_id | int | true | ID |
| 前缀_name | string | true | 用户名 |
| 前缀_time_login | int | true | 最后登录时间（UNIX 时间戳） |
| 前缀_ip | string | true | IP 地址 |
