## ginkgo\db

本目录保存数据库驱动及其相关的类。

#### 目录结构

```
project 应用部署目录
+-- ginkgo                         框架系统目录
|   +-- db                         数据库相关目录
|   |   +-- builder                SQL 语句构造器
|   |   |   +-- mysql.class.php    MySQL 语句构造器
|   |   |   +--  ...               可扩展
|   |   |
|   |   +-- connector              数据库连接类
|   |   |   +-- mysql.class.php    MySQL 数据库连接类
|   |   |   +--  ...               可扩展
|   |   |
|   |   +-- builder.class.php      SQL 语句构造器基类
|   |   +-- connector.class.php    数据库连接基类
|   |   +--  ...
|   |
|   +--  ...
|
+--  ...
```

#### 扩展数据库驱动

常用的配置方式是在应用目录下面 dbconfig.inc.php 中添加下面的配置参数：

``` php
return array(
  // 数据库类型
  'type'    => 'mysql',
);
```

type 参数支持完整命名空间定义，默认采用 `ginkgo\db\connector` 作为命名空间，如果使用自己扩展的数据库驱动，可以配置为：

扩展的数据库驱动必须继承 `ginkgo/db/Connector` 类，另外作为配套的 SQL 语句构造器，必须继承 `ginkgo/db/Builder` 类

``` php
// 数据库类型
'type' => 'org\db\Mysql',
```

表示数据库的采用 `org\db\Mysql` 类作为驱动，而不是默认的 `ginkgo\db\connector\Mysql`。

或者通过方法配置

``` php
$dbconfig = array(
  // 数据库类型
  'type'    => 'mysql',
);

Db::connect($dbconfig);
```
