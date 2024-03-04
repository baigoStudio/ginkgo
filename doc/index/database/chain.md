## 链式操作

数据库提供链式操作，可以有效提高代码清晰度和开发效率，支持所有的 CURD 操作。

使用比较简单，假如现在要查询一个 User 表的满足状态为 1 的前 10 条记录，并希望按照用户的创建时间排序 ，代码如下：

``` php
Db::table('user')
  ->where('status', '=', 1)
  ->order('create_time')
  ->limit(10)
  ->select();
```

这里的 `where()`、`order()` 和 `limit()` 方法就被称之为链式操作方法，除了 `select()` 方法必须放到最后一个外（因为 `select()` 方法并不是链式操作方法），链式操作的方法调用顺序没有先后，例如，下面的代码和上面的等效：

``` php
Db::table('user')
  ->order('create_time')
  ->limit(10)
  ->where('status', '=', 1)
  ->select();
```

其实不仅仅是查询方法可以使用链式操作，包括所有的 CURD 方法都可以使用，例如：

``` php
Db::table('user')
  ->where('id', '=', 1)
  ->find(array('id', 'name', 'email'));

Db::table('user')
  ->where('status', '=', 1)
  ->delete();
```

链式操作在完成查询后会自动清空链式操作的所有传值。简而言之，链式操作的结果不会带入后面的其它查询。

系统支持的链式操作方法有：

| 方法 | 作用 | 多次调用 | 支持的参数类型 |
| - | - | - | - |
| [where](chain_where.md) | 用于查询 | | 多个参数、数组、字符串 |
| [whereOr](chain_whereOr.md) | 用于 OR 查询 | 支持 | 多个参数、数组、字符串 |
| [whereAnd](chain_whereAnd.md) | 用于 AND 查询 | 支持 | 多个参数、数组、字符串 |
| [table](chain_table.md) | 用于定义要操作的数据表名称 | | 字符串 |
| [order](chain_order.md) | 用于对结果排序 | | 多个参数、数组、字符串 |
| [limit](chain_limit.md) | 用于限制查询结果数量 | | 多个参数、数字 |
| [group](chain_group.md) | 用于对查询的 GROUP 支持 | | 字符串、数组 |
| [join](chain_join.md) | 用于对查询的 JOIN 支持 | | 多个参数、数组、字符串 |
| [distinct](chain_distinct.md) | 用于查询的 DISTINCT 支持 | | 布尔值 |
| [fetchSql](chain_fetchSql.md) | 用于直接返回 SQL 语句 | | 布尔值 |
| [force](chain_force.md) | 用于数据集的强制索引 | | 字符串 |
| [bind](chain_bind.md) | 用于数据绑定操作 | | 多个参数、数组 |

所有的方法都返回当前的实例 `$this`。
