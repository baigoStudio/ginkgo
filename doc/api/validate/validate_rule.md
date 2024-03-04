## ginkgo\validate\Rule

验证规则抽象类，无法直接实例化

----------

### 类摘要

```php
namespace ginkgo;

abstract class Rule {
  // 属性
  protected static $instance;

  // 方法
  public static instance() : object
  public regex( mixed $value, string $rule ) : bool
  public filter( mixed $value, mixed $rule [, mixed $param = null ] ) : bool
  public leng( mixed $value, string $rule ) : bool
  public min( mixed $value, int $rule ) : bool
  public max( mixed $value, int $rule )
  public dateFormat( string $value, string $rule ) : bool
  public expire( mixed $value, mixed $rule ) : bool
  public after( mixed $value, mixed $rule ) : bool
  public before( mixed $value, mixed $rule ) : bool
  public in( mixed $value, string $rule ) : bool
  public notIn( mixed $value, string $rule ) : bool
  public between( int $value, string $rule ) : bool
  public notBetween( int $value, string $rule ) : bool
  public gt( int $value, int $rule ) : bool
  public lt( int $value, int $rule ) : bool
  public egt( int $value, int $rule ) : bool
  public elt( int $value, int $rule ) : bool
  public eq( mixed $value, mixed $rule ) : bool
  public neq( mixed $value, mixed $rule ) : bool
  public confirm( mixed $value, mixed $rule ) : bool
  public different( mixed $value, mixed $rule ) : bool

  protected __construct()
  protected __clone()
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$instance` | protected | object static | 本类实例 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [regex()](#regex()) | public | | 正则验证 |
| [filter()](#filter()) | public | | 利用 PHP 语言 [`filter_var()`](https://www.php.net/manual/zh/function.filter-var.php) 函数进行验证 |
| [leng()](#leng()) | public | | 验证长度 |
| [min()](#min()) | public | | 验证最小长度 |
| [max()](#max()) | public | | 验证最大长度 |
| [dateFormat()](#dateFormat()) | public | | 日期格式是否正确 |
| [expire()](#expire()) | public | | 是否在有效期内 |
| [after()](#after()) | public | | 是否晚于规定时间 |
| [before()](#before()) | public | | 是否早于规定时间 |
| [in()](#in()) | public | | 值是否在规定的选项内 |
| [notIn()](#notIn()) | public | | 值是否不在规定的选项内 |
| [between()](#between()) | public | | 值介于规定之间 |
| [notBetween()](#notBetween()) | public | | 值在规定之外 |
| [gt()](#gt()) | public | | 是否大于某个值 |
| [lt()](#lt()) | public | | 是否小于某个值 |
| [egt()](#egt()) | public | | 是否大于等于某个值 |
| [elt()](#elt()) | public | | 是否小于等于某个值 |
| [eq()](#eq()) | public | | 是否等于某个值 |
| [neq()](#eq()) | public | | 是否不等于某个值 |
| [confirm()](#confirm()) | public | | 比较值是否相同 |
| [different()](#different()) | public | | 比较值是否不同 |
| __construct() | protected | | 构造函数，无实际功能，仅供限制为单例模式使用 |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |

----------

<span id="instance()"></span>

#### `instance()` 实例化方法

``` php
public static function instance() : object
```

参数

* 无

返回

* 本类的实例

----------

<span id="regex()"></span>

#### `regex()` 正则验证

``` php
public function regex( mixed $value, string $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="filter()"></span>

#### `filter()` 利用 PHP 语言 [`filter_var`](https://www.php.net/manual/zh/function.filter-var.php) 函数进行验证

``` php
public function filter( mixed $value, mixed $rule [, mixed $param = null ] ) : bool
```

参数

* `value` 值
* `rule` 规则
* `param` 参数

返回

* 验证结果

----------

<span id="leng()"></span>

#### `leng()` 验证长度

``` php
public function len( mixed $value, string $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="min()"></span>

#### `min()` 验证最小长度

``` php
public function min( mixed $value, int $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="max()"></span>

#### `max()` 验证最大长度

``` php
public function max( mixed $value, int $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="dateFormat()"></span>

#### `dateFormat()` 日期格式是否正确

``` php
public function dateFormat( string $value, string $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="expire()"></span>

#### `expire()` 是否在有效期内

``` php
public function expire( mixed $value, mixed $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="after()"></span>

#### `after()` 是否晚于规定时间

``` php
public function after( mixed $value, mixed $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="before()"></span>

#### `before()` 是否早于规定时间

``` php
public function before( mixed $value, mixed $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="in()"></span>

#### `in()` 值是否在规定的选项内

``` php
public function in( mixed $value, string $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="notIn()"></span>

#### `notIn()` 值是否不在规定的选项内

``` php
public function notIn( mixed $value, string $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="between()"></span>

#### `between()` 值介于规定之间

``` php
public function between( int $value, string $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="notBetween()"></span>

#### `notBetween()` 值在规定之外

``` php
public function notBetween( int $value, string $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="gt()"></span>

#### `gt()` 是否大于某个值

``` php
public function gt( int $value, int $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="lt()"></span>

#### `lt()` 是否小于某个值

``` php
public function lt( int $value, int $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="egt()"></span>

#### `egt()` 是否大于等于某个值

``` php
public function egt( int $value, int $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="elt()"></span>

#### `elt()` 是否小于等于某个值

``` php
public function elt( int $value, int $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="eq()"></span>

#### `eq()` 是否等于某个值

``` php
public function eq( mixed $value, mixed $rule ) : bool
```
参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="neq()"></span>

#### `neq()` 是否不等于某个值

``` php
public function neq( mixed $value, mixed $rule ) : bool
```
参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="confirm()"></span>

#### `confirm()` 比较值是否相同

``` php
public function confirm( mixed $value, mixed $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="different()"></span>

#### `different()` 比较值是否不同

``` php
public function different( mixed $value, mixed $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果
