## 加密

加密由 `ginkgo\Crypt` 类完成，全部为静态方法，如：

``` php
use ginkgo\Crypt;

$str = 'test';

Crypt::encrypt($str);
```
----------

#### `encrypt` 加密

``` php
function encrypt( $str, $key, $iv )
```

参数

* `str` 待加密字符串
* `key`
* `iv` 非 NULL 的初始化向量

返回

* 加密字符串

----------

#### `decrypt` 解密

``` php
function decrypt( $str, $key, $iv )
```

参数

* `str` 加密代码
* `key`
* `iv` 非 NULL 的初始化向量

返回

* 加密前字符串

----------

#### `crypt` 单向加密

加密结果无法解密

``` php
function crypt( $str, $salt, $is_md5 )
```

参数

* `str` 待加密字符串
* `salt` 盐
* `is_md5` 待加密字符串是否已经 md5 加密

返回

* 加密字符串

