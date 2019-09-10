## 子查询

构造子查询 SQL，可以使用下面两种方式来构建。

----------

#### 使用 `fetchSql` 方法

`fetchSql` 方法表示不进行查询而只是返回构建的 SQL 语句，适用于任何 `CURD` 查询。

使用示例：

``` php
$subQuery = Db::table('user')
    ->where('id', '>', 10)
    ->fetchSql(true)
    ->select('id');
```

生成的 subQuery 结果为：

``` php
SELECT `id`,`name` FROM `user` WHERE `id` > 10
```

使用上述方法获得 subQuery 语句以后，可以进行如下操作

``` php
Db::table('user')
    ->where('id', 'NOT IN', $subQuery)
    ->order('id', 'desc')
    ->select();
```

生成的SQL语句为：

``` php
SELECT * FROM `user` WHERE `id` NOT IN (SELECT `id` FROM `user` WHERE `id` > 10) ORDER BY `id` DESC
```

----------

#### 使用 `buildSql` 方法

调用 `buildSql` 方法后不会进行实际的查询操作，而只是生成该次查询的 SQL 语句，该方法只能返回 where、whereAnd、whereOr 方法产生的语句，其他方法请使用 `fetchSql` 方法。

``` php
$where = array(
    array('name', 'LIKE', '%baigo', 'key', 'str'),
    array('title', 'LIKE', '%baigo', 'key', 'str'),
);

Db::where($where)->buildSql();
```

生成的 subQuery 结果为：

``` php
`name` LIKE '%baigo' AND `title` LIKE '%baigo'
```

使用上述方法获得 subQuery 语句以后，可以进行如下操作

``` php
$field = array('id', 'name');

Db::table('user')
    ->where('id', '>', 10)
    ->whereAnd($subQuery)
    ->order('id', 'desc')
    ->select($field);
```

生成的SQL语句为：

``` php
SELECT `id`,`name` FROM `user` WHERE `id` > 10 AND (`name` LIKE '%baigo' AND `title` LIKE '%baigo') ORDER BY `id` DESC
```
