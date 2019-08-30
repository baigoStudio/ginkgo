## 签名

签名由 `ginkgo\Sign` 类完成，全部为静态方法，如：

``` php
use ginkgo\Sign;

$str = '{["test","123"]}';

Sign::make($str);
```
----------

#### `make` 生成签名

``` php
function make( $str [, $salt = ''] )
```

参数

* `str` 待签名字符串
* `salt` 盐

返回

* 签名字符串

----------

#### `check` 验证签名

``` php
function check( $str, $sign [, $salt = ''] )
```

参数

* `str` 待签名字符串
* `sign` 签名字符串
* `salt` 盐

返回

* true / false

