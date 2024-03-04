## 加密

加密由 `ginkgo\Crypt` 类完成，全部为静态方法，如：

``` php
use ginkgo\Crypt;

$str = 'test';

Crypt::encrypt($str);
```
----------

#### 公钥

ginkgo 安装以后，会自动生成一个公钥文件，默认位于：

> ./runtime/data/`GK_APP_HASH`/key_pub.inc.php

假如您用到此类加密一些数据，在迁移时必须同时迁移这个文件，否则会导致解密失败或者无法验证。

----------

#### `crypt()` 单向加密

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

----------

#### `encrypt()` 加密

``` php
function encrypt( $str, $key, $iv )
```

参数

* `str` 待加密字符串
* `key`
* `iv` 非 NULL 的初始化向量

返回

* 加密字符串 / false

----------

#### `decrypt()` 解密

``` php
function decrypt( $str, $key, $iv )
```

参数

* `str` 加密代码
* `key`
* `iv` 非 NULL 的初始化向量

返回

* 解密字符串 / false

----------

#### `getError()` 获取错误消息

当 `encrypt` 或 `decrypt` 发生错误时，返回 false，此时可以通过本函数获取详细的错误信息。

``` php
function getError()
```

参数

* 无

返回

* 错误消息
