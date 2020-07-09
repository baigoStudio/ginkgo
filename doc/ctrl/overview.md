## 控制器概况

ginkgo 的控制器定义比较灵活，无需继承任何基础类，也可以继承框架预先封装的 `ginkgo\Ctrl` 类或者其他的控制器类。

----------

##### 控制器定义

一个典型的控制器类定义如下：

``` php
namespace app\ctrl\index;

class Index {
    public function index() {
        return 'index';
    }
}
```

控制器的实际位置是

> app/ctrl/index/index.ctrl.php

控制器类可以无需继承任何类，命名空间默认以 app 为根命名空间。

如果要在控制器里面渲染模板，可以使用：

``` php
namespace app\ctrl\index;

use ginkgo\View;

class Index {
    public function index() {
        $view = View::instance();

        return $view->fetch('index');
    }
}
```

如果继承了 `ginkgo\Ctrl` 类，可以直接调用如下类的实例：
 
``` php
class Ctrl {
    // ginkgo\Request 的实例
    protected $obj_request;

    // ginkgo\View 的实例
    protected $obj_view;

    // ginkgo\Lang 的实例
    protected $obj_lang;
}
```

 例如：

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;

class Index extends Ctrl {
    public function index() {
        // 获取包含域名的完整 URL 地址
        $this->assign('domain', $this->obj_request->root(true));

        return $this->fetch('index');
    }
}
```

----------

##### 渲染输出

默认情况下，控制器的输出全部采用 return 的方式，无需进行任何的手动输出，系统会自动完成渲染内容的输出。下面都是有效的输出方式：

``` php
namespace app\ctrl\index;

class Index {
    public function hello() {
        return 'hello, world!';
    }
    
    public function json() {
        return json_encode($data);
    }
    
    public function read() {
        $view = View::instance();

        return $view->fetch('index');
    }
}
```

控制器一般不需要任何输出，直接 return 即可。

----------

##### 特别注意

根据 [概况 -> 开发规范](../overview/spec.md) 的要求，因此 ginkgo 采用了如下两种自动转换的策略：

* 文件夹和文件的命名使用使用小写和下划线，当路由中的模块与控制器为小写字母和横杠时，系统会将横杠 <kbd>-</kbd> 转换为下划线 <kbd>_</kbd>。

* 方法的命名使用驼峰法（首字母小写），但是路由都使用小写，当路由中的动作命名为小写字母和下划线或横杠时，系统会将动作自动转换为驼峰法（首字母小写）。

如果当前访问的地址是

> http://server/index.php/mod-index/ctrl-index/hello-world `0.1.1` 新增

或

> http://server/index.php/mod_index/ctrl_index/hello_world

控制器的实际位置是

> app/ctrl/mod_index/ctrl_index.ctrl.php

控制器类定义如下：

``` php
namespace app\ctrl\mod_index;

class Ctrl_Index {
    public function helloWorld() {
        return 'hello_world';
    }
}
```