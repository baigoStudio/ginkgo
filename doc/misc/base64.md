## Base64 处理

Base64 处理由 `ginkgo\Base64` 类完成，全部为静态方法，如：

``` php
use ginkgo\Base64;

$string = 'test';

Base64::encode($string);
```
----------

#### `encode` 编码

``` php
function encode( $string [, $url_safe = true] )
```

参数

* `string` 数组
* `url_safe` 是否已 URL 安全的方式编码

    说明

    由于默认 Base64 编码结果中有部分字符与 URL 字符冲突，当 `url_safe` 为 true 时，会将编码结果中的 <kbd>+</kbd> 替换为 <kbd>-</kbd>、<kbd>/</kbd> 替换为 <kbd>_</kbd>、<kbd>=</kbd> 将被剔除，以保证编码结果通过 URL 传递时的安全。

返回

* Base64 编码后的字符串

----------

#### `decode` 解码

``` php
function decode( $base64code [, $url_safe = true] )
```

参数

* `base64code` 数组
* `url_safe` 是否已 URL 安全的方式解码

    说明

    如果 `base64code` 是通过 URL 安全的方式进行编码的，那么必须采用 URL 安全的方式解码，否则将会出错。
    
返回

* Base64 解码后的字符串

