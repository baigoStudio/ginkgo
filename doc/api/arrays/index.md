# ginkgo\Arrays

数组处理，大部分为原 `ginkgo\Func` 类迁移而来

`0.2.0` 新增

----------

### 类摘要

```php
namespace ginkgo;

class Arrays {
  // 属性
  public static $error;

  private static $errType = array(
    JSON_ERROR_DEPTH            => 'Maximum stack depth exceeded',
    JSON_ERROR_STATE_MISMATCH   => 'State mismatch (invalid or malformed JSON)',
    JSON_ERROR_CTRL_CHAR        => 'Control character error, possibly incorrectly encoded',
    JSON_ERROR_SYNTAX           => 'Syntax error',
  );

  // 方法
  public static map( array $arr [, string $func [, int $left = 5 [, int $right = 5 [, string $hide = '*' ]]]] ) : array // since 0.2.3
  public static unique( array $arr [, bool $pop_false = false ] ) : array // since 0.2.4
  public static toJson( array $arr [, bool $func ] ) : string
  public static fromJson( string $json [, bool $assoc = true ] ) : array
  public static getError() : array

  public static each( array $arr [, string $func [, int $left = 5 [, int $right = 5 [, string $hide = '*' ]]]] ) : array // 0.2.3 起改为 map() 方法，即将弃用
  public static filter( array $arr [, bool $pop_false = false ] ) : array // 0.2.4 起改为 unique() 方法，即将弃用
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$error` | public | array static | 错误消息 |
| [`$errType`](#$errType) | protected | array static | 错误类型 |
| 方法 | - | - | - |
| [map()](#map()) | public | static | 遍历数组，`0.2.3` 起由 `each()` 方法变更而来 |
| [unique()](#unique()) | public | static | 过滤数组中的重复内容，`0.2.4` 起由 `filter()` 方法变更而来 |
| [toJson()](#toJson()) | public | static | 转换为 JSON |
| [fromJson()](#fromJson()) | public | static | JSON 转化为数组 |
| [getError()](#getError()) | public | static | 获取错误 |
| [each()](#map()) | public | static | 遍历数组，改为 `map()` 方法，即将弃用 |
| [filter()](#unique()) | public | static | 0.2.4 起改为 unique() 方法，即将弃用 |

----------

<span id="$errType"></span>

#### `$errType` 错误类型

``` php
private static $errType;
```

结构

| 名称 | 类型 | 描述 |
| - | - | - |
| JSON_ERROR_DEPTH | 预定义常量 | JSON 到达了最大堆栈深度 |
| JSON_ERROR_STATE_MISMATCH | 预定义常量 | 无效或异常的 JSON |
| JSON_ERROR_CTRL_CHAR | 预定义常量 | JSON 控制字符错误，可能是编码不对 |
| JSON_ERROR_SYNTAX | 预定义常量 | JSON 语法错误 |

----------

<span id="filter()"></span>
<span id="unique()"></span>

#### `unique()` 过滤数组中的重复内容

`0.2.4` 起由 `filter()` 方法变更而来

``` php
public static function unique( array $arr [, bool $pop_false = true ] ) : array
```

参数

* `arr` 数组
* `pop_false` 是否去除等值为 FALSE 的条目

返回

* 过滤后的数组

----------

<span id="each()"></span>
<span id="map()"></span>

#### `map()` 遍历数组，对键值进行安全过滤，并用指定的方式对键值进行编码

`0.2.3` 起由 `each()` 方法变更而来

``` php
public static function map( array $arr [, string $func [, int $left = 5 [, int $right = 5 [, string $hide = '*' ]]]] ) : array
```

参数

* `arr` 数组
* `func` 处理函数、方法

  可能的值

  | 值 | 描述 |
  | - | - |
  | 空（默认值） | 不作处理 |
  | url_encode 或 urlencode | URL 编码 |
  | url_decode 或 urldecode | URL 解码 |
  | json_safe | 用 JSON 安全的方式解码 |
  | md5 | md5 编码 |
  | base64_encode 或 base64encode | base64 编码 |
  | base64_decode 或 base64decode | base64 解码 |
  | secrecy | 用 [`Strings::secrecy()`](../strings#secrecy()) 方法处理字符 |
  | html_encode 或 htmlencode | `0.2.3` 新增 |
  | html_decode 或 htmldecode | `0.2.3` 新增 |

* `left` 保留左边字符数, 仅在处理函数为 secrecy 时有效
* `right` 保留右边边字符数, 仅在处理函数为 secrecy 时有效
* `hide` 替换字符, 仅在处理函数为 secrecy 时有效

返回

* 处理后的数组

----------

<span id="toJson()"></span>

#### `toJson()` 转换为 JSON

``` php
public static function toJson( array $arr [, bool $encode = false ] ) : string
```

参数

* `arr` 数组
* `encode` 编码方式，对待编码的数组用指定的方式对键值进行编码

  可能的值

  | 值 | 描述 |
  | - | - |
  | 空（默认值） | 不进行编码 |
  | urlencode | URL 编码 |
  | json_safe | 用 JSON 安全的 URL 编码 |
  | md5 | md5 编码 |

返回

* JSON 编码后的字符串

----------

<span id="fromJson()"></span>

#### `fromJson()` JSON 转化为数组

``` php
public static function fromJson( string $json [, bool $assoc = true ] ) : array
```

参数

* `json` JSON 字符串
* `assoc` 是否返回 array

  当该参数为 true 时，将返回 array 否则为 object

返回

* array / object

----------

<span id="getError()"></span>

#### `getError()` 获取错误

``` php
public static function getError() : array
```

参数

* 无

返回

* 获取数组处理时产生的错误消息
