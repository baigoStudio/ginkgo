## where

`where` 方法是数据库查询的精髓，可以完成包括普通查询、表达式查询、组合查询在内的查询操作。`where` 方法的参数支持字符串和数组。详情请查看 [查询方法](../query.md)

----------

#### 表达式查询

查询表达式的用法：

``` php
Db::table('user')
    ->where('id', '>', 1)
    ->whereOr('name', '=', 'baigo')
    ->select(); 
```
----------

#### 数组条件

可以通过数组方式批量设置查询条件。

``` php
$map = array('id', '>', 1);

Db::table('user')->where($map)->select(); 

$map = array(
    array('id', '>', 1),
    array('mail', 'like', '%baigo@qq.com%'),
);

Db::table('user')->where($map)->select(); 
```

----------

#### 原生 SQL 条件

使用原生 SQL 条件直接查询和操作，必须使用 <kbd>&#96;</kbd> 符号来包裹 表名、字段名 等，例如：

``` php
Db::table('user')->where('`type`=1 AND `status`=1')->select(); 
```

最后生成的 SQL 语句是

``` php
SELECT * FROM `user` WHERE `type`=1 AND `status`=1
```

使用原生 SQL 条件的时候，建议配合预处理机制，确保安全，例如：

``` php
$bind = array(
    array('id', 1, 'int'),
    array('name', 'baigo'),
);
Db::table('user')->where('`id`=:id AND `username`=:name')->bind($bind)->select();
```