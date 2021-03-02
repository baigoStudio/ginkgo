## CURD

CURD 是一个数据库技术中的缩写词，一般的项目开发的各种参数的基本功能都是 CURD。它代表创建（Create）、更新（Update）、读取（Read）和删除（Delete）操作。

----------

#### 查询数据

查询一条数据：

``` php
Db::table('user')->where('id', '=', 1)->find();
```

查询数据集使用：

``` php
$select = array(
    'user_id',
    'user_name',
);
Db::table('user')->where('status', '=', 'enable')->select($select);
```

查询结果不存在，返回空数组。

如果设置了数据表前缀参数，`table()` 方法会自动加上前缀，如果要忽略前缀，可以使用 <kbd>&#96;</kbd> 符号包裹完整的表名，如：

``` php
Db::table('`user`');
```

在 `find()` 和 `select()` 方法之前可以使用所有的链式操作方法。

默认情况下，`find()` 和 `select()` 方法返回的都是数组。

如果查询需要使用 SQL 函数，可以使用下面的方式：

``` php
$select = array(
    'DISTINCT FROM_UNIXTIME(`attach_time`, \'%Y\') AS `attach_year`',
);
Db::table('attach')->where('status', '=', 'enable')->select($select);
```

----------

#### 添加数据

``` php
$data = array(
    'foo' => 'bar',
    'bar' => 'foo',
);
Db::table('user')->insert($data);
```

`insert()` 方法添加成功返回新增数据的自增主键。

在 `insert()` 方法之前可以使用所有的链式操作方法。

----------

#### 更新数据

``` php
$data = array(
    'foo' => 'bar',
    'bar' => 'foo',
);
Db::table('user')->where('id', '=', 1)->update($data);
```

`update()` 方法更新成功返回成功的条数，没修改任何数据返回 0。

在 `update()` 方法之前可以使用所有的链式操作方法。

----------

#### 删除数据

``` php
Db::table('user')->where('id', '=', 1)->delete();
```

`delete()` 方法删除成功返回成功的条数，没删除任何数据返回 0。

在 `delete()` 方法之前可以使用所有的链式操作方法。
