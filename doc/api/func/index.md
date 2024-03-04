## ginkgo\Func

常用函数，全部为静态方法

----------

### 类摘要

```php
namespace ginkgo;

class Func {
  // 方法
  public static isEmpty( mixed $data ) : bool
  public static notEmpty( mixed $data ) : bool
  public static isOdd( int $num ) : bool
  public static isEven( int $num ) : bool
  public static safe( string $str [, string $htmlmode = false ] ) : string
  public static fixDs( string $path [, string $ds = DS] ) : string
  public static fillUrl( string $url, string $baseUrl ) : string
  public static getRegex( string $string, string $regex [, bool $wild = false ] ) : array
  public static checkRegex( string $string, string $regex [, bool $wild = false ] ) : bool
  public static rand( [ int $length = 32 ] ) : string

  // 已迁移方法
  public static strtotime( string $datetime ) : string
  public static ucwords( string $str [, string $delimiter ] ) : string
  public static toHump( string $str [, string $delimiter [, bool $lcfirst = false ]] ) : string
  public static toLine( string $str [, string $delimiter ] ) : string
  public static sizeFormat( int $size [, int $float = 2 ] ) : string
  public static numFormat( int $size [, int $float = 2 ] ) : string
  public static strSecret( string $string [, int $left = 5 [, int $right = 5 [, string $hide = '*' ]]] ) : string
  public static fillImg( string $content, string $baseUrl ) : string
  public static arrayFilter( array $arr [, bool $pop_false = true ] ) : array
  public static arrayEach( array $arr [, string $encode ] ) : array

  // 已迁移并弃用的方法
  public static ubbcode( string $string ) : string
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 方法 | - | - | - |
| [isEmpty()](#isEmpty()) | public | static | 是否为空 |
| [notEmpty()](#notEmpty()) | public | static | 是否不为空 `0.2.2` 新增 |
| [isOdd()](#isOdd()) | public | static | 是否为奇数 |
| [isEven()](#isEven()) | public | static | 是否为偶数 `0.2.2` 新增 |
| [safe()](#safe()) | public | static | 安全过滤字符串 |
| [fixDs()](#fixDs()) | public | static | 规范化路径分隔符，并在最后添加分隔符 |
| [fillUrl()](#fillUrl()) | public | static | 将 URL 补充完整 |
| [getRegex()](#getRegex()) | public | static | 用正则表达式匹配字符串并获取搜索结果 |
| [checkRegex()](#checkRegex()) | public | static | 用正则表达式匹配字符串 |
| [rand()](#rand()) | public | static | 生成随机字符串 |
| 已迁移方法 | - | - | - |
| [strtotime()](../datetime/index.md#toTime()) | public | static | 日期时间字符串转时间戳，`0.3.0` 起迁移 |
| [ucwords()](../strings/index.md#ucwords()) | public | static | 将字符串中每个单词的首字母转换为大写，`0.2.0` 起迁移 |
| [toHump()](../strings/index.md#toHump()) | public | static | 以指定的分隔符将字符串转换为驼峰写法，`0.2.0` 起迁移 |
| [toLine()](../strings/index.md#toLine()) | public | static | 将驼峰写法的字符串转换为小写加分隔符，`0.2.0` 起迁移 |
| [sizeFormat()](../strings/index.md#sizeFormat()) | public | static | 文件大小格式化，`0.2.0` 起迁移 |
| [numFormat()](../strings/index.md#numFormat()) | public | static | 格式化数字，`0.2.0` 起迁移 |
| [strSecret()](../strings/index.md#secrecy()) | public | static | 隐藏敏感信息，`0.2.0` 起迁移 |
| [fillImg()](../html/index.md#fillImg()) | public | static | 将 HTML 内的图片 URL 补充完整，`0.2.0` 起迁移 |
| [arrayFilter()](../arrays/index.md#filter()) | public | static | 过滤数组中的重复内容，`0.2.0` 起迁移 |
| [arrayEach()](../arrays/index.md#each()) | public | static | 遍历数组，对键值进行安全过滤，`0.2.0` 起迁移 |
| 已迁移并弃用的方法 | - | - | - |
| [ubbcode()](../ubbcode/index.md) | public | static | 转换字符串，`0.1.1` 起迁移，`0.2.0` 起迁移 |

----------

<span id="isEmpty()"></span>

#### `isEmpty()` 是否为空

``` php
public static function isEmpty( mixed $data ) : bool
```

参数

* `$data` 变量

返回

* true / false

----------

<span id="isOdd()"></span>

#### `isOdd()` 是否为奇数

``` php
public static function isOdd( int $num ) : bool
```

参数

* `num` 数值

返回

* true / false

----------

<span id="safe()"></span>

#### `safe()` 安全过滤字符串

``` php
public static function safe( string $str [, string $htmlmode = false ] ) : string
```

参数

* `str` 字符串

返回

* 过滤后的字符串

----------

<span id="fixDs()"></span>

#### `fixDs()` 规范化路径分隔符，并在最后添加分隔符

``` php
public static function fixDs( string $path [, string $ds = DS] ) : string
```

参数

* `path` 路径
* `ds` 路径分隔符

返回

* 格式化后的路径，如：/web/wwwroot//test/abc 转换为 /web/wwwroot/test/abc/

----------

<span id="fillUrl()"></span>

#### `fillUrl()` 将 URL 补充完整

``` php
public static function fillUrl( string $url, string $baseUrl ) : string
```

参数

* `url` URL
* `baseUrl` 基本 URL

返回

* 完整的 URL，如：

  URL 为 ./image/logo.png，
  基本 URL 为 https://ginkgo，
  补充完整后为 https://ginkgo/image/logo.png

----------

<span id="getRegex()"></span>

#### `getRegex()` 用正则表达式匹配字符串并获取搜索结果

`0.1.2` 新增

``` php
public static function getRegex( string $string, string $regex [, bool $wild = false ] ) : array
```

参数

* `string` 字符串
* `regex` 正则表达式
* `wild` 是否匹配全文

返回

* 数组

  * result 匹配结果（布尔值）
  * matches 搜索结果

----------

<span id="checkRegex()"></span>

#### `checkRegex()` 用正则表达式匹配字符串

``` php
public static function checkRegex( string $string, string $regex [, bool $wild = false ] ) : bool
```

参数

* `string` 字符串
* `regex` 正则表达式
* `wild` 是否验证全文

返回

* 匹配结果（布尔值）

----------

<span id="rand()"></span>

#### `rand()` 生成随机字符串

``` php
public static function rand( [ int $length = 32 ] ) : string
```

参数

* `length` 长度

返回

* 随机字符串

----------

<span id="strtotime()"></span>

#### `strtotime()` 日期时间字符串转时间戳

`0.3.0` 起迁移至 [`ginkgo/Datetime`](../datetime/index.md#toTime) 类，并将逐步弃用

----------

<span id="ucwords()"></span>

#### `ucwords()` 将字符串中每个单词的首字母转换为大写

`0.2.0` 起迁移至 [`ginkgo/Strings`](../strings/strings.md#ucwords) 类，并将逐步弃用

----------

<span id="toHump()"></span>

#### `toHump()` 以指定的分隔符将字符串转换为驼峰写法

`0.2.0` 起迁移至 [`ginkgo/Strings`](../strings/strings.md#toHump) 类，并将逐步弃用

----------

<span id="toLine()"></span>

#### `toLine()` 将驼峰写法的字符串转换为小写加分隔符

`0.2.0` 起迁移至 [`ginkgo/Strings`](../strings/strings.md#toLine) 类，并将逐步弃用

----------

<span id="sizeFormat()"></span>

#### `sizeFormat()` 文件大小格式化

`0.2.0` 起迁移至 [`ginkgo/Strings`](../strings/index.md#sizeFormat) 类，并将逐步弃用

----------

<span id="numFormat()"></span>

#### `numFormat()` 格式化数字

`0.2.0` 起迁移至 [`ginkgo/Strings`](../strings/index.md#numFormat) 类，并将逐步弃用

----------

<span id="strSecret()"></span>

#### `strSecret()` 隐藏敏感信息，用于敏感字符的隐藏，如手机号码：`139 **** 8888`

`0.1.1` 新增
`0.2.0` 起迁移至 [`ginkgo/Strings`](../strings/index.md#secrecy) 类，并将逐步弃用

----------

<span id="fillImg()"></span>

#### `fillImg()` 将 HTML 内的图片 URL 补充完整

`0.2.0` 起迁移至 [`ginkgo/Html`](../html/index.md#fillImg) 类，并将逐步弃用

----------

<span id="arrayFilter()"></span>

#### `arrayFilter()` 过滤数组中的重复内容

`0.2.0` 起迁移至 [`ginkgo/Arrays`](../arrays/index.md#unique) 类，并将逐步弃用

----------

#### `arrayEach()` 遍历数组，对键值进行安全过滤，并用指定的方式对键值进行编码

`0.2.0` 起迁移至 [`ginkgo/Arrays`](../arrays/index.md#map) 类，并将逐步弃用

----------

#### `ubbcode()` 转换字符串

`0.1.1` 起迁移至 [`ginkgo/Ubbcode`](../ubbcode/index.md) 类

`0.2.0` 起弃用

``` php
public static function ubbcode( string $string ) : string
```

参数

* `string` 字符串

返回

* 转换后的字符串

支持的 UBBCODE

| 值 | 描述 | 备注 |
| - | - | - |
| [b]content[/b] | 加粗 | |
| [strong]content[/strong] | 加粗 | |
| [em]content[/em] | 斜体 | |
| [i]content[/i] | 斜体 | |
| [u]content[/u] | 下划线 | |
| [code]content[/code] | 代码 | |
| [del]content[/del] | 已被删除的文本 | |
| [kbd]content[/kbd] | 键盘文本 | |
| [hr]| 水平线 | |
| [br] | 换行符 | |
| {:br} | 换行符 | |
