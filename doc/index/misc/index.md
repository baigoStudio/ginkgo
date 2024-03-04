## 常用函数

常用函数功能由 `ginkgo\Func` 类完成，全部为静态方法，如：

``` php
use ginkgo\Func;

$str = 'test';

Func::isEmpty($str);
```

----------

#### `isEmpty()` 是否为空

``` php
function isEmpty( $data )
```

参数

* `data` 数据

返回

* true / false

----------

#### `isOdd()` 是否为奇数

``` php
function isOdd( $num )
```

参数

* `num` 数值

返回

* true / false

----------

#### `safe()` 安全过滤字符串

``` php
function safe( $str [, $htmlmode = false ] )
```

参数

* `str` 字符串

返回

* 过滤后的字符串

----------

#### `fixDs()` 规范化路径分隔符，并在最后添加分隔符

``` php
function fixDs( $path [, $ds = DS ] )
```

参数

* `path` 路径
* `ds` 路径分隔符

返回

* 格式化后的路径，如：/web/wwwroot//test/abc 转换为 /web/wwwroot/test/abc/

----------

#### `fillUrl()` 将 URL 补充完整

``` php
function fillUrl( $url, $baseUrl )
```

参数

* `url` URL
* `baseUrl` 基本 URL

返回

* 完整的 URL，如：

  URL 为 ./image/logo.png，
  基本 URL 为 https://www.baigo.net，
  补充完整后为 https://www.baigo.net/image/logo.png

----------

#### `getRegex()` 用正则表达式匹配字符串并获取搜索结果

`0.1.2` 新增

``` php
function getRegex( $string, $regex [, $wild = false ] )
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

#### `checkRegex()` 用正则表达式匹配字符串

``` php
function checkRegex( $string, $regex [, $wild = false ] )
```

参数

* `string` 字符串
* `regex` 正则表达式
* `wild` 是否验证全文

返回

* 匹配结果（布尔值）

----------

#### `rand()` 生成随机字符串

``` php
function rand( [ $length = 32 ] )
```

参数

* `length` 长度

返回

* 随机字符串

----------

#### `strtotime()` 日期时间字符串转时间戳

`0.2.0` 起迁移至 [`ginkgo/Strings`](../data/strings.md#toTime) 类，并将逐步弃用

----------

#### `ucwords()` 将字符串中每个单词的首字母转换为大写

`0.2.0` 起迁移至 [`ginkgo/Strings`](../data/strings.md#ucwords) 类，并将逐步弃用

----------

#### `toHump()` 以指定的分隔符将字符串转换为驼峰写法

`0.2.0` 起迁移至 [`ginkgo/Strings`](../data/strings.md#toHump) 类，并将逐步弃用

----------

#### `toLine()` 将驼峰写法的字符串转换为小写加分隔符

`0.2.0` 起迁移至 [`ginkgo/Strings`](../data/strings.md#toLine) 类，并将逐步弃用

----------

#### `sizeFormat()` 文件大小格式化

`0.2.0` 起迁移至 [`ginkgo/Strings`](../data/strings.md#sizeFormat) 类，并将逐步弃用

----------

#### `numFormat()` 格式化数字

`0.2.0` 起迁移至 [`ginkgo/Strings`](../data/strings.md#numFormat) 类，并将逐步弃用

----------

#### `strSecret()` 隐藏敏感信息，用于敏感字符的隐藏，如手机号码：`139 **** 8888`

`0.1.1` 新增
`0.2.0` 起迁移至 [`ginkgo/Strings`](../data/strings.md#secrecy) 类，并将逐步弃用

----------

#### `fillImg()` 将 HTML 内的图片 URL 补充完整

`0.2.0` 起迁移至 [`ginkgo/Html`](../data/html.md#fillImg) 类，并将逐步弃用

----------

#### `arrayFilter()` 过滤数组中的重复内容

`0.2.0` 起迁移至 [`ginkgo/Arrays`](../data/arrays.md#filter) 类，并将逐步弃用

----------

#### `arrayEach()` 遍历数组，对键值进行安全过滤，并用指定的方式对键值进行编码

`0.2.0` 起迁移至 [`ginkgo/Arrays`](../data/arrays.md#each) 类，并将逐步弃用

----------

#### `ubbcode()` 转换字符串

`0.1.1` 起迁移至 [`ginkgo/Ubbcode`](../data/ubbcode.md) 类，已弃用

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
