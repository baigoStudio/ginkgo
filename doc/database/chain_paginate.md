## `paginate()`

`0.1.3` 新增

`paginate()` 用于指定查询分页，实际上本方法是通过自动计算符合条件的记录数，然后自动指定 `limit()` 方法的参数实现的。

> 假如链式操作中已经使用了 `limit()` 方法，本方法将失效。

可以通过定义配置参数的方式来指定分页参数，在配置文件中添加：

``` php
'var_default' => array(
  'perpage'   => 30, // 每页记录数
  'pergroup'  => 10, // 每组页数
  'pageparam' => 'page', // 分页参数名
),
```

查询数据，按系统配置分页，如：

``` php
Db::table('article')->paginate()->select();
```

查询数据，每页 10 条记录，如：

``` php
Db::table('article')->paginate(10)->select();
```

查询数据，还可以支持其他链式操作，如：

``` php
Db::table('user')->where('score', '>', 0)->paginate()->select();
```

----------

#### `paginate()` 方法说明

``` php
function paginate( [ $perpage = 0 [, $current = 'get' [, $pageparam = 'page' [, $pergroup = 0 ]]]] )
```

参数

* `perpage` 每页记录数：

  数值型，为 0 表示采用系统默认设置

* `current` 当前页码：

  混合型，默认为 get

  可能的值

  | 值 | 描述 |
  | - | - |
  | get | 用 get 方法获取页码 |
  | post | 用 post 方法获取页码 |
  | 整数 | 当前页码 |

* `pageparam` 分页参数名：

  字符型

* `pergroup` 每组页数

  数值型

返回

* 数据库实例

----------

#### 与 `pagination()` 方法的区别

假如开发者只是想通过计算符合条件的记录数，并获取分页的参数，可以使用 `pagination()` 方法

本方法与 `pagination()` 方法的参数完全一样，区别是返回结果不同，本方法返回数据库实例，属于链式操作中的一环，而 `pagination()` 则是返回分页参数。
