## limit

`limit` 主要用于指定查询和操作的数量，特别在分页查询的时候使用较多。

----------

#### 限制结果数量

例如获取满足要求的10个用户，如下调用即可：

``` php

Db::table('user')
    ->where('status', '=', 1)
    ->limit(10)
    ->select();
```

`limit` 方法也可以用于写操作，例如更新满足要求的3条数据：

``` php
$update = array(
    'level' => 'A'
);
Db::table('user')
    ->where('score', '=', 100)
    ->limit(3)
    ->update($update);
```

----------

#### 分页查询

用于文章分页查询是 `limit` 方法比较常用的场合，例如：

``` php
Db::table('article')->limit(10, 25)->select();
```

表示查询文章数据，从第 10 行开始的 25 条数据（可能还取决于 where 条件和 order 排序的影响）。

对于大数据表，尽量使用limit限制查询结果，否则会导致很大的内存开销和性能问题。