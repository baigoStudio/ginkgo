## 定义模型

----------

#### 定义一个 `User` 模型类：

定义模型必须继承模型基类 `ginkgo\Model`

``` php
namespace app\model\index;

use ginkgo\Model;

class User extends Model {
}
```

模型基类 `ginkgo\Model` 内置了如下类的实例：

``` php
class Model {
  // ginkgo\Request 的实例
  protected $obj_request;
}
```

----------

#### 设置数据库连接

如果你想指定数据库连接，可以使用：

``` php
namespace app\model\index;

class User extends ginkgo\Model {
  protected $config = array(
    // 数据库类型
    'type'    => 'mysql',
    // 服务器地址
    'host'    => '127.0.0.1',
    // 数据库名
    'name'    => 'baigo',
    // 数据库用户名
    'user'    => 'root',
    // 数据库密码
    'pass'    => '',
    // 数据库连接端口
    'port'    => '',
    // 数据库编码默认采用 utf8
    'charset' => 'utf8',
    // 数据库表前缀
    'prefix'  => 'baigo_',
    // 数据库调试模式
    'debug'   => false,
  );
}
```

和连接数据库的参数一样，`$config` 属性的值也可以设置为数据库的配置参数。

`0.2.0` 之前为 `$connection` 属性

----------

#### 设置数据表

模型会自动对应数据表，模型类的命名规则是：除去前缀的数据表名称，采用驼峰法和下划线（首字母大写）。以下是一个例子：

假设前缀是 `baigo_`

| 模型名 | 约定对应数据表 |
| - | - |
| User | baigo_user |
| User_Type | baigo_user_type |

如果模型名与数据表无法对应，那就需要设置数据表名称属性。

> 注意：表名属性不包括前缀，系统会自动加上前缀，如果要阻止系统添加前缀，可以用 <kbd>&#96;</kbd> 符号包裹完整的表名。

``` php
namespace app\model\index;

class User extends ginkgo\Model {
  // 设置数据表名
  protected $table = 'user';
}
```

----------

#### 模型调用

模型类支持两种调用方式，例如：

``` php
// 使用 Loader 类实例化（单例）
$user = Loader::model('User');

// 实例化模型
$user = new User;
```
