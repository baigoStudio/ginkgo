## 分层控制器

ginkgo 引入了分层控制器的概念

##### 访问控制器

能够通过 URL 访问的称之为访问控制器，此前所说的控制器一般都是指访问控制器，访问控制器是由 `ginkgo\App` 类负责调用和实例化的，无需手动实例化。

URL 解析和路由后，会把当前的 URL 地址解析到 **【模块 / 控制器 / 动作】**，其实也就是执行某个控制器类的某个动作，下面是一个示例：

``` php
namespace app\ctrl\index;

class Blog {
    public function index() {
        return 'index';
    }
    
    public function add() {
        return 'add';
    }
    
    public function edit($param) {
        return 'edit:' . $param['id'];
    }
}
```

控制器的实际位置是

> app/ctrl/index/blog.ctrl.php

当前定义的主控制器位于 index 模块下面，所以当访问不同的 URL 地址的页面：

* http://server/index.php/index/blog/index    
* http://server/index.php/index/blog/add     
* http://server/index.php/index/blog/edit/id/5 

输出如下：

    index
    add
    edit:5
    
----------

##### 分层控制器

除了访问控制器外，还可以定义分层控制器类，分层控制器是不能够被 URL 访问直接调用的，只能在访问控制器、模型的内部，或者模板中进行调用。

例如，定义 index 模块 event 层下的 Blog 控制器如下：

``` php
namespace app\ctrl\index\event;

class Blog {
    public function insert() {
        return 'insert';
    }
    
    public function update($param) {
        return 'update:' . $param['id'];
    }
    
    public function delete($param) {
        return 'delete:' . $param['id'];
    }
}
```

控制器的实际位置是

> app/ctrl/index/event/blog.ctrl.php

定义完成后，就可以用下面的方式实例化并调用方法了：

``` php
use ginkgo\Loader

$event = Loader::ctrl('Blog', 'event');
echo $event->update(5);
echo $event->delete(5);
```

输出如下：

    update:5
    delete:5
    
----------

#### 跨模块调用

控制器支持跨模块调用，例如：

``` php
use ginkgo\Loader

$event = Loader::ctrl('Blog', '', 'admin');
echo $event->update(5);
```

控制器的实际位置是

> app/ctrl/admin/blog.ctrl.php

输出如下：

    update:5

表示实例化 admin 模块的 Blog 控制器类，并执行 update 方法。

``` php
use ginkgo\Loader

$event = Loader::ctrl('Blog', 'event', 'admin');
echo $event->update(5);
```

控制器的实际位置是

> app/ctrl/admin/event/blog.ctrl.php

输出如下：

    update:5

表示实例化 admin 模块的 event 层下的 Blog 控制器类，并执行 update 方法。
