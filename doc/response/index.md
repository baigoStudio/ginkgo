## 响应输出

多数情况下，不需要关注 `Response` 对象本身，只需要在控制器的动作中返回数据即可。例如：

``` php
namespace app\ctrl\index;

class Index {

    public function hello($name = 'baigo') {
        return 'Hello, ' . $name . '!';
    }

}
```

由于默认输出是 html，所以直接以 html 页面方式输出响应内容。

如果修改配置文件，设置：

``` php
// 默认输出类型
'var_default' => array(
    'return_type' => 'json',
),
```

则输出结果就变成了 JSON 字符串。

为了规范和清晰起见，推荐在控制器最后明确输出类型（毕竟一个确定的请求是有明确输出类型的）。

如果控制器继承了 `ginkgo\Ctrl` 类，可以直接调用如下方法指定输出类型：

| 输出类型 | 快捷方法 | 对应 Response 类 |
| - | - | - |
| HTML | fetch、display | ginkgo\Response |
| JSON | json | ginkgo\response\Json |
| JSONP | jsonp | ginkgo\response\Jsonp |
| 重定向 | redirect | ginkgo\response\Redirect |

每一种输出类型其实对应了一个不同的 `Response` 子类，也可以在应用中自定义 `Response` 子类满足特殊需求的输出。

例如需要输出一个 JSON 数据给客户端（或者 AJAX 请求），可以使用：

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;

class Index extends Ctrl {

    public function hello() {
        $data = array(
            'name'      => 'baigo',
            'status'    => '1'
        );
        
        return $this->json($data);
    }

}
```

这些方法的返回值都是 `Response` 类或者子类的实例，所以后续可以调用 `Response` 基类或者当前子类的相关方法，后面会讲解相关方法。

如果你只需要输出一个 html 格式的内容，可以直接使用

``` php
namespace app\ctrl\index;

class Index {

    public function hello() {
        return 'Hello, baigo!';
    }

}
```
