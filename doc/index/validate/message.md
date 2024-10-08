## 消息定义

验证的错误消息需要结合多种方式，如果没有定义，则显示默认消息。

----------

#### 属性名定义

以下是一个实例

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

在需要进行验证的地方

``` php
$data = array(
  'name'  => 'ginkgo',
  'age'   => 121,
  'email' => 'ginkgo@ginkgo',
);

$validate = Loader::validate('User');

$result = $validate->verify($data);

if(!$result){
  echo end($validate->getMessage());
}
```

会输出

  age must between 1 - 120

可以给 age 属性设置中文名，例如：

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

  public function __construct() {
    $this->setAttrName('age', '年龄');
  }

}
```

会输出

  年龄 must between 1 - 120

`setAttrName()` 方法说明

``` php
function setAttrName( $attr [, $value = array()] )
```

参数

* `attr` 属性名

  支持两种类型: 为字符串时表示属性名，为数组时表示批量设置属性名

* `value` 属性值

  当 `attr` 为字符串时为必须，当 `attr` 为数组时自动忽略。

----------

#### 消息定义

继续上一个例子，可以给输出消息设置中文，例如：

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

  public function __construct() {
    $this->setAttrName('age', '年龄');
    $this->setTypeMsg('between', '{:attr} 只能在 {:rule} 之间');
  }

}
```

会输出

  年龄 只能在 1 - 120 之间

`setTypeMsg()` 方法说明

``` php
function setTypeMsg( $msg [, $value = array()] )
```

参数

* `msg` 消息

  支持两种类型: 为字符串时表示消息，为数组时表示批量设置消息

* `value` 消息值

  当 `msg` 为字符串时为必须，当 `msg` 为数组时自动忽略。

----------

#### 格式消息定义

另一个例子：

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

在需要进行验证的地方

``` php
$data = array(
  'name'  => 'ginkgo',
  'age'   => 111,
  'email' => 'ginkgo#ginkgo',
);

$validate = Loader::validate('User');

$result = $validate->verify($data);

if(!$result){
  echo end($validate->getMessage());
}
```

会输出

  email not a valid email address

可以给格式消息设置中文，例如：

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

  public function __construct() {
    $this->setAttrName('email', '邮箱');
    $this->setFormatMsg('email', '{:attr} 不是合法的 E-mail 地址');
  }

}
```

会输出

  邮箱 不是合法的 E-mail 地址

`setFormatMsg()` 方法说明

``` php
function setFormatMsg( $msg [, $value = array()] )
```

参数

* `msg` 消息

  支持两种类型: 为字符串时表示消息，为数组时表示批量设置消息

* `value` 消息值

  当 `msg` 为字符串时为必须，当 `msg` 为数组时自动忽略。

> 注意：`{:attr}` 和 `{:rule}` 这两个特殊标签会被 `属性名` 和 `规则` 分别替换。

----------

#### 获取验证消息

可以使用 `getMessage()` 方法获取，返回值是所有的错误消息数组，该方法没有参数。

----------

#### 规则消息定界符

`0.1.1` 新增

上述几个例子可能有开发者注意，当规则中包含逗号 <kbd>,</kbd> 时，输出消息时会被替换成连字符 <kbd>-</kbd>，如果想要替换成其他字符，可以通过 `ginkgo/Validate` 实例的 `$delimiter` 属性进行定义，默认为 <kbd>-</kbd>，如：

``` php
$obj_validate = new ginkgo/Validate();

$obj_validate->delimiter = ' - '
```
