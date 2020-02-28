## 查询方法

#### `where` 方法

可以使用 `where` 方法进行条件查询，链式操作中，`where` 方法只能调用一次：

``` php
Db::table('user')->where('name', 'LIKE', '%baigo', 'name', 'str')->find();
Db::table('user')->where(array('name', 'LIKE', '%baigo', 'name', 'str'))->find();
```

生成的 SQL 语句类似于下面，系统会自动绑定占位符，执行查询并返回结果：

``` php
SELECT * FROM `user` WHERE `name` LIKE :name

// 真正执行的 SQL 语句
SELECT * FROM `user` WHERE `name` LIKE '%baigo'
```

`where` 方法说明

``` php
function where( $where [, $expression , $conditional [, $parameter = '' [, $type = '']]] )
```

参数

* `where` 字段名

    支持两种类型：字符串、数组

* `expression` 表达式

    当 `where` 为字符串时为必须，当 `where` 为数组时自动忽略。
    
    详情请查看 [查询语法](syntax.md)

* `conditional` 条件值

    当 `where` 为字符串时为必须，当 `where` 为数组时自动忽略。

    详情请查看 [查询语法](syntax.md)

* `parameter` 参数名

    当 `where` 为数组时自动忽略。

* `type` 数据类型

    为空自动判断，当 `where` 为数组时自动忽略。

    可能的值
    
    | 值 | 描述 |
    | - | - |
    | str（默认值） | 字符串 |
    | int | 整数 |
    | float | 浮点数 |
    | double | 数字 |
    | bool | 布尔值 |
       
多条件查询

``` php
$where = array(
    array('name', '=', 'baigo'),
    array('title', 'LIKE', '%baigo'),
);

Db::table('user')->where($where)->find();

$where = array(
    // array('字段名', '表达式', '条件值', '参数名', '数据类型', '运算符 (为空则为 AND)'),
    array('name', 'LIKE', '%baigo', 'key', 'str'),
    array('title', 'LIKE', '%baigo', 'key', 'str', 'OR'),
);

Db::table('user')->where($where)->find();
```

生成的 SQL 语句类似于下面：

``` php
SELECT * FROM `user` WHERE `name` = :name AND `title` LIKE :title
SELECT * FROM `user` WHERE `name` LIKE :key OR `title` LIKE :key

// 真正执行的 SQL 语句
SELECT * FROM `user` WHERE `name` = 'baigo' AND `title` LIKE '%baigo'
SELECT * FROM `user` WHERE `name` LIKE '%baigo' OR `title` LIKE '%baigo'
```

多字段相同条件的查询可以简化为如下方式：

``` php
Db::table('user|title')->where('name', 'LIKE', '%baigo', 'key')->find();
Db::table('user&title')->where('name', 'LIKE', '%baigo', 'key')->find();
```

生成的 SQL 语句类似于下面：

``` php
SELECT * FROM `user` WHERE `name` LIKE :key OR `title` LIKE :key
SELECT * FROM `user` WHERE `name` LIKE :key AND `title` LIKE :key

// 真正执行的 SQL 语句
SELECT * FROM `user` WHERE `name` LIKE '%baigo' OR `title` LIKE '%baigo'
SELECT * FROM `user` WHERE `name` LIKE '%baigo' AND `title` LIKE '%baigo'
```

----------

#### `whereOr` 方法

`whereOr` 链式操作中，`whereOr` 方法可以多次调用：

``` php
$where = array(
    // array('字段名', '表达式', '条件值', '参数名', '数据类型', '运算符 (为空则为 AND)'),
    array('name', 'LIKE', '%baigo', 'key', 'str'),
    array('title', 'LIKE', '%baigo', 'key', 'str'),
);

$whereOr_1 = array(
    array('is_pub', '<', 1),
    array('time_pub', '<=', date('Y-m-d H:i:s'), 'date'),
);

$whereOr_2 = array(
    array('is_hide', '>', 1),
    array('time_hide', '>=', date('Y-m-d H:i:s'), 'date'),
);
    
Db::table('user')
    ->where($where)
    ->whereOr($whereOr_1)
    ->whereOr($whereOr_2)
    ->find();
```

生成的 SQL 语句类似于下面：

``` php
SELECT * FROM `user` WHERE `name` LIKE :key AND `title` LIKE :key 
    OR (`is_pub` < :is_pub AND `time_pub` <= :date) 
    OR (`is_hide` > :is_hide AND `time_hide` >= :date)

// 真正执行的 SQL 语句
SELECT * FROM `user` WHERE `name` LIKE '%baigo' AND `title` LIKE '%baigo' 
    OR (`is_pub` < 1 AND `time_pub` <= '2019-05-06 10:13:01') 
    OR (`is_hide` > 1 AND `time_hide` >= '2019-05-06 10:13:01')
```

----------

#### `whereAnd` 方法

`whereAnd` 链式操作中，`whereAnd` 方法可以多次调用：

``` php
$where = array(
    // array('字段名', '表达式', '条件值', '参数名', '数据类型', '运算符 (为空则为 AND)'),
    array('name', 'LIKE', '%baigo', 'key', 'str'),
    array('title', 'LIKE', '%baigo', 'key', 'str'),
);

$whereAnd_1 = array(
    array('is_pub', '<', 1),
    array('time_pub', '<=', date('Y-m-d H:i:s'), 'date', '', '', 'OR'),
);

$whereAnd_2 = array(
    array('is_hide', '>', 1),
    array('time_hide', '>=', date('Y-m-d H:i:s'), 'date', '', '', 'OR'),
);
    
Db::table('user')
    ->where($where)
    ->whereAnd($whereAnd_1)
    ->whereAnd($whereAnd_2)
    ->find();
```

生成的 SQL 语句类似于下面：

``` php
SELECT * FROM `user` WHERE `name` LIKE :key AND `title` LIKE :key 
    AND (`is_pub` < :is_pub OR `time_pub` <= :date) 
    AND (`is_hide` > :is_hide OR `time_hide` >= :date)

// 真正执行的 SQL 语句
SELECT * FROM `user` WHERE `name` LIKE '%baigo' AND `title` LIKE '%baigo' 
    AND (`is_pub` < 1 OR `time_pub` <= '2019-05-06 10:13:01') 
    AND (`is_hide` > 1 OR `time_hide` >= '2019-05-06 10:13:01')
```

----------

#### 混合查询

``` php
$where = array(
    // array('字段名', '表达式', '条件值', '参数名', '数据类型', '运算符 (为空则为 AND)'),
    array('name', 'LIKE', '%baigo', 'key', 'str'),
    array('title', 'LIKE', '%baigo', 'key', 'str'),
);

$whereAnd = array(
    array('is_pub', '<', 1),
    array('time_pub', '<=', date('Y-m-d H:i:s'), 'date', '', '', 'OR'),
);

$whereOr = array(
    array('is_hide', '>', 1),
    array('time_hide', '>=', date('Y-m-d H:i:s'), 'date'),
);
    
Db::table('user')
    ->where($where)
    ->whereAnd($whereAnd)
    ->whereOr($whereOr)
    ->find();
```

生成的 SQL 语句类似于下面：

``` php
SELECT * FROM `user` WHERE `name` LIKE :key AND `title` LIKE :key 
    AND (`is_pub` < :is_pub OR `time_pub` <= :date) 
    OR (`is_hide` > :is_hide AND `time_hide` >= :date)

// 真正执行的 SQL 语句
SELECT * FROM `user` WHERE `name` LIKE '%baigo' AND `title` LIKE '%baigo' 
    AND (`is_pub` < 1 OR `time_pub` <= '2019-05-06 10:13:01') 
    OR (`is_hide` > 1 AND `time_hide` >= '2019-05-06 10:13:01')
```
