## 常用函数

常用函数功能由 `ginkgo\Func` 类完成，全部为静态方法，如：

``` php
use ginkgo\Func;

$str = 'test'

Func::isEmpty($str);
```
----------

#### `isEmpty` 是否为空

``` php
function isEmpty( $var )
```

参数

* `var` 变量

返回

* true / false

----------

#### `isOdd` 是否为奇数

``` php
function isOdd( $num )
```

参数

* `num` 数值

返回

* true / false

----------

#### `strtotime` 日期时间字符串转时间戳

``` php
function strtotime( $datetime )
```

参数

* `datetime` 日期时间字符串

返回

* UNIX 时间戳

----------

#### `ucwords` 将字符串中每个单词的首字母转换为大写

``` php
function ucwords( $str [, $delimiter = ''] )
```

参数

* `str` 字符串
* `delimiter` 单词分割字符

返回

*  转换后的字符串，如：User_Name

----------

#### `toHump` 以指定的分隔符将字符串转换为驼峰写法

``` php
function toHump( $str [, $delimiter = '' [, $lcfirst = false]] )
```

参数

* `str` 字符串
* `delimiter` 单词分割字符
* `lcfirst` 是否首字母小写

返回

* 转换后的字符串，如：user_name 转换为 UserName

----------

#### `toLine` 将驼峰写法的字符串转换为小写加分隔符

``` php
function toLine( $str [, $delimiter = ''] )
```

参数

* `str` 字符串
* `delimiter` 单词分割字符

返回

* 转换后的字符串，如：UserName 转换为 user_name

----------

#### `safe` 安全过滤字符串

``` php
function safe( $str )
```

参数

* `str` 字符串

返回

* 过滤后的字符串

----------

#### `sizeFormat` 文件大小格式化

``` php
function sizeFormat( $size [, $float = 2] )
```

参数

* `size` 文件大小
* `float` 保留小数位数

返回

* 格式化后的文件大小，如：1,024.32 KB

----------

#### `numFormat` 格式化数字

``` php
function numFormat( $num [, $float = 2] )
```

参数

* `num` 数字
* `float` 保留小数位数

返回

* 格式化后的数字，如：1,024.32

----------

#### `fixDs` 规范化路径分隔符，并在最后添加分隔符

``` php
function fixDs( $path [, $ds = DS] )
```

参数

* `path` 路径
* `ds` 路径风格符

返回

* 格式化后的路径，如：/web/wwwroot//test/abc 转换为 /web/wwwroot/test/abc/

----------

#### `fillUrl` 将 URL 补充完整

``` php
function fillUrl( $url, $baseUrl )
```

参数

* `url` URL
* `baseUrl` 基本 URL

返回

* 完整的 URL，如：
    URL 为 ./image/logo.png，
    基本 URL 为 http://www.baigo.net，
    补充完整后为 http://www.baigo.net/image/logo.png

----------

#### `fillImg` 将 HTML 内的图片 URL 补充完整

``` php
function fillImg( $content, $baseUrl )
```

参数

* `content` HTML 内容
* `baseUrl` 基本 URL

返回

* 图片具备完整的 URL 的 HTML 内容，如：
    HTML 为 &lt;div&gt;&lt;img src=&quot;./image/logo.png&quot;&gt;&lt;/div&gt;
    基本 URL 为 http://www.baigo.net，
    补充完整后为 &lt;div&gt;&lt;img src=&quot;http://www.baigo.net/image/logo.png&quot;&gt;&lt;/div&gt;

----------

#### `getRegex` 用正则表达式匹配字符串并获取搜索结果

`0.1.2` 新增

``` php
function getRegex( $string, $regex [, $wild = false] )
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

#### `checkRegex` 用正则表达式匹配字符串

``` php
function checkRegex( $string, $regex [, $wild = false] )
```

参数

* `string` 字符串
* `regex` 正则表达式
* `wild` 是否验证全文

返回

* 匹配结果（布尔值）

----------

#### `rand` 生成随机字符串

``` php
function rand( [$length = 32] )
```

参数

* `length` 长度

返回

* 随机字符串

----------

#### `arrayFilter` 过滤数组中的重复内容

``` php
function arrayFilter( $arr [, $pop_false = true] )
```

参数

* `arr` 数组
* `pop_false` 是否去除等值为 FALSE 的条目 `0.1.2` 新增

返回

* 过滤后的数组

----------

#### `arrayEach` 遍历数组，对键值进行安全过滤，并用指定的方式对键值进行编码

``` php
function arrayEach( $arr [, $encode = ''] )
```

参数

* `arr` 数组
* `encode` 编码方式

    可能的值

    | 值 | 描述 |
    | - | - |
    | 空（默认值） | 不进行编码 |
    | urlencode | URL 编码 |
    | json_safe | 用 JSON 安全的方法 URL 编码 |
    | md5 | md5 编码 |

返回

* 处理后的数组

----------

#### `ubbcode` 转换字符串

`0.1.1` 起升级至 `ginkgo/Ubbcode` 类

``` php
function ubbcode( $string )
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


----------

#### `strSecret` 隐藏敏感信息，用于敏感字符的隐藏，如手机号码：`139 **** 8888`

`0.1.1` 新增

``` php
function strSecret( $string [, $left = 5 [, $right = 5 [, $hide = '*' ]]] )
```

参数

* `string` 字符串
* `left` 保留左侧字符个数
* `right` 保留右侧字符个数
* `hide` 替代字符

返回

* 处理后的数组
