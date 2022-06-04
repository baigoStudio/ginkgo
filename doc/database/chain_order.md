## `order()`

`order()` 用于对操作的结果排序。

用法如下：

``` php
Db::table('user')->where('status', '=', 1)->order('id', 'DESC')->limit(5)->select();
```

注意：链式操作没有顺序，可以在 `select()` 方法调用之前随便变更调用顺序。

支持对多个字段的排序，例如：

``` php
$order = array(
  array('id', 'DESC'),
  array('status),
);
Db::table('user')->where('status', '=', 1)->order($order)->limit(5)->select();
```

如果没有指定 DESC 或者 ASC 排序规则，默认为 ASC。

``` php
Db::table('user')->where('status', '=', 1)->order('id')->limit(5)->select();
```
