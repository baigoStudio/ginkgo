## 分层模型

ginkgo 支持模型的分层，可以根据项目的需要创建其他的模型层。通常情况下，不同的分层模型仍然是继承 `ginkgo\Model` 类或其子类，所以基本操作都是一致的。

以下是一个分层的例子：

在某个项目中，先设置基本模型，然后分别建立 `console`、`api` 模块的模型，可以在 `model` 目录下面创建基本模型，然后建立 `console`、`api` 目录。

以用户表为例，把对用户表的所有模型操作分成三层：

基本层：app\model\User 用于定义基本数据的操作

console 模块层：app\model\console\User 用于定义后台对用户的操作

api 模块层：app\model\api\User 用于 API 接口对用户的操作

三个模型层的定义如下：

基本层，实际位置

> app\model\user.mdl.php

``` php
namespace app\model;

use ginkgo\Model;

class User extends Model {
}
```

实例化方法：

``` php
ginkgo\Loader::model('User')
```

console 模块层，实际位置

> app\model\console\user.mdl.php

``` php
namespace app\console\model;

use app\model\User as User_Base;

class User extends User_Base {
}
```

实例化方法：

``` php
ginkgo\Loader::model('User')
```
