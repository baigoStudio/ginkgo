## 原生查询

Db 类支持原生 SQL 查询操作，主要包括下面这些方法：

----------

#### `query()` 方法

`query()` 方法用于执行 SQL 查询操作，如果数据非法或者查询错误则返回 false，否则返回 true。

使用示例：

``` php
Db::query('select * from user where status=1');
```
----------

#### `exec()` 方法

用于更新和写入数据的 SQL 操作，如果数据非法或者查询错误则返回 false ，否则返回影响的记录数。

使用示例：

``` php
$count = Db::exec('update user set name=\'baigo\' where status=1');
```

----------

#### `getResult()` 方法

用于获取 `query()` 方法进行 SQL 查询得到的数据集。

使用示例：

``` php
Db::query('select * from user where status=1');
$row = Db::getResult(true, PDO::FETCH_ASSOC);
```

`getResult()` 方法说明

``` php
function getResult( [ $all = true [, $fetch_style = PDO::FETCH_ASSOC ]] )
```
参数

* `all` 是否返回所有行

* `fetch_style` 返回类型

  此参数必须是 PDO::FETCH_* 系列常量中的一个，默认为 PDO::FETCH_ASSOC。

  | 名称 | 描述 |
  | - | - |
  | PDO::FETCH_ASSOC | 返回一个索引为结果集列名的数组（默认） |
  | PDO::FETCH_BOTH | 返回一个索引为结果集列名和以0开始的列号的数组 |
  | PDO::FETCH_BOUND | 返回 TRUE ，并分配结果集中的列值给 PDOStatement::bindColumn() 方法绑定的 PHP 变量。 |
  | PDO::FETCH_CLASS | 返回一个请求类的新实例，映射结果集中的列名到类中对应的属性名。如果 fetch_style 包含 PDO::FETCH_CLASSTYPE（例如：PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE），则类名由第一列的值决定 |
  | PDO::FETCH_INTO | 更新一个被请求类已存在的实例，映射结果集中的列到类中命名的属性 |
  | PDO::FETCH_LAZY | 结合使用 PDO::FETCH_BOTH 和 PDO::FETCH_OBJ，创建供用来访问的对象变量名 |
  | PDO::FETCH_NUM | 返回一个索引为以0开始的结果集列号的数组 |
  | PDO::FETCH_OBJ | 返回一个属性名对应结果集列名的匿名对象 |

----------

#### `lastInsertId()` 方法

用于获取最后插入行的ID或序列值。

``` php
Db::exec('insert user set name=\'baigo\'');
$id = Db::lastInsertId();
```
