## ginkgo\Crypt

加密解密类

----------

### 类摘要

```php
namespace ginkgo;

class Crypt {
  // 属性
  public static $error;
  public static $algo;

  private static $init;
  private static $keyPub;

  // 方法
  public static init()
  public static crypt( string $str, string $salt [, bool $is_md5 = false [, int $crypt_type = 2 ]] ) : string
  public static encrypt( string $string, string $key, string $iv ) : string
  public static decrypt( string $string, string $key, string $iv ) : string
  public static getError() : string
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$error` | public | array static | 错误消息 |
| `$algo` | public | string static | 加密算法 `0.2.2` 新增 |
| `$init` | private | bool static | 是否初始化 |
| [`$keyPub`](#$keyPub) | private | string static | 公钥 |
| 方法 | - | - | - |
| [init()](#init()) | public | static | 初始化 |
| [crypt()](#crypt()) | public | static | 非对称加密（不可逆） |
| [encrypt()](#encrypt()) | public | static | 加密 |
| [decrypt()](#decrypt()) | public | static | 解密 |
| [getError()](#getError()) | public | static | 获取错误 |

----------

<span id="$keyPub"></span>

#### `$keyPub` 公钥

``` php
private static $keyPub;
```

读取默认位于 ./runtime/data/`GK_APP_HASH`/key_pub.inc.php 的文件

----------

<span id="init()"></span>

#### `init()` 初始化

``` php
public static function init()
```

参数

* 无

返回

* 无

----------

<span id="crypt()"></span>

#### `crypt()` 非对称加密（不可逆）

``` php
public static function crypt( string $str, string $salt [, bool $is_md5 = false [, int $crypt_type = 2 ]] ) : string
```

参数

* `str` 待加密字符
* `salt` 盐
* `is_md5` 是否已经 md5 加密
* `crypt_type` 加密类型（历史技术债务，向下兼容）

返回

* 加密结果

----------

<span id="encrypt()"></span>

#### `encrypt()` 加密

``` php
public static function encrypt( string $string, string $key, string $iv ) : string
```

参数

* `string` 待加密字符
* `key` 加密码
* `iv` 初始化向量

返回

* 加密结果

----------

<span id="decrypt()"></span>

#### `decrypt()` 解密

``` php
public static function decrypt( string $string, string $key, string $iv ) : string
```

参数

* `string` 待加密字符
* `key` 加密码
* `iv` 初始化向量

返回

* 解密结果

----------

<span id="getError()"></span>

#### `getError()` 获取错误

``` php
public static function getError() : string
```

参数

* 无

返回

* 获取错误消息
