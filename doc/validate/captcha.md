## 验证码

验证规则支持对验证码进行验证，首先需要在表单中增加一个验证码域和验证码图片：

``` php
<input type="text" name="captcha">
<img src="http://server/index/index/verify" alt="captcha">
```

然后在验证规则中，添加 captcha 验证规则即可，例如：

``` php
namespace app\index\validate;

use ginkgo\Validate;

class User extends Validate {

    protected $rule = array(
        'email' => array(
            'format'  => 'email',
        ),
        'captcha' => array(
            'require' => true,
            'captcha'   => true,
        ),
    );

}
```

> 关于如何生成验证码图片，请查看 `杂项 -> 验证码` 章节