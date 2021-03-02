## 分页

`0.1.3` 新增

`pagination()` 方法通过计算符合条件的记录数，获取分页参数。

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
Db::table('article')->pagination();
```

查询数据，每页 10 条记录，如：

``` php
Db::table('article')->pagination(10);
```

查询数据，还可以支持所有链式操作，如：

``` php
Db::table('user')->where('score', '>', 0)->pagination();
```

----------

#### `pagination()` 方法说明

``` php
function pagination( [ $perpage = 0 [, $current = 'get' [, $pageparam = 'page' [, $pergroup = 0 ]]]] )
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

* 数组，结构如下：

``` php
array(
    'page'          => 3, // 当前页码
    'count'         => 300, // 总记录数
    'offset'        => 20, // 记录数偏移
    'first'         => 1, // 首页页码
    'final'         => 30, // 末页页码
    'total'         => 30, // 总页数
    'prev'          => 2, // 上一页
    'next'          => 4, // 下一页
    'group_begin'   => 1, // 当前组开始
    'group_end'     => 10, // 当前组结束
    'group_prev'    => false, // 上一组
    'group_next'    => 11, // 下一组
);
```
