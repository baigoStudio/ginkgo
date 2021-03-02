## `distinct()`

`distinct()` 方法用于返回唯一不同的值，参数是一个布尔值。

例如数据表中有以下数据

| id | name | token | time | status |
| - | - | - | - | - |
| 1 | hujun | fb732ba9caa56b3dc5dbc68941f2dc92 | 1547886908 | 1 |
| 2 | admin | 03fa0e763dac48e27830d51f2378f015 | 1560500358 | 1 |
| 3 | admin | 56d3e6dd8f750d639c5bb708be1dbc47 | 1557973031 | 1 |

以下代码会返回 `name` 字段不同的数据

``` php
Db::table('user')->distinct(true)->field('user')->select('name');

// 生成的 SQL 语句
SELECT DISTINCT `name` FROM user
```

返回以下数组

``` php
array(2) {
    [0] => array(1) {
        ["name"] => string(5) "hujun"
    }
    [1] => array(1) {
        ["name"] => string(5) "admin"
    }
}
```
