## 重定向

如果控制器继承了 `ginkgo\Ctrl` 类，可以使用 `redirect` 方法进行重定向

``` php
namespace app\index\ctrl;

use ginkgo\Ctrl;

class Index extends Ctrl {

    public function hello() {
        return $this->redirect('http://www.baigo.net');
    }

}
```

----------

#### 重定向传参

如果是站内重定向，可以支持 URL 组装，有两种方式组装 URL，第一种是直接使用完整地址

``` php
$this->redirect('/index/index/hello/name/baigo');
```

这种方式会保持原来地址不做任何转换，第二种方式是使用 `params` 方法配合，例如：

``` php
$param = array(
    'name' => 'baigo'
);
$this->redirect('/index/index/hello')->param($param);
```

最终重定向的地址和前面的一样的

----------

#### 记住请求地址

在很多时候，重定向需要记住当前请求地址，便于跳转回来。此时可以使用 `remember` 方法记住重定向之前的地址。

下面是一个示例，第一次访问 `index` 动作的时候会重定向到 `hello` 动作并记住当前地址，动作完成后到 `restore` 方法，`restore` 方法则自动重定向到之前记住的请求地址，完成一次重定向的回归，回到原点！

``` php
namespace app\ctrl\index;

use ginkgo\Session;
use ginkgo\Ctrl;

class Index extends Ctrl {

    public function index() {
        // 判断session完成标记是否存在
        if (Session::get('complete')) {
            // 删除session
            Session::set('complete', null);
            return '重定向完成，回到原点!';
        } else {
            // 记住当前地址并重定向
            $redirect = $this->redirect('index/index/hello');
            $redirect->remember();
            
            return $redirect;
        }
    }

    public function hello() {
        $name = Session::get('name');
        return 'hello, ' . $name . '! <br><a href="/index/index/restore">点击回到来源地址</a>';
    }

    public function restore() {
        // 设置session标记完成
        Session::set('complete', true);
        // 跳回之前的来源地址
        return $this->redirect()->restore();
    }
    
}
```