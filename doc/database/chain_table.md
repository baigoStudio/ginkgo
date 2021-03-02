## `table()`

`table()` 方法用于指定操作的数据表。

一般情况下，操作模型的时候系统能够自动识别当前对应的数据表，所以，使用 `table()` 方法的情况通常是为了：

* 切换操作的数据表；
* 对多表进行操作。

例如：

``` php
Db::table('user')->where('status', '>', 1)->select();
```

也可以在 `table()` 方法中指定数据库，例如：

``` php
Db::table('db_name.user')->where('status', '>', 1)->select();
```

如果设置了数据表前缀参数，`table()` 方法会自动加上前缀，如果要阻止系统添加前缀，可以用 <kbd>&#96;</kbd> 符号包裹完整的表名，如：

``` php
Db::table('`baigo_user`')->where('status', '>', 1)->select();
Db::table('`db_name`.`baigo_user`')->where('status', '>', 1)->select();
```
