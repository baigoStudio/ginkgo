## ginkgo\Strings

字符串处理，大部分为原 `ginkgo\Func` 类迁移而来

`0.2.0` 新增 `ginkgo\String`

`0.2.1` 更名为 `ginkgo\Strings`

----------

### 类摘要

```php
namespace ginkgo;

class Strings {
  // 方法
  public static ucwords( string $str [, string $delimiter ] ) : string
  public static toHump( string $str [, string $delimiter [, bool $lcfirst = false ]] ) : string
  public static toLine( string $str [, string $delimiter ] ) : string
  public static sizeFormat( numeric $size [, int $float = 2 ] ) : string
  public static numFormat( numeric $num [, int $float = 2 ] ) : string
  public static secrecy( string $string [, int $left = 5 [, int $right = 5 [, string $hide = '*' ]]] ) : string
  public static toBase64( string $string [, bool $url_safe = true ] ) : string
  public static fromBase64( string $base64code [, bool $url_safe = true ] ) : string

  // 已迁移方法
  public static toTime( string $datetime ) : int
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 方法 | - | - | - |
| [ucwords()](#ucwords()) | public | static | 将字符串中每个单词的首字母转换为大写 |
| [toTime()](#toTime()) | public | static | 日期时间字符串转时间戳 |
| [toHump()](#toHump()) | public | static | 以指定的分隔符将字符串转换为驼峰写法 |
| [toLine()](#toLine()) | public | static | 将驼峰写法的字符串转换为小写加分隔符 |
| [sizeFormat()](#sizeFormat()) | public | static | 文件大小格式化 |
| [numFormat()](#numFormat()) | public | static | 格式化数字 |
| [secrecy()](#secrecy()) | public | static | 隐藏敏感信息 |
| [toBase64()](#toBase64()) | public | static | 转换为 Base64 |
| [fromBase64()](#fromBase64()) | public | static | Base64 转换为字符串 |

----------

<span id="ucwords()"></span>

#### `ucwords()` 将字符串中每个单词的首字母转换为大写

``` php
public static function ucwords( string $str [, string $delimiter = "\t\r\n\f\v" ] ) : string
```

参数

* `str` 字符串
* `delimiter` 单词分割字符

返回

*  转换后的字符串，如：User_Name

----------

<span id="toTime()"></span>

#### `toTime()` 日期时间字符串转时间戳

`0.3.0` 起迁移至 ginkgo/Datetime

``` php
public static function toTime( string $datetime ) : int
```

参数

* `datetime` 日期时间字符串

返回

* UNIX 时间戳

----------

<span id="toHump()"></span>

#### `toHump()` 以指定的分隔符将字符串转换为驼峰写法

``` php
public static function toHump( string $str [, string $delimiter [, bool $lcfirst = false ]] ) : string
```

参数

* `str` 字符串
* `delimiter` 单词分割字符
* `lcfirst` 是否首字母小写

返回

* 转换后的字符串，如：user_name 转换为 UserName

----------

<span id="toLine()"></span>

#### `toLine()` 将驼峰写法的字符串转换为小写加分隔符

``` php
public static function toLine( string $str [, string $delimiter ] ) : string
```

参数

* `str` 字符串
* `delimiter` 单词分割字符

返回

* 转换后的字符串，如：UserName 转换为 user_name

----------

<span id="sizeFormat()"></span>

#### `sizeFormat()` 文件大小格式化

``` php
public static function sizeFormat( numeric $size [, int $float = 2 ] ) : string
```

参数

* `size` 文件大小
* `float` 保留小数位数

返回

* 格式化后的文件大小，如：1,024.32 KB

----------

<span id="numFormat()"></span>

#### `numFormat()` 格式化数字

``` php
public static function numFormat( numeric $num [, int $float = 2 ] ) : string
```

参数

* `num` 数字
* `float` 保留小数位数

返回

* 格式化后的数字，如：1,024.32

----------

<span id="secrecy()"></span>

#### `secrecy()` 隐藏敏感信息

用于敏感字符的隐藏，如手机号码：`139 **** 8888`

``` php
public static function secrecy( string $string [, int $left = 5 [, int $right = 5 [, string $hide = '*' ]]] ) : string
```

参数

* `string` 字符串
* `left` 保留左侧字符个数
* `right` 保留右侧字符个数
* `hide` 替代字符

返回

* 处理后的字符串

----------

<span id="toBase64()"></span>

#### `toBase64()` 转换为 Base64

``` php
public static function toBase64( string $string [, bool $url_safe = true ] ) : string
```

参数

* `string` 数组
* `url_safe` 是否已 URL 安全的方式编码

  说明

  由于默认 Base64 编码结果中有部分字符与 URL 规则冲突，当 `url_safe` 为 true 时，会将编码结果中的 <kbd>+</kbd> 替换为 <kbd>-</kbd>、<kbd>/</kbd> 替换为 <kbd>_</kbd>、<kbd>=</kbd> 将被剔除，以保证编码结果通过 URL 传递时的安全。

返回

* Base64 编码后的字符串

----------

<span id="fromBase64()"></span>

#### `fromBase64()` Base64 转换为字符串

``` php
public static function fromBase64( string $base64code [, bool $url_safe = true ] ) : string
```

参数

* `base64code` 数组
* `url_safe` 是否已 URL 安全的方式解码

  说明

  如果 `base64code` 是通过 URL 安全的方式进行编码的，那么必须采用 URL 安全的方式解码，否则将会出错。

返回

* Base64 解码后的字符串
