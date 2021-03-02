## 分页

`0.1.3` 新增

分页功能由 `ginkgo\Paginator` 完成。

另外，[数据库 -> 分页](../database/pagination.md)、[数据库 -> 链式操作](../database/chain_paginate.md) 中已内置快捷分页方法，详情请查看这些章节。

----------

#### 实例化分页类

分页在使用之前，需要进行实例化操作。

``` php
$config = array(
    'perpage'   => 30, // 每页记录数
    'pergroup'  => 10, // 每组页数
    'pageparam' => 'page', // 分页参数名
);

$paginator = Paginator::instance($config);
```

或者通过定义配置参数的方式，在配置文件中添加：

``` php
'var_default' => array(
    'perpage'   => 30, // 每页记录数
    'pergroup'  => 10, // 每组页数
    'pageparam' => 'page', // 分页参数名
),
```

参数如下：

| 参数 | 描述 | 默认 |
| - | - | - |
| perpage | 每页记录数 | 30 |
| pergroup | 每组页数 | 10 |
| pageparam | 分页参数名 | page |


----------

#### 生成分页数据

`make()` 方法说明

``` php
function make( $current = 'get' )
```

参数

* `current` 当前页码：

    混合型，默认为 get

    可能的值

    | 值 | 描述 |
    | - | - |
    | get | 用 get 方法获取页码 |
    | post | 用 post 方法获取页码 |
    | 整数 | 当前页码 |

返回

* 数组，假设数据库中有 300 条记录，当前页码为 3，每页显示 10 条记录，每组 10 个分页，生成的结果如下：

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

返回数组中的值为 false 时，代表没有这个参数，开发者可以此来判断是否显示相关链接。


----------

#### 设置、获取总记录数

通过 `$count` 属性设置，如：

``` php
$paginator = Paginator::instance();

$paginator->count = 300;
```

通过 `count()` 方法设置，如：

``` php
$paginator = Paginator::instance();

$paginator->count(300);
```

用 `$count` 属性和 `count()` 方法还可以取得总记录数，如：

``` php
$paginator = Paginator::instance();

echo $paginator->count();
echo $paginator->count;
```

----------

#### 设置、获取参数

表格中的方法、属性的使用与 `count()` 方法、属性类似。

| 名称 | 类型 | 描述 |
| - | - | - |
| perpage | 方法 | 每页记录数 |
| perpage | 属性 | 每页记录数 |
| pergroup | 方法 | 每组页数 |
| pergroup | 属性 | 每组页数 |
| pageparam | 方法 | 分页参数名 |
| pageparam | 属性 | 分页参数名 |


----------

#### 设置、获取当前页

`current()` 方法说明

``` php
$paginator = Paginator::instance();

$paginator->current(3);
```

参数

* `current` 当前页码：

    混合型，默认为 get

    可能的值

    | 值 | 描述 |
    | - | - |
    | get | 用 get 方法获取页码 |
    | post | 用 post 方法获取页码 |
    | 整数 | 当前页码 |

返回

* 无


用 `$current` 属性可以取得当前页码，如：

``` php
$paginator = Paginator::instance();

echo $paginator->current;
```


----------

#### 分页参数名实例

分页参数名可以通过 `pageparam()` 方法和 `$pageparam` 属性来指定，假设分页参数名为 `page`。

`current` 参数为 get 时，则如下 URL 的 page 参数即是分页参数：

http://server/index.php/index/article/index/`page/12`

`current` 参数为 post，则需要在表单中添加如下域

``` markup
<form action="http://server/index.php/index/article/index/" method="post">
    <input type="hidden" name="page" value="12">
</form>
```
