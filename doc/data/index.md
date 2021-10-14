## 字符串处理

字符串处理功能由 `ginkgo\Strings` 类完成，大部分为原 `ginkgo\Func` 类迁移而来，全部为静态方法，如：

`0.2.0` 新增 `ginkgo\String`

`0.2.1` 更名为 `ginkgo\Strings`

``` php
use ginkgo\Strings;

$str = '2014-05-06';

Strings::toTime($str);
```

----------

<span id="ucwords"></span>

#### `ucwords()` 将字符串中每个单词的首字母转换为大写

``` php
function ucwords( $str [, $delimiter = '' ] )
```

参数

* `str` 字符串
* `delimiter` 单词分割字符

返回

*  转换后的字符串，如：User_Name

----------

<span id="toTime"></span>

#### `toTime()` 日期时间字符串转时间戳

``` php
function toTime( $datetime )
```

参数

* `datetime` 日期时间字符串

返回

* UNIX 时间戳

----------

<span id="toHump"></span>

#### `toHump()` 以指定的分隔符将字符串转换为驼峰写法

``` php
function toHump( $str [, $delimiter = '' [, $lcfirst = false ]] )
```

参数

* `str` 字符串
* `delimiter` 单词分割字符
* `lcfirst` 是否首字母小写

返回

* 转换后的字符串，如：user_name 转换为 UserName

----------

<span id="toLine"></span>

#### `toLine()` 将驼峰写法的字符串转换为小写加分隔符

``` php
function toLine( $str [, $delimiter = '' ] )
```

参数

* `str` 字符串
* `delimiter` 单词分割字符

返回

* 转换后的字符串，如：UserName 转换为 user_name

----------

<span id="sizeFormat"></span>

#### `sizeFormat()` 文件大小格式化

``` php
function sizeFormat( $size [, $float = 2 ] )
```

参数

* `size` 文件大小
* `float` 保留小数位数

返回

* 格式化后的文件大小，如：1,024.32 KB

----------

<span id="numFormat"></span>

#### `numFormat()` 格式化数字

``` php
function numFormat( $num [, $float = 2 ] )
```

参数

* `num` 数字
* `float` 保留小数位数

返回

* 格式化后的数字，如：1,024.32

----------

<span id="secrecy"></span>

#### `secrecy()` 隐藏敏感信息，用于敏感字符的隐藏，如手机号码：`139 **** 8888`

``` php
function secrecy( $string [, $left = 5 [, $right = 5 [, $hide = '*' ]]] )
```

参数

* `string` 字符串
* `left` 保留左侧字符个数
* `right` 保留右侧字符个数
* `hide` 替代字符

返回

* 处理后的字符串

----------

<span id="toBase64"></span>

#### `toBase64()` 转换为 Base64

``` php
function toBase64( $string [, $url_safe = true ] )
```

参数

* `string` 数组
* `url_safe` 是否已 URL 安全的方式编码

    说明

    由于默认 Base64 编码结果中有部分字符与 URL 字符冲突，当 `url_safe` 为 true 时，会将编码结果中的 <kbd>+</kbd> 替换为 <kbd>-</kbd>、<kbd>/</kbd> 替换为 <kbd>_</kbd>、<kbd>=</kbd> 将被剔除，以保证编码结果通过 URL 传递时的安全。

返回

* Base64 编码后的字符串

----------

<span id="fromBase64"></span>

#### `fromBase64()` Base64 转换为字符串

``` php
function fromBase64( $base64code [, $url_safe = true ] )
```

参数

* `base64code` 数组
* `url_safe` 是否已 URL 安全的方式解码

    说明

    如果 `base64code` 是通过 URL 安全的方式进行编码的，那么必须采用 URL 安全的方式解码，否则将会出错。

返回

* Base64 解码后的字符串
