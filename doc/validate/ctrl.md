## 控制器验证

如果需要在控制器中进行验证，且继承了 `ginkgo\Ctrl` 类，可以调用控制器类提供的 `validate()` 方法进行验证，如：

``` php
$data = array(
    'name'  => 'baigo',
    'email' => 'baigo@qq.com',
);

$rule = array(
    'name'  => array(
        'require' => true,
        'max'     => 25,
    ),
    'email' => array(
        'format'  => 'email',
    ),
);

$result = $this->validate($data, $rule);

if($result !== true){
    // 验证失败 输出错误信息
    print_r($result);
}
```

如果定义了验证器，例如：

``` php
namespace app\index\validate;

use ginkgo\Validate;

class User extends Validate {
    protected $rule = array(
        'name'  => array(
            'require' => true,
            'max'     => 25,
        ),
        'email' => array(
            'format'  => 'email',
        ),
    );

    protected $scene = array(
        'add'   =>  array(
            'name',
            'email',
        ),
        'edit'  =>  array(
            'email'
        ),
    );
}
```

控制器中的验证代码可以简化为：

``` php
$result = $this->validate($data, 'user');

if($result !== true){
    // 验证失败 输出错误信息
    print_r($result);
}
```

如果要使用场景，可以使用：

``` php
$result = $this->validate($data, 'user', 'edit');

if($result !== true){
    // 验证失败 输出错误信息
    print_r($result);
}
```

如果控制器和验证器位于同一模块，且同名，同时动作名与场景名相同，还可以进一步简化：

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;
use ginkgo\Loader;

class User extends Ctrl {

    function edit() {
        $result = $this->validate($data);

        if($result !== true){
            // 验证失败 输出错误信息
            print_r($result);
        }
    }

}
```

如果要指定场景：

``` php
namespace app\ctrl\index;

use ginkgo\Loader;

class User {

    function edit() {
        $result = $this->validate($data, '', 'edit');

        if($result !== true){
            // 验证失败 输出错误信息
            print_r($result);
        }
    }

}
```

如果不使用场景：

``` php
namespace app\ctrl\index;

use ginkgo\Loader;

class User {

    function edit() {
        $result = $this->validate($data, '', false);

        if($result !== true){
            // 验证失败 输出错误信息
            print_r($result);
        }
    }

}
```
