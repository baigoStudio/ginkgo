## 空动作

空动作是指系统在找不到指定的动作的时候，会定位到空动作 `a_empty()` 方法来执行，利用这个机制，可以实现错误页面和一些 URL 的优化。

例如，用空动作功能来实现一个城市切换的功能。

只需要给 City 控制器类定义一个 `a_empty()` 方法：

``` php
namespace app\ctrl\index;

use ginkgo\Request;

class City {
    public function a_empty() {
        // 获取原始路由
        $routeOrig = Request::instance()->routeOrig();

        // 取得原始动作名
        $name = $routeOrig['act']

        // 把所有城市的动作解析到 showCity() 方法
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

> app/ctrl/index/city.ctrl.php

接下来，可以在浏览器里面输入

* http://server/index.php/index/city/beijing/
* http://server/index.php/index/city/shanghai/
* http://server/index.php/index/city/shenzhen/

由于 City 并没有定义 beijing、shanghai 或者 shenzhen 动作，因此系统会定位到空动作 `a_empty()` 中去解析，`a_empty()` 方法的参数就是当前 URL 里面的动作名，因此会看到依次输出的结果是：

    当前城市：beijing
    当前城市：shanghai
    当前城市：shenzhen
