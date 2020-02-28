## 链式操作

模型完全支持链式操作，数据库中的所有 链式操作 均可直接调用，详情请查看 [数据库 -> 链式操作](../database/chain.md)。

下面是一个例子：

``` php
$this->where('status', '=', 1)
    ->order('create_time')
    ->limit(10)
    ->select();
```
