## 验证规则

验证规则的定义有两种方式，验证器内通常使用 `$rule` 属性定义，独立验证，则是通过 `rule()` 方法进行定义。

----------

#### 属性定义

属性定义方式仅限于验证器，通常使用如下方式：

``` php
namespace app\index\validate;

use ginkgo\Validate;

class User extends Validate {
  protected $rule = array(
    'name'  => array(
      'require' => true,
      'max'     => 25,
    ),
    'age'   => array(
      'between' => '1,120',
      'format'  => 'number',
    ),
    'email' => array(
      'format'  => 'email',
    ),
  );
}
```

系统内置了一些常用的验证规则，可以满足大部分需求，具体含义请查看 [内置规则](builtin.md)。

一个属性可以使用多个验证规则（如上面的 age 属性定义了 between 和 format 两个规则）。

----------

#### 方法定义

独立验证时（即手动调用验证类进行验证），使用 `rule()` 方法进行定义，如：

``` php
$validate = ginkgo\Validate::instance();

$name = array(
  'require' => true,
  'max'     => 25,
);

$validate->rule('name', $name);

$rule = array(
  'age'   => array(
    'between' => '1,120',
    'format'  => 'number',
  ),
  'email' => array(
    'format'  => 'email',
  ),
);

$validate->rule($rule);

$data = array(
  'name'  => 'ginkgo',
  'email' => 'ginkgo@ginkgo'
);

if (!$validate->verify($data)) {
  print_r($validate->getMessage());
}
```

`rule()` 方法说明

``` php
function rule( $rule [, $value = array()] )
```

参数

* `rule` 规则

  支持两种类型: 为字符串时表示规则名，为数组时表示批量设置规则

* `value` 规则值

  当 `rule` 为字符串时为必须，当 `rule` 为数组时自动忽略。
