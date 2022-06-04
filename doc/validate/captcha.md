## 验证码

验证规则支持对验证码进行验证，首先需要在表单中增加一个验证码域和验证码图片：

``` php
<input type="text" name="captcha">
<img src="http://server/index.php/index/index/verify" alt="captcha">
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
      'captcha' => true,
    ),
  );

}
```

如果要指定验证码的 ID，直接在验证规则中指定即可，例如：

`0.1.2` 新增

``` php
namespace app\index\validate;

use ginkgo\Validate;

class User extends Validate {

  protected $rule = array(
    'captcha' => array(
      'require' => true,
      'captcha' => 'captcha_id',
    ),
  );

}
```

> 关于如何生成验证码图片，请查看 [杂项 -> 验证码](../misc/captcha.md)。
