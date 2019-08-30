## 控制器初始化

如果控制器继承了 `ginkgo\Ctrl` 类，不建议定义构造函数 `__construct`，开发者可以定义控制器初始化方法 `c_init`，该方法类似于的构造函数。

例如：

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;

class Index extends Ctrl {

    public function c_init() {
        echo 'init<br>';
    }
    
    public function hello() {
        return 'hello';
    }
    
    public function data() {
        return 'data';
    }
}
```

如果访问

* http://server/index.php/index/index/hello

会输出

    init
    hello

如果访问

* http://server/index.php/index/index/data

会输出

    init
    data