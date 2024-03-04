## ginkgo\Sign

签名处理类

----------

### 类摘要

```php
namespace ginkgo;

class Sign {
  // 方法
  public static make( string $string [, string $salt [, $is_upper = true ]] ) : string
  public static check( string $string, $sign [, string $salt [, $is_upper = true ]] ) : bool
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
public static function make( string $string [, string $salt [, $is_upper = true ]] ) : string
```

参数

* `string` 待签名字符
* `salt` 盐
* `is_upper` 是否大写

返回

* 签名结果

----------

<span id="check()"></span>

#### `check()` 验证签名

``` php
public static function check( string $string, $sign [, string $salt [, $is_upper = true ]] ) : bool
```

参数

* `string` 待签名字符
* `sign` 待验证签名
* `salt` 盐
* `is_upper` 是否大写

返回

* 布尔值
