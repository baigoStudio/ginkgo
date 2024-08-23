## ginkgo\Sign

签名处理类，`0.3.2` 起支持数组，签名方法会对待签名的数组进行字典排序，`0.3.2` 起支持指定哈希方法

----------

### 类摘要

```php
namespace ginkgo;

class Sign {
  // 方法
  public static make( mixed $data [, string $salt [, $is_upper = true [, $func = '' ]]] ) : string
  public static check( mixed $data, $sign [, string $salt [, $is_upper = true [, $func = '' ]]] ) : bool
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 方法 | - | - | - |
| [make()](#make()) | public | static | 生成签名 |
| [check()](#check()) | public | static | 验证签名 |

----------

<span id="make()"></span>

#### `make()` 生成签名

``` php
public static function make( mixed $data [, string $salt [, $is_upper = true [, $func = '' ]]] ) : string
```

参数

* `data` 待签名数据 `0.3.2` 起支持数组
* `salt` 盐
* `is_upper` 是否大写
* `func` 哈希方法 `0.3.2` 新增

  可能的值 `md5`（默认）、`sha1`、`crypt`

返回

* 签名结果

----------

<span id="check()"></span>

#### `check()` 验证签名

``` php
public static function check( string $data, $sign [, string $salt [, $is_upper = true [, $func = '' ]]] ) : bool
```

参数

* `data` 待签名数据 `0.3.2` 起支持数组
* `sign` 待验证签名
* `salt` 盐
* `is_upper` 是否大写
* `func` 哈希方法 `0.3.2` 新增

  可能的值 `md5`（默认）、`sha1`、`crypt`

返回

* 布尔值
