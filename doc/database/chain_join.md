## join

JOIN 通常有下面几种类型，不同类型的 JOIN 操作会影响返回的数据结果。

* INNER JOIN：等同于 JOIN（默认），如果表中有至少一个匹配，则返回行
* LEFT JOIN：即使右表中没有匹配，也从左表返回所有的行
* RIGHT JOIN：即使左表中没有匹配，也从右表返回所有的行
* FULL JOIN：只要其中一个表中存在匹配，就返回行

`join` 方法说明：

``` php
function join( $join [, $condition = '' [, $type = 'INNER']] )
```

`join` 方法也是链式操作之一，用于根据两个或多个表中的列之间的关系，从这些表中查询数据。

参数

* `join` 关联

    支持两种类型：字符串、数组

* `condition` 条件

    当 `join` 为数组时自动忽略。

    支持两种类型：字符串、数组

* `type` 关联类型

    当 `join` 为数组时自动忽略。

    可以为：INNER (默认)、LEFT、RIGHT、FULL，不区分大小写。

举例，以下三种写法的效果一样

``` php
$select = array(
    array('work', 'id'),
    array('artist', 'artist_id'),
);

Db::table('artist')
    ->join('work', 'artist.id = work.artist_id')
    ->select($select);

$join = array('artist.id', '=', 'work.artist_id');
Db::table('artist')
    ->join($join)
    ->select($select);

$join = array('work', 'artist.id = work.artist_id', 'RIGHT');

Db::table('artist')
    ->join($join)
    ->select($select);
```

如果要关联多个表，可以这样写：

``` php
$join = array(
    array('work', 'artist.id = work.artist_id', 'LEFT'),
    array('card', 'card.id = work.card_id', 'LEFT'),
);

Db::table('artist')
    ->join($join)
    ->select($select);
```

默认采用 INNER JOIN 方式，如果需要用其他的 JOIN 方式，可以改成

``` php
Db::table('artist')
    ->join('work', 'artist.id = work.artist_id', 'RIGHT')
    ->select($select);

$join = array('artist.id', '=', 'work.artist_id', 'RIGHT');
Db::table('artist')
    ->join($join)
    ->select($select);
```
