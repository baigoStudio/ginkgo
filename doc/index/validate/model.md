## 模型验证

如果需要在模型中进行验证，可以调用模型类提供的 `validate()` 方法进行验证，如：

``` php
$data = array(
  'name'  => 'ginkgo',
  'email' => 'ginkgo@ginkgo',
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

如果定义了验证器的话，例如：

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

模型中的验证代码可以简化为：

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

如果模型和验证器位于同一模块，且同名，还可以进一步简化：

``` php
namespace app\ctrl\index;

use ginkgo\Model;
use ginkgo\Loader;

class User extends Model {

  function edit() {
    $result = $this->validate($data);

    if($result !== true){
      // 验证失败 输出错误信息
      print_r($result);
    }
  }

}
```

如果要使用场景：

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
