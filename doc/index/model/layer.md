## 分层模型

ginkgo 支持模型的分层，其分层方式与 `分层控制器` 类似。

在控制器中实例化模型时，系统会默认实例化当前模块层的模型。例如 index 模块下的 User 控制器中实例化某个模型：

``` php
namespace app\ctrl\index;

use ginkgo\Loader;

class User {
  function __construct() { //构造函数
    $this->mdl_user = Loader::model('User');
  }
}
```

模型的实际位置

> app\model\index\user.mdl.php

定义如下

``` php
namespace app\model\index;

use ginkgo\Model;

class User extends Model {

}
```

还可以定义分层模型。

例如，定义 index 模块 event 层下的 Blog 模型如下：

``` php
namespace app\model\index\event;

use ginkgo\Model;

class Blog extends Model {

}
```

模型的实际位置是

> app/model/index/event/blog.mdl.php

定义完成后，就可以用下面的方式实例化模型了：

``` php
use ginkgo\Loader

$event = Loader::model('Blog', 'event');
```
----------

#### 跨模块调用

模型支持跨模块调用，例如：

``` php
use ginkgo\Loader

$event = Loader::model('Blog', '', 'admin');
```

模型的实际位置是

> app/model/admin/blog.mdl.php

表示实例化 admin 模块的 Blog 模型类

``` php
use ginkgo\Loader

$event = Loader::model('Blog', 'event', 'admin');
```

模型的实际位置是

> app/model/admin/event/blog.mdl.php

----------

#### 分层模型实例

开发者可以根据项目的需要创建其他的模型层。通常情况下，不同的分层模型仍然是继承 `ginkgo\Model` 类或其子类，所以基本操作都是一致的。

以下是一个分层的例子，以用户表为例：

在某个项目中，先设置基本模型，放置于 `./app/model` 目录下。然后在 `./app/model` 下分别建立 `console`、`api` 目录，用于建立分层模型。

把模型操作分成三层：

基本层：`app\model\User` 用于定义基本数据的操作

console 模块层：`app\model\console\User` 用于定义后台对用户的操作

console\event 模块层：`app\model\console\event\User` 用于定义后台对用户的事件操作

api 模块层：`app\model\api\User` 用于 API 接口对用户的操作

三个模型层的定义如下：

基本层，实际位置

> app\model\user.mdl.php

``` php
namespace app\model;

use ginkgo\Model;

class User extends Model { // 继承模型类

}
```

console 模块层，实际位置

> app\model\console\user.mdl.php

``` php
namespace app\model\console;

use app\model\User as User_Base; // 继承基本模型

class User extends User_Base {

}
```

console\event 模块层，实际位置

> app\model\console\event\user.mdl.php

``` php
namespace app\model\console\event;

use app\model\console\User as User_Console; // 继承 console/User 模型

class User extends User_Console {

}
```

api 模块层，实际位置

> app\model\api\user.mdl.php

``` php
namespace app\model\api;

use app\model\User as User_Base;

class User extends User_Base { // 继承基本模型

}
```

假设在 `app\ctrl\console\User` 控制器中实例化模型：

``` php
$this->mdl_user = Loader::model('User');
```

模型的实际位置

> app\model\console\user.mdl.php

``` php
$this->mdl_user = Loader::model('User', 'event');
```

模型的实际位置

> app\model\console\event\user.mdl.php

``` php
$this->mdl_user = Loader::model('User', '', 'api');
```

模型的实际位置

> app\model\api\user.mdl.php

``` php
$this->mdl_user = Loader::model('User', '', false);
```

模型的实际位置

> app\model\user.mdl.php
