## bind

`bind` 方法用于手动参数绑定，除了使用原生 SQL 以外，大多数情况下无需进行手动绑定，系统会在查询和写入数据的时候自动使用参数绑定。

`bind` 方法用法如下：

``` php
// 用于查询
$bind = array('id', 10, 'int');
Db::table('user')
    ->where('id', '=', ':id')
    ->bind($bind)
    ->select();

// 用于写入
$bind = array(
    array('id', 10, 'int'),
    array('name', 'baigo'),
    array('email', 'baigo@qq.com'),
);
$update = array(
    'name'  => 'baigo',
    'email' => 'baigo@qq.com',
);
Db::table('user')
    ->bind($bind)
    ->where('id', '=', ':id')
    ->update($update);
```