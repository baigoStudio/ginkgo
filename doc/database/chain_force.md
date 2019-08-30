## force

`force` 方法用于数据集的强制索引操作，例如：

``` php
Db::table('user')->force('user')->select();
```

对查询强制使用 `user` 索引，`user` 必须是真实存在的索引。