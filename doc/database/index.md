## 连接数据库

如果应用需要使用数据库，必须配置数据库连接信息，数据库的配置文件有多种定义方式。

----------

##### 配置文件定义

常用的配置方式是在应用目录下面 dbconfig.inc.php 中添加下面的配置参数：

``` php
return array(
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
```

type 参数支持完整命名空间定义，默认采用 `ginkgo\db\connector` 作为命名空间，如果使用自己扩展的数据库驱动，可以配置为：

``` php
// 数据库类型
'type' => 'org\db\Mysql',
```

表示数据库的采用 `org\db\Mysql` 类作为驱动，而不是默认的 `ginkgo\db\connector\Mysql`。

----------

##### 方法配置

``` php
$dbconfig = array(
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

Db::connect($dbconfig);
```

----------

##### 模型类定义

如果在某个模型类里面定义了 `$config` 属性，则操作该模型的时候会连接给定的数据库，而不是配置文件中的。通常用于某些数据位于其它数据库的情况

`0.2.0` 之前为 `$connection` 属性

例如：

``` php
//在模型里单独设置数据库连接信息
namespace app\model\index;

use ginkgo\Model;

class User extends Model {
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
