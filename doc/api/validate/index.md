## ginkgo\Validate

验证

----------

### 类摘要

```php
namespace ginkgo;

class Validate {
  // 属性
  public $config    = array();
  public $delimiter = ' - ';

  protected static $instance;
  protected $obj_lang;
  protected $obj_rule;
  protected $rule         = array();
  protected $data         = array();
  protected $attrName     = array();
  protected $scene        = array();
  protected $only         = array();
  protected $remove       = array();
  protected $append       = array();
  protected $currentScene = null;

  protected $typeMsg = array(
    'require'           => '{:attr} require',
    'confirm'           => '{:attr} out of accord with {:confirm}',
    'different'         => '{:attr} cannot be same with {:different}',
    'accepted'          => '{:attr} must be yes, on or 1',
    'in'                => '{:attr} must be in {:rule}',
    'not_in'            => '{:attr} be notin {:rule}',
    'between'           => '{:attr} must between {:rule}',
    'not_between'       => '{:attr} cannot between {:rule}',
    'length'            => 'Size of {:attr} must be {:rule}',
    'min'               => 'Min size of {:attr} must be {:rule}',
    'max'               => 'Max size of {:attr} must be {:rule}',
    'after'             => '{:attr} cannot be less than {:rule}',
    'before'            => '{:attr} cannot exceed {:rule}',
    'expire'            => '{:attr} not within {:rule}',
    'egt'               => '{:attr} must greater than or equal {:rule}',
    'gt'                => '{:attr} must greater than {:rule}',
    'elt'               => '{:attr} must less than or equal {:rule}',
    'lt'                => '{:attr} must less than {:rule}',
    'eq'                => '{:attr} must equal {:rule}',
    'neq'               => '{:attr} cannot be same with {:rule}',
    'filter'            => '{:attr} not conform to the rules',
    'regex'             => '{:attr} not conform to the rules',
    'format'            => '{:attr} not conform format of {:rule}',
    'date_format'       => '{:attr} must be date format of {:rule}',
    'time_format'       => '{:attr} must be time format of {:rule}',
    'date_time_format'  => '{:attr} must be datetime format of {:rule}',
    'token'             => 'Form token is incorrect',
    'captcha'           => 'Captcha is incorrect',
  );

  protected $formatMsg = array(
    'number'            => '{:attr} must be numeric',
    'int'               => '{:attr} must be integer',
    'float'             => '{:attr} must be float',
    'bool'              => '{:attr} must be bool',
    'email'             => '{:attr} not a valid email address',
    'array'             => '{:attr} must be a array',
    'date'              => '{:attr} not a valid date',
    'time'              => '{:attr} not a valid time',
    'date_time'         => '{:attr} not a valid datetime',
    'alpha'             => '{:attr} must be alpha',
    'alpha_number'      => '{:attr} must be alpha-numeric',
    'alpha_dash'        => '{:attr} must be alpha-numeric, dash, underscore',
    'chs'               => '{:attr} must be chinese',
    'chs_alpha'         => '{:attr} must be chinese or alpha',
    'chs_alpha_number'  => '{:attr} must be chinese, alpha-numeric',
    'chs_dash'          => '{:attr} must be chinese, alpha-numeric, underscore, dash',
    'url'               => '{:attr} not a valid url',
    'ip'                => '{:attr} not a valid ip',
  );

  private $configThis     = array(
    'rule_class' => 'ginkgo',
  );

  private $message        = array();

  private $alias = array(
    '>'         => 'gt',
    '>='        => 'egt',
    '<'         => 'lt',
    '<='        => 'elt',
    '='         => 'eq',
    'same'      => 'eq',
    '!='        => 'neq',
    '<>'        => 'neq',
  );

  // 方法
  public static instance( [ array $config ] ) : object
  public v_init( [ array $param ] )
  public config( array $config )
  public rule( mixed $rule [, string $value ] )
  public setScene( mixed $scene [, array $value ] )
  public setTypeMsg( mixed $msg [, string $value ] )
  public setFormatMsg( mixed $msg [, string $value ] )
  public setAttrName( mixed $attr [, string $value ] )
  public verify( array $data ) : bool
  public scene( string $scene )
  public only( mixed $field )
  public remove( mixed $field )
  public append( mixed $field [, string $rule ] )
  public is( mixed $value, string $rule ) : bool
  public getMessage() : array
  public __call( string $method, string $params ) : mixed

  protected __construct( [ array $config ] ) : object
  protected __clone()

  private token( string $value [, string $rule = '__token__'] ) : bool
  private captcha( string $value [, string $id ] ) : bool
  private check( mixed $value, string $rule [, mixed $key ] ) : int
  private checkItem( mixed $value, string $rule [, mixed $key ] ) : bool
  private parseRule( mixed $value, string $rule [, mixed $key ] ) : array
  private getRule() : array
  private getRuleDate( string $rule ) : string
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array | 配置 |
| `$delimiter` | public | string | 范围符号 |
| `$instance` | protected | object static | 本类实例 |
| [`$obj_lang`](../lang/index.md) | protected | object | 语言实例 |
| [`$obj_rule`](validate_rule_gk.md) | protected | object | 规则实例 |
| `$rule` | protected | array | 验证规则 |
| `$data` | protected | array | 待验证数据 |
| `$attrName` | protected | array | 验证属性名称 |
| `$scene` | protected | array | 场景 |
| `$only` | protected | array | 仅验证指定字段 |
| `$remove` | protected | array | 移除规则 |
| `$append` | protected | array | 追加规则 |
| `$currentScene` | protected | string | 当前场景 |
| `$typeMsg` | protected | array | 验证类型消息 |
| `$formatMsg` | protected | array | 验证格式消息 |
| [`$configThis`](#$config) | private | array | 默认图片 MIME |
| `$message` | protected | array | 验证消息 |
| `$alias` | protected | array | 验证类型别名 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [v_init()](#v_init()) | public | | 验证器初始化 |
| [config()](#config()) | public | | 配置 |
| [rule()](#rule()) | public | | 设置规则 |
| [setScene()](#setScene()) | public | | 设置场景 |
| [setTypeMsg()](#setTypeMsg()) | public | | 设置验证类型消息 |
| [setFormatMsg()](#setFormatMsg()) | public | | 设置验证格式消息 |
| [setAttrName()](#setAttrName()) | public | | 设置验证属性名称 |
| [verify()](#verify()) | public | | 验证 |
| [scene()](#scene()) | public | | 设置当前场景 |
| [only()](#only()) | public | | 设置仅验证字段 |
| [remove()](#remove()) | public | | 设置移除规则 |
| [append()](#append()) | public | | 设置追加规则 |
| [is()](#is()) | public | | 直接验证格式 |
| [getMessage()](#getMessage()) | public | | 获取验证消息 |
| [__call()](#__call()) | public | | 魔术方法，用于直接验证 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [token()](#token()) | private | | 验证表单令牌 |
| [captcha()](#captcha()) | private | | 验证码 |
| [check()](#check()) | private | | 验证 |
| [checkItem()](#checkItem()) | private | | 逐个验证 |
| [parseRule()](#parseRule()) | private | | 解析规则 |
| [getRule()](#getRule()) | private | | 获取规则 |
| [getRuleDate()](#getRuleDate()) | private | | 获取日期规则 |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

``` php
public $config;
private $configThis;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| rule_class | string | ginkgo | 验证规则类 |

----------

<span id="instance()"></span>

#### `instance()` 实例化方法

``` php
public static function instance( [ array $config ] ) : object
```

参数

* [`config`](#$config) 配置参数

返回

* 本类的实例

----------

<span id="v_init()"></span>

#### `v_init()` 验证器初始化

``` php
public function v_init( [ array $param ] )
```

参数

* `param` 参数

返回

* 无

----------

<span id="config()"></span>

#### `config()` 配置

``` php
public function config( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="rule()"></span>

#### `rule()` 设置规则

``` php
public function rule( mixed $rule [, string $value ] )
```

参数

* `rule` 规则

  为字符串时表示属性，为数组时表示批量设置

* `value` 规则值

  当 `rule` 为字符串时为必须，当 `rule` 为数组时自动忽略

返回

* 无

----------

<span id="setScene()"></span>

#### `setScene()` 设置场景

``` php
public function setScene( mixed $scene [, array $value ] )
```

参数

* `scene` 规则

  为字符串时表示场景名，为数组时表示批量设置

* `value` 该场景要验证的属性

  当 `scene` 为字符串时为必须，当 `scene` 为数组时自动忽略

返回

* 无

----------

<span id="setTypeMsg()"></span>

#### `setTypeMsg()` 设置验证类型消息

``` php
public function setTypeMsg( mixed $msg [, string $value ] )
```

参数

* `msg` 消息

  为字符串时表示验证类型名，为数组时表示批量设置

* `value` 消息内容

  当 `msg` 为字符串时为必须，当 `msg` 为数组时自动忽略

返回

* 无

----------

<span id="setFormatMsg()"></span>

#### `setFormatMsg()` 设置验证格式消息

``` php
public function setFormatMsg( mixed $msg [, string $value ] )
```

参数

* `msg` 消息

  为字符串时表示验证格式名，为数组时表示批量设置

* `value` 消息内容

  当 `msg` 为字符串时为必须，当 `msg` 为数组时自动忽略

返回

* 无

----------

<span id="setAttrName()"></span>

#### `setAttrName()` 设置验证属性名称

``` php
public function setAttrName( mixed $attr [, string $value ] )
```

参数

* `attr` 属性

  为字符串时表示验证属性名，为数组时表示批量设置

* `value` 消息内容

  当 `attr` 为字符串时为必须，当 `attr` 为数组时自动忽略

返回

* 无

----------

<span id="verify()"></span>

#### `verify()` 验证

``` php
public function verify( array $data ) : bool
```

参数

* `data` 待验证数据

返回

* 布尔值

----------

<span id="scene()"></span>

#### `scene()` 设置当前场景

``` php
public function scene( string $scene )
```

参数

* `scene` 当前场景

返回

* 无

----------

<span id="only()"></span>

#### `only()` 设置仅验证字段

``` php
public function only( mixed $field )
```

参数

* `field` 字段，为数组时表示批量设置

返回

* 无

----------

<span id="remove()"></span>

#### `remove()` 设置移除规则

``` php
public function remove( mixed $field )
```

参数

* `field` 字段，为数组时表示批量设置

返回

* 无

----------

<span id="append()"></span>

#### `append()` 设置追加规则

``` php
public function append( mixed $field )
```

参数

* `field` 字段，为数组时表示批量设置

返回

* 无

----------

<span id="is()"></span>

#### `is()` 直接验证格式

``` php
public function is( mixed $value, string $rule ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="getMessage()"></span>

#### `getMessage()` 获取验证消息

``` php
public function getMessage() : array
```

参数

* 无

返回

* 验证结果消息

----------

<span id="__call()"></span>

#### `__call()` 魔术方法，用于直接验证

``` php
public function __call( string $method, string $params ) : mixed
```

参数

* `method` 方法
* `params` 参数

返回

* 验证结果

----------

<span id="token()"></span>

#### `token()` 验证表单令牌

``` php
private function token( string $value [, string $rule = '__token__'] ) : bool
```

参数

* `value` 值
* `rule` 规则

返回

* 验证结果

----------

<span id="captcha()"></span>

#### `captcha()` 验证码

``` php
private function captcha( string $value [, string $id ] ) : bool
```

参数

* `value` 值
* `id` 验证码 ID

返回

* 验证结果

----------

<span id="check()"></span>

#### `check()` 验证

``` php
private function check( mixed $value, string $rule [, mixed $key ] ) : int
```

参数

* `value` 值
* `rule` 规则
* `key` 键名

返回

* 错误数

----------

<span id="checkItem()"></span>

#### `checkItem()` 逐个验证

``` php
private function checkItem( mixed $value, string $rule [, mixed $key ] ) : bool
```

参数

* `value` 值
* `rule` 规则
* `key` 键名

返回

* 验证结果

----------

<span id="parseRule()"></span>

#### `parseRule()` 解析规则

``` php
private function parseRule( mixed $value, string $rule [, mixed $key ] ) : array
```

参数

* `value` 值
* `rule` 规则
* `key` 键名

返回

* 规则

----------

<span id="getRule()"></span>

#### `getRule()` 获取规则

``` php
private function getRule() : array
```

参数

* 无

返回

* 规则

----------

<span id="getRuleDate()"></span>

#### `getRuleDate()` 获取日期规则

``` php
private function getRuleDate( string $rule ) : string
```

参数

* `rule` 规则类型

返回

* 日期规则
