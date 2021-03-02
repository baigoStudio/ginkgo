## 空控制器

空控制器的概念是指当系统找不到指定的控制器名称的时候，系统会尝试定位空控制器 `C_Empty`，利用这个机制，可以用来定制错误页面和进行 URL 的优化。

现在把前面的需求进一步，把 URL 由原来的

http://server/index.php/index/city/shanghai/

变成

http://server/index.php/index/shanghai/

这样更加简单的方式，如果按照传统的模式，必须给每个城市定义一个控制器类，然后在每个控制器类的 `index()` 方法里面进行处理。可是如果使用空控制器功能，这个问题就可以迎刃而解了。

可以给项目定义一个 `C_Empty` 控制器类

``` php
namespace app\ctrl\index;

use ginkgo\Request;

class C_Empty {
    public function index() {
        // 获取原始路由
        $routeOrig = Request::instance()->routeOrig();

        // 取得原始控制器名
        $name = $routeOrig['ctrl']

        // 根据当前控制器名来判断要执行那个城市的动作
        return $this->showCity($name);
    }

    // 注意 showCity() 方法 本身是 protected 方法
    protected function showCity($name) {
        // 和 $name 这个城市相关的处理
        return '当前城市：' . $name;
    }
}
```

控制器的实际位置是

> app/ctrl/index/c_empty.ctrl.php

接下来，可以在浏览器里面输入

* http://server/index.php/index/beijing/
* http://server/index.php/index/shanghai/
* http://server/index.php/index/shenzhen/

由于系统并不存在 beijing、shanghai 或者shenzhen 控制器，因此会定位到空控制器 `C_Empty` 去执行，会看到依次输出的结果是：

    当前城市：beijing
    当前城市：shanghai
    当前城市：shenzhen

空控制器和空动作还可以同时使用，用以完成更加复杂的动作。
