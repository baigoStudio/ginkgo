## 表单令牌

验证规则支持对表单的令牌进行验证，首先需要在表单中增加一个隐藏域：

``` php
<input type="hidden" name="__token__" value="<?php echo $request->token(); ?>">
```

然后在验证规则中，添加 token 验证规则即可，例如：

``` php
namespace app\index\validate;

use ginkgo\Validate;

class User extends Validate {

    protected $rule = array(
        'email' => array(
            'format'  => 'email',
        ),
        '__token__' => array(
            'require' => true,
            'token'   => true,
        ),
    );

}
```

如果令牌名称不是 `__token__`，则表单需要改为：

``` php
<input type="hidden" name="__hash__" value="<?php echo $request->token(); ?>">
```

验证器中改为：

``` php
namespace app\index\validate;

use ginkgo\Validate;

class User extends Validate {

    protected $rule = array(
        'email' => array(
            'format'  => 'email',
        ),
        '__hash__' => array(
            'require' => true,
            'token'   => true,
        ),
    );

}
```

如果需要自定义令牌生成规则，可以调用 `Request` 类的 `token` 方法，例如：

``` php
namespace app\index\ctrl;

use ginkgo\Ctrl;

class Index extends Ctrl {

    public function index() {
        $token = $this->obj_request->token('__token__', 'sha1');
        $this->assign('token', $token);
        return $this->fetch();
    }

}
```

然后在模板表单中使用：


``` php
<input type="hidden" name="__token__" value="<?php echo $token; ?>">
```
