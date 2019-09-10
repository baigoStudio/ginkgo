## JSON 处理

JSON 处理由 `ginkgo\Json` 类完成，全部为静态方法，如：

``` php
use ginkgo\Json;

$arr = array(
    'test'
    '123'
);

Json::encode($arr);
```
----------

#### `encode` 编码

``` php
function encode( $arr [, $encode = false] )
```

参数

* `arr` 数组
* `encode` 编码方式，对待编码的数组用指定的方式对键值进行编码

    可能的值

    | 值 | 描述 |
    | - | - |
    | 空（默认值） | 不进行编码 |
    | urlencode | URL 编码 |
    | json_safe | 用 JSON 安全的方法 URL 编码 |
    | md5 | md5 编码 |

返回

* JSON 编码后的字符串

----------

#### `decode` 解码

``` php
function decode( $json [, $assoc = true] )
```

参数

* `json` JSON 字符串
* `assoc` 是否返回 array
    当该参数为 true 时，将返回 array 否则为 object

返回

* array / object

----------

`getError` 日期时间字符串转时间戳

``` php
function getError()
```

返回

* 获取 JSON 处理时产生的错误消息

