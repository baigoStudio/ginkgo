## 数组

数组处理功能由 `ginkgo\Arrays` 类完成，大部分为原 `ginkgo\Func` 类迁移而来，全部为静态方法，如：

`0.2.0` 新增

``` php
use ginkgo\Arrays;

$arr = array(1, 2, 3, 4);

Arrays::toJson($arr);
```

----------

<span id="filter"></span>

#### `filter()` 过滤数组中的重复内容

``` php
function filter( $arr [, $pop_false = true ] )
```

参数

* `arr` 数组
* `pop_false` 是否去除等值为 FALSE 的条目

返回

* 过滤后的数组

----------

<span id="each"></span>

#### `each()` 遍历数组，对键值进行安全过滤，并用指定的方式对键值进行编码

``` php
function each( $arr [, $encode = '' ] )
```

参数

* `arr` 数组
* `encode` 编码方式

    可能的值

    | 值 | 描述 |
    | - | - |
    | 空（默认值） | 不进行编码 |
    | urlencode | URL 编码 |
    | json_safe | 用 JSON 安全的 URL 编码 |
    | md5 | md5 编码 |

返回

* 处理后的数组

----------

<span id="toJson"></span>

#### `toJson()` 转换为 JSON

``` php
function toJson( $arr [, $encode = false ] )
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

<span id="fromJson"></span>

#### `fromJson()` JSON 转化为数组

``` php
function fromJson( $json [, $assoc = true ] )
```

参数

* `json` JSON 字符串
* `assoc` 是否返回 array
    当该参数为 true 时，将返回 array 否则为 object

返回

* array / object


----------

<span id="getError"></span>

#### `getError()` 获取错误

``` php
function getError()
```

返回

* 获取数组处理时产生的错误消息
