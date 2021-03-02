## `group()`

`group()` 通常用于结合合计函数，根据一个或多个列对结果集进行分组。

`group()` 方法只有一个参数，可以使用数组和字符串。

例如，查询结果按照用户 id 进行分组：

``` php
Db::table('user')
    ->group('user_id')
    ->select('user_id,username,MAX(score)');
```

生成的 SQL 语句是：

``` php
SELECT user_id,username,MAX(score) FROM score GROUP BY user_id
```

也支持对多个字段进行分组，例如：

``` php
$group = array(
    'user_id', 'test_time'
);
Db::table('user')
    ->group($group)
    ->select('user_id,username,MAX(score)');
```

生成的 SQL 语句是：

``` php
SELECT user_id,username,MAX(score) FROM score GROUP BY user_id,test_time
```
