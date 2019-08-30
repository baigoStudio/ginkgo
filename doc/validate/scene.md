## 验证场景

验证器支持定义场景，便于验证不同场景下的数据。

----------

#### 属性定义

通常使用如下方式：

``` php
namespace app\index\validate;

use ginkgo\Validate;

class User extends Validate {

    protected $rule = array(
        'user_name' => array(
            'length' => '1,30',
            'format' => 'alpha_dash',
        ),
        'user_mail' => array(
            'max'    => 300,
            'format' => 'email',
        ),
        'user_ids' => array(
            'require' => true,
        ),
        'act' => array(
            'require' => true,
        ),
    );

    protected $scene = array(
        'submit' => array(
            'user_name',
            'user_mail',
        ),
        'status' => array(
            'user_ids',
            'act',
        ),
        'delete' => array(
            'user_ids',
        ),
    );

}
```

----------

#### 方法定义

使用 `setScene` 方法定义场景，如

``` php
class User extends Validate {

    protected $rule = array(
        'user_name' => array(
            'length' => '1,30',
            'format' => 'alpha_dash',
        ),
        'user_mail' => array(
            'max'    => 300,
            'format' => 'email',
        ),
        'user_ids' => array(
            'require' => true,
        ),
        'act' => array(
            'require' => true,
        ),
    );


    function __construct() { //构造函数
        $scene = array(
            'submit' => array(
                'user_name',
                'user_mail',
            ),
            'status' => array(
                'user_ids',
                'act',
            ),
            'delete' => array(
                'user_ids',
            ),
        );

        $this->setScene($scene);
    }
    
}
```

`setScene` 方法说明

``` php
function setScene( $scene [, $value = array()] )
```

参数

* `scene` 场景

    支持两种类型

    字符串：场景名
    
    数组：批量设置场景

* `value` 场景值

    当 `scene` 为字符串时为必须，当 `scene` 为数组时自动忽略。
    
----------

#### 场景调用方法

在需要进行验证的地方调用 `scene` 方法

``` php
$data = array(
    'user_name'  => 'ginkgo',
    'user_mail'  => 121,
);

$validate = Loader::validate('User');

$result = $validate->scene('submit')->verify($data);

if(!$result){
    print_r($validate->getMessage());
}
```

验证场景还可配合多个方法使用，说明如下：

| 方法名 | 描述 |
| - | - |
| scene | 使用场景 |
| only | 需要验证的字段 |
| remove | 移除验证规则 |
| append | 追加验证规则 |

> 注意：所有方法均支持链式操作，优先级为 only &gt; remove &gt; append

