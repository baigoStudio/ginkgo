## 基本使用

配置了数据库连接信息后，就可以直接使用数据库运行原生 SQL 了，支持 query（查询）和 exec（写入）方法，并且支持参数绑定。

``` php
Db::query('select * from user where id=8');
Db::exec('insert into user (id, name) values (8, \'baigo\')');
```

----------

#### 参数绑定

支持参数绑定、占位符绑定，可以使用 `bind` 方法绑定参数，例如：

``` php
// 参数绑定
Db::prepare('insert into user (name) values (?)');
Db::bind(1, 'baigo');
Db::execute();

// 占位符绑定
Db::prepare('insert into user (name) values (:name)');
Db::bind('name', 'baigo');
Db::execute();
```

----------

#### 批量绑定

支持批量绑定参数，例如：

``` php
// 参数绑定
Db::prepare('insert into user (id, name) values (?, ?)');

$bind = array(
    array(1, 8),
    array(2, 'baigo'),
);

Db::bind($bind);
Db::execute();

// 占位符绑定
Db::prepare('insert into user (id, name) values (:id, :name)');

$bind = array(
    array('id', 8),
    array('name', 'baigo'),
);

Db::bind($bind);
Db::execute();
```

----------

#### 多个数据库连接

可以使用多个数据库连接，例如：

``` php
Db::connect($config)->query('select * from user where id=8');
```

$config 是一个单独的数据库配置，必须为数组，具体请查看 [连接数据库](overview.md)。

> 除了使用原生 SQL 以外，大多数情况下系统会忽略带有 <kbd>&#96;</kbd>、<kbd>(</kbd> 以及 <kbd>.</kbd> 符号的参数，不对这些参数进行处理，比如给表名自动添加前缀等。