## 类库

可以方便的在 ginkgo 中扩展类库。

----------

#### 添加应用类库

此方法一般用于自行编写的类库，如果使用第三方类库，推荐使用 Composer 来扩展内核类库。

如果需要给应用添加类库，可以放入应用的 classes 目录，例如：

``` php
namespace app\classes\first\second;

class Foo {

}
```

那么实际的类文件位置应该是：

> app/classes/first/second/foo.class.php

使用 `app\classes\first\second\Foo` 类的时候，直接实例化即可使用，例如：

``` php
// 使用 Loader 类实例化（单例）
$foo = Loader::classes('Foo', 'second', 'first');

// 实例化类
$foo = new app\classes\first\second\Foo();
```

----------

#### 分层类库

ginkgo 支持类库的分层，其分层方式与 `分层控制器` 类似。

在控制器中实例化类库时，系统会默认实例化当前模块层的类库。例如 index 模块下的 User 控制器中实例化某个类库：

``` php
namespace app\ctrl\index;

use ginkgo\Loader;

class User {
    function __construct() { //构造函数
        $this->obj_user = Loader::classes('User');
    }
}
```

类库的实际位置

> app\classes\index\user.class.php

定义如下

``` php
namespace app\classes\index;

class User {

}
```

还可以定义分层类库。

例如，定义 index 模块 event 层下的 Blog 类库如下：

``` php
namespace app\classes\index\event;

class Blog {

}
```

类库的实际位置是

> app/classes/index/event/blog.class.php

定义完成后，就可以用下面的方式实例化类库了：

``` php
use ginkgo\Loader

$event = Loader::classes('Blog', 'event');
```
----------

#### 跨模块调用

类库支持跨模块调用，例如：

``` php
use ginkgo\Loader

$event = Loader::classes('Blog', '', 'admin');
```

类库的实际位置是

> app/classes/admin/blog.class.php

表示实例化 admin 模块的 Blog 类库类

``` php
use ginkgo\Loader

$event = Loader::classes('Blog', 'event', 'admin');
```

类库的实际位置是

> app/classes/admin/event/blog.class.php

----------

#### 扩展内核类库

强烈建议使用 Composer 安装和更新扩展类库。

如需要扩展和使用第三方类库，且该类库不是通过 Composer 安装，可以放入根目录下的 extend 目录，该目录是推荐的第三方扩展类库目录。

类的命名和命名空间请遵循 [概况 -> 开发规范](../overview/spec.md) 的建议，例如：

``` php
namespace extend\first\second;

class Foo {

}
```

那么实际的类文件位置应该是：

> extend/first/second/foo.class.php

使用 `extend\first\second\Foo` 类的时候，直接实例化即可使用，例如：

``` php
$foo = new extend\first\second\Foo();
```
或者

``` php
use extend\first\second\Foo;
$foo = new Foo();
```

你可以在入口文件中随意修改 extend 目录的名称，例如：

``` php
// 定义配置目录
define('GK_PATH_EXTEND', __DIR__ . '/../extension/'); //应用目录
```
    
如果只想变更 extend 目录的名称，也可以添加 `GK_NAME_EXTEND` 常量定义，例如：

``` php
// 定义配置目录
define('GK_NAME_EXTEND', 'extension');
```

