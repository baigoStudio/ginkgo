## 验证器

验证器是最推荐的方式，为具体的验证场景或者数据定义好验证器类，直接调用验证类的 `verify` 方法即可完成验证，下面是一个例子：

我们定义一个 `app\validate\index\User` 验证器类用于 User 的验证，验证器必须继承验证类 `ginkgo\Validate`。

``` php
namespace app\validate\index;

use ginkgo\Validate;

class User extends Validate {

    protected $rule = array(
        'user_id' => array(
            'require' => true,
            'format'  => 'int',
        ),
        'user_name' => array(
            'length' => '1,30',
            'format' => 'alpha_dash',
        ),
    );

}
```

在需要进行 `User` 验证的地方，添加如下代码即可：

``` php
$data = array(
    'name'  => 'baigo',
    'email' => 'baigo@qq.com'
);

$validate = Loader::validate('User');

if(!$validate->verify($data)){
    print_r($validate->getMessage());
}
```

验证类 `ginkgo\Validate` 内置了如下类的实例：
 
``` php
class Validate {
    // ginkgo\Lang 的实例
    protected $obj_lang;
}
```

----------

#### 验证器初始化

验证器同样支持初始化，与控制器的初始化类似，可以定义验证器初始化方法 `v_init`，具体如下

``` php
namespace app\validate\index;

use ginkgo\Validate;

class Index extends Validate {

    //自定义初始化
    function v_init() {

    }
}
```

----------

#### 分层验证器

ginkgo 支持验证器的分层，其分层方式与 `分层控制器` 类似。

在控制器中实例化验证器时，系统会默认实例化当前模块层的验证器。例如 index 模块下的 User 控制器中实例化某个验证器：

``` php
namespace app\ctrl\index;

use ginkgo\Loader;

class User {
    function __construct() { //构造函数
        $this->vld_user = Loader::validate('User');
    }
}
```

验证器的实际位置

> app\validate\index\user.vld.php

定义如下

``` php
namespace app\validate\index;

use ginkgo\Validate;

class User extends Validate {
}
```

还可以定义分层验证器。

例如，定义 index 模块 event 层下的 Blog 验证器如下：

``` php
namespace app\validate\index\event;

use ginkgo\Validate;

class Blog extends Validate {

}
```

验证器的实际位置是

> app/validate/index/event/blog.vld.php

定义完成后，就可以用下面的方式实例化验证器了：

``` php
use ginkgo\Loader

$event = Loader::validate('Blog', 'event');
```
----------

#### 跨模块调用

验证器支持跨模块调用，例如：

``` php
use ginkgo\Loader

$event = Loader::validate('Blog', '', 'admin');
```

验证器的实际位置是

> app/validate/admin/blog.vld.php

表示实例化 admin 模块的 Blog 验证器类

``` php
use ginkgo\Loader

$event = Loader::validate('Blog', 'event', 'admin');
```

验证器的实际位置是

> app/validate/admin/event/blog.vld.php