## `fetchSql()`

`fetchSql()` 用于直接返回 SQL 语句而不是执行查询，适用于任何 CURD 操作。 例如：

``` php
$result = Db::table('user')->fetchSql(true)->find();
```
