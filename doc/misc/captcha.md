## 验证码

验证码功能由 `ginkgo\Captcha` 完成。

----------

#### 生成验证码

在控制器中使用下面的代码进行验证码生成：

``` php
namespace app\index\ctrl;

use ginkgo\Captcha;

class Index {

	public function verify() {
        $captcha = Captcha::instance();
        $captcha->set();
        return $captcha->create();
    }

}
```

访问下如下地址就可以显示验证码

> http://server/index.php/index/index/verify

在模板中可以使用如下代码显示验证码

``` markup
<div><img src="http://server/index.php/index/index/verify" alt="captcha"></div>
```

如果要在一个页面中生成多个验证码，`create` 方法可以传入标识信息（数字或字符串），例如：

``` php
namespace app\index\ctrl;

use ginkgo\Captcha;

class Index {

	public function verify() {
        $captcha = Captcha::instance();
        $captcha->set();
        return $captcha->create(1);
    }

}
```

可以用 `Captcha` 类的 `check` 方法检测验证码是否正确

``` php
if (!$captcha->check($value)) {
    // 验证失败
}
```

如果页面上同时生成了多个验证码，则可以使用

``` php
$value 为用户输入的验证码，$id 为验证码标识

if (!$captcha->check($value, $id)) {
    // 验证失败
}
```

----------

#### 验证码的配置参数

`Captcha` 类带有默认的配置参数，支持自定义配置。这些参数包括：

| 参数 | 描述 | 默认 |
| - | - | - |
| length | 长度 | 4 |
| expire | 过期时间 | 1800 |
| font_file | 字体路径 | 空 随机从字体文件夹读取 |
| font_size | 字号 | 20 |
| width | 图片宽度 | 0 为自动计算 |
| height | 图片高度 | 0 为自动计算 |
| reset | 验证成功后是否重置 | true |
| noise | 是否加入干扰 | true |

* 实例化传入参数：

    ``` php
    $config = array(
        'font_size' => 30, // 验证码字体大小
        'length'    => 3, // 验证码位数
        'noise'     => false, // 关闭验证码杂点
    );
    $captcha = Captcha::instance($config);
    ```

* 验证码字体

    默认情况下，验证码的字体是随机使用 `ginkgo/captcha/font` 目录下面的字体文件，我们可以指定验证码的字体，例如：

    ``` php
    $config = array(
        'font_file' => GK_PATH_CORE . 'captcha/font/5.ttf', // 验证码字体路径
    );
    $captcha = Captcha::instance($config);
    ```
